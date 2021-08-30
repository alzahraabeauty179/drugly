<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\OrderDataTable;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Storage;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OrderSheetImport;
use Illuminate\Database\Eloquent\Builder;

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
     * Show orders to the non super admin users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showOrders()
    {
        if( auth()->user()->type == "pharmacy" )
            $query = Order::where('from_id', auth()->user()->id)->where('status', request()->status);
        else
            $query = Order::where('to_id', auth()->user()->id)->where('status', request()->status);

        return 
        auth()->user()->type == "pharmacy"?
            Datatables::of($query)
                ->addColumn('store', function ($query) {
                    return '<a href="'.route('dashboard.stores.show', [ 'store' => $query->to_id ]).'" ><i class="glyphicon glyphicon-edit"></i> '.$query->to->name.'</a>';

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
                        ->where('from_id', auth()->user()->id)->where('status', request()->status)
                        ->where(function ($w) {
                            return $w->whereHas('to', function (Builder $q) {
                                    $q->where('name', 'like', '%'.request()->search['value'].'%');
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
                        ->where('to_id', auth()->user()->id)->where('status', request()->status)
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'order_sheet'   => 'required|mimes:xlsx',
            'store_id'      => 'required|exists:stores,id'
        ];
        $request->validate($rules);

        # Create order 
        $order = Order::create([
            'from_id'   => auth()->user()->id,
            'to_id'     => $request->store_id,
            'status'    => 'waiting',
        ]);

        # Create order products
        Excel::import(new OrderSheetImport($order->id), $request->order_sheet);

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
                'message' 	=> $this->getSingularModelName().'_has_been_updated',
                'action_by'	=> auth()->user()->id,
                ]);

            # Notify store owner
            // not yet
        }

        return redirect()->route('dashboard.stores.products', ['store'=>$request->store_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
