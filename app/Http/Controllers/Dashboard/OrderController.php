<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\OrderDataTable;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OrderSheetImport;
use Illuminate\Database\Eloquent\Builder;
use App\Notifications\OrderUpdates;
use App\Notifications\NewOrder;

use DataTables;

class OrderController extends BackEndDatatableController
{
    protected $model;
    protected $dataTable;
    
    public function __construct(Order $model, OrderDataTable $orderDataTable)
    {
        parent::__construct($model, $orderDataTable);
        $this->model = $model;
        $this->dataTable = $orderDataTable;
    }

    public function index()
    {
        $module_name_plural = $this->getClassNameFromModel();
        $module_name_singular = $this->getSingularModelName();
        
        return  auth()->user()->type == "super_admin"? 
                $this->dataTable->render('dashboard.' . $module_name_plural . '.index', compact('module_name_singular', 'module_name_plural'))
                :
                view('dashboard.' . $module_name_plural . '.users_index', compact('module_name_singular', 'module_name_plural'));
                ;
    }

    /**
     * Show orders for the non super admin users.
     *
     * @return \Illuminate\Http\Json
     */
    public function showOrders()
    {
        if( auth()->user()->type == "pharmacy" )
            $query = Order::where('from_id', auth()->user()->id)->where('status', request()->status);
        else
            $query = Order::where('to_id', auth()->user()->store_id)->where('status', request()->status);
      
        return 
        auth()->user()->type == "pharmacy"?
            Datatables::of($query)
                ->addColumn('store', function ($query) {
                    return '<a href="'.route('dashboard.stores.show', [ 'store' => $query->to_id ]).'" ><i class="glyphicon glyphicon-edit"></i> '.$query->to->name.'</a>';

                })->addColumn('status', function ($query) {
                    return $query->status;
                })->editColumn('created_at', function ($query) {
                    return $query->created_at->diffForHumans();
                })->addColumn('action', function ($query) {
                    $module_name_singular = 'order';
                    $module_name_plural   = 'orders';
                    $row = $query;
                    return view('dashboard.buttons.show', compact('module_name_singular', 'module_name_plural', 'row'));
                })->filter(function ($query) {
                    return $query
                        ->where('from_id', auth()->user()->id)->where('status', request()->status)
                        ->where(function ($w) {
                            return $w->whereHas('to', function (Builder $q) {
                                    $q->whereTranslationLike('name', "%" . request()->search['value'] . "%");
                                })
                                ->orwhere('status', 'like', "%" . request()->search['value'] . "%")
                                ->orwhere('id', 'like', "%" . request()->search['value'] . "%")
                                ->orwhere('created_at', 'like', "%" . request()->search['value'] . "%")
                                ->orwhere('updated_at', 'like', "%" . request()->search['value'] . "%");
                        });
                })
                ->rawColumns(['action', 'store'])
                ->make(true)
                :
                Datatables::of($query)
                ->addColumn('pharmacy', function ($query) {
                    return '<a href="'.route('dashboard.stores.show', [ 'store' => $query->from_id ]).'" ><i class="glyphicon glyphicon-edit"></i> '.$query->to->name.'</a>';

                })->addColumn('status', function ($query) {
                    return $query->status;
                })->editColumn('created_at', function ($query) {
                    return $query->created_at->diffForHumans();
                })
                ->addColumn('action', function ($query) {
                    $module_name_singular = 'order';
                    $module_name_plural   = 'orders';
                    $row = $query;
                    return view('dashboard.buttons.show', compact('module_name_singular', 'module_name_plural', 'row'));
                })
                ->filter(function ($query) {
                    return $query
                        ->where('to_id', auth()->user()->store_id)->where('status', request()->status)
                        ->where(function ($w) {
                            return $w->whereHas('from', function (Builder $q) {
                                    $q->where('name', 'like', '%'.request()->search['value'].'%');
                                })
                                ->orwhere('status', 'like', "%" . request()->search['value'] . "%")
                                ->orwhere('id', 'like', "%" . request()->search['value'] . "%")
                                ->orwhere('created_at', 'like', "%" . request()->search['value'] . "%")
                                ->orwhere('updated_at', 'like', "%" . request()->search['value'] . "%");
                        });
                })
                ->rawColumns(['action', 'pharmacy'])
                ->make(true)
                ;
    }

    /**
     * Show order products.
     *
     * @return \Illuminate\Http\Json
     */
    public function orderProducts()
    {
        $query = OrderProduct::where('order_id', request()->order);

        return  Datatables::of($query)
                ->addColumn('product', function ($query) {
                    return $query->product->name;
                })->addColumn('amount', function ($query) {
                    return $query->amount;
                })->addColumn('unit', function ($query) {
                    return $query->unit;
                })->addColumn('note', function ($query) {
                    return '<span title="'.$query->note.'">'.\Illuminate\Support\Str::limit($query->note, 25, '...').'</span>';
                })
                ->filter(function ($query) {
                    return $query
                        ->where('order_id', request()->order)
                        ->where(function ($w) {
                            return $w->whereHas('product', function (Builder $q) {
                                    $q->whereTranslationLike('name', "%" . request()->search['value'] . "%");
                                })
                                ->orwhere('amount', 'like', "%" . request()->search['value'] . "%")
                                ->orwhere('id', 'like', "%" . request()->search['value'] . "%")
                                ->orwhere('unit', 'like', "%" . request()->search['value'] . "%")
                                ->orwhere('note', 'like', "%" . request()->search['value'] . "%");
                        });
                })
                ->rawColumns(['note'])
                ->make(true);
    }// ISSUE

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'order_sheet'           => 'nullable|mimes:xlsx',
            'select_all'            => 'nullable',
            'select_item.*'         => 'nullable',
            'select_manually.*'     => 'required_unless:order_sheet,null|required_unless:select_item,null',
            'store_id'              => 'required|exists:stores,id',
            'amount'                => 'nullable|integer|min:1',
            'unit'                  => 'nullable|string|max:191',
            'note'                  => 'nullable|max:400',
        ];
        $request->validate($rules);

        # Create order 
        $order = Order::create([
            'from_id'   => auth()->user()->id,
            'to_id'     => $request->store_id,
            'status'    => 'waiting',
        ]);

        # Create order products
        if(isset($request->order_sheet))
            Excel::import(new OrderSheetImport($order->id), $request->order_sheet);
        else{

            if( isset($request->select_all) )
                    $this->addOrderProducts($request, $order->id, 'select_all'); 
            else
                    $this->addOrderProducts($request, $order->id, 'select_manually'); 
        }

        if( count($order->orderProducts) == 0 )
        {
            $order->delete();
            session()->flash('error', __('site.order_failed'));

        }else{
            session()->flash('success', __('site.order_sent_successfuly'));

            # Save log for super_admin
            $this->addLog([
                'log_type'	=> $this->getClassNameFromModel(),
                'log_id'  	=> $order->id,
                'message' 	=> $this->getSingularModelName().'_has_been_added',
                'action_by'	=> auth()->user()->id,
                ]);

            # Notify store owner
            $this->setFirebase('to', $order->to->owner->fcm_token, null);
            $title   = ['en'=>"New Order",   'ar'=>"طلب جديد"];
            $message = ['en'=>"Dr. ".$order->from->name."'s pharmacy sent a new order request.", 'ar'=>"صيدلية الدكتور ".$order->from->name." ارسلت طلب جديد."];
            $order->to->owner->notify(new OrderUpdates($message, $title, $order->id));
        }

        return redirect()->route('dashboard.stores.products', ['store'=>$request->store_id]);
    }

    /**
     * Store the order products.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $orderId 
     * @param  string $flag
     */
    public function addOrderProducts($request, $orderId, $flag)
    {
        $productsIds = $flag == "select_all"? $request->select_item : array_map('intval', explode(',', $request->select_manually));

        foreach($productsIds as $productId)
        {
            $product =  Product::where('id', $productId)->where('active', 1)->first();
                    
            if( !is_null($product) )
                OrderProduct::create([
                    'product_id'        => $product->id,
                    'order_id'          => $orderId,
                    'amount'            => $request->amount,
                    'unit'              => $request->unit,
                    'note'              => $request->note,
                ]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $module_name_plural = $this->getClassNameFromModel();
        $module_name_singular = $this->getSingularModelName();
        $row = $this->model->findOrFail($id);

        return VIEW('dashboard.' . $module_name_plural . '.show', compact('module_name_singular', 'module_name_plural', 'row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = $this->model->findOrFail($id);
        
        $rules = [
            'decision' => 'required|in:accepted,refused,proccessing,done',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [       
                $locale . '.message'        => 'required|string|min:3|max:500',
            ];
        }
        $request->validate($rules);

        # Update order
        $order->update(['status' => $request->decision]);

        # Save log for super_admin
        $this->addLog([
            'log_type'	=> $this->getClassNameFromModel(),
            'log_id'  	=> $order->id,
            'message' 	=> $this->getSingularModelName().'_has_been_updated',
            'action_by'	=> auth()->user()->id,
        ]);

        # Notify pharmacy owner
        $this->setFirebase('to', $order->from->fcm_token, null);
        $title   = ['en'=>"Order updated",   'ar'=>"تحديث طلب"];
        $message = ['en'=>$request['en']['message'], 'ar'=>$request['ar']['message']];
        $order->from->notify(new OrderUpdates($message, $title, $order->id));

        return redirect()->route('dashboard.orders.show', ['order'=>$order->id]);
    }
}
