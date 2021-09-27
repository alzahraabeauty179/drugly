<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;

use App\DataTables\StoreDataTable;
use App\Models\Store;
use App\Models\Product;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProductResource;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SearchSheetImport;

use Validator;
use DB;
use DataTables;

class StoreController extends BackEndController
{

    protected $model;
    protected $dataTable;
	/**
     * Constructor.
     */
    public function __construct(Store $model, StoreDataTable $datatable)
    {
        $this->model = $model;
        $this->dataTable = $datatable;
    }

    /**
     * Show all model data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $module_name_plural = $this->getClassNameFromModel();
        
        return $this->dataTable->render('dashboard.' . $module_name_plural . '.index', compact('module_name_plural'));
    }

    /**
     * Download order sheet example.
     *
     * @return File
     */
    public function downloadOrderSheet()
    {
        $file = Storage::disk('public_uploads')->download('\sheetExcel/orderSheet.xlsx');

        return $file;
    }

    /**
     * Download search products sheet example.
     *
     * @return File
     */
    public function downloadSearchProductsSheet()
    {
        $file = Storage::disk('public_uploads')->download('\sheetExcel/searchProductsSheet.xlsx');

        return $file;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # check if user have accepted subscribe
        $accepted = User::where('id', auth()->user()->id)->whereHas('subscribes', function (Builder $r) {
    												$r->where('status', 'accepting');
												})->get();
        if(count($accepted)){         
            $rules = [
                'email' => 'required|string|email|max:191|unique:app_settings,email',
                'phone' => 'required|regex:/^\+?\d[0-9-]{9,11}$/|unique:app_settings,phone',
                'logo' => 'nullable|image|max:2000',         
                'facebook_link'=>'nullable|string|max:191',
                'twitter_link'=>'nullable|string|max:191',
                'instagram_link'=>'nullable|string|max:191',
                'youtube_link'=>'nullable|string|max:191',
            ];

            foreach (config('translatable.locales') as $locale) {
                $rules += [
                    $locale . '.name'        => 'required|string|min:3|max:200',
                    $locale . '.description' => 'required|string|min:3|max:500',
                    $locale . '.about_us' => 'required|string|min:3|max:500',
                    $locale . '.privacy_policy' => 'required|string|min:3|max:500',
                ];
            }

            $validator = Validator::make($request->all(), $rules);
            if($validator->fails())
                return redirect()->back()->with(["updateWebsiteErrorMessage" => $validator->errors()->first()]);
    
            $request_data = $request->except(['_token', 'logo']);
            $request_data['owner_id'] = auth()->user()->id;

            // return $request_data;
            if ($request->logo) {
                $request_data['image'] = $this->uploadImage($request->logo, 'store_settings_images');
            }

            $request_data['type'] = auth()->user()->type;

            $setting = $this->model->create($request_data);
            User::where('id', auth()->user()->id)->update(['store_id'=>$setting->id]);
        
            $data = [
                'log_type'	=> $this->getClassNameFromModel(),
                'log_id'  	=> $setting->id,
                'message' 	=> $this->getSingularModelName().'_has_been_added',
                'action_by'	=> auth()->user()->id,
            ];
            $this->addLog($data);

            session()->flash('success', __('site.website_info_added_successfully'));
        }else
            session()->flash('error', __('site.subscribe_not_accepted'));

        return redirect()->route('dashboard.users.edit', ['user' => auth()->user()->id]);
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

        return view('dashboard.' . $module_name_plural . '.show', compact('module_name_singular', 'module_name_plural', 'row'));
    }

    /**
     * Display the store products resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showStoreProducts($id)
    {
        $module_name_plural = $this->getClassNameFromModel();
        $module_name_singular = $this->getSingularModelName();
  
        return VIEW('dashboard.' . $module_name_plural . '.products', compact('module_name_singular', 'module_name_plural'));
    }

    /**
     * Get the store products.
     *
     * @return \Illuminate\Http\Response
     */
    public function Products()
    {
        $query = Product::whereHas('store', function(Builder $q){
                            $q->where('id', request()->store);
                        });

        return Datatables::of($query)
            ->addColumn('<input type="checkbox" class="select-all checkbox" name="select-all">', function ($query) {
                return  '<input type="checkbox" class="select-item checkbox"
                name="select_items[]" value="'.$query->id.'" onClick="javascript:SelectProduct(this, value);" />';
            })
            ->addColumn('name', function ($query) {
                return  '<span title="'.$query->translation->name.' - '.$query->translation->type.' - '.$query->getExpiryDate($query->id).
                        '">'.$query->translation->name.'</span>';
            })
            ->addColumn('type', function ($query) {
                return  $query->translation->type;
            })
            ->addColumn('available', function ($query) {
                return $query->amount.' '.$query->unit;
            })
            ->addColumn('unit_price', function ($query) {
                return $query->unit_price.' $';
            })
            ->order(function ($query) {
                if (request()->order[0]['column'] == 3) {
                    $query->orderBy('amount', request()->order[0]['dir']);
                }

                if (request()->order[0]['column'] == 4) {
                    $query->orderBy('unit_price', request()->order[0]['dir']);
                }
            })
            ->filter(function ($query) {
                return $query
                    ->where('owner_id', request()->store)
                    ->where(function ($w) {
                        return $w->whereTranslationLike('name', "%" . request()->search['value'] . "%")
                            ->orwhereTranslationLike('type', "%" . request()->search['value'] . "%")
                            ->orwhereTranslationLike('unit', "%" . request()->search['value'] . "%")
                            ->orwhere('amount', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('unit_price', 'like', "%" . request()->search['value'] . "%");
                    });
            })
            ->rawColumns(['<input type="checkbox" class="select-all checkbox" name="select-all">', 'name'])
            ->make(true);
    }

    /**
     * Search in stores by product name to return 
     * the related stores.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json data
     */
    public function searchByProduct(Request $request)
    {
        if( is_null($request->keyword) )
            $products = [];
        else
            $products = Product::join('product_translations', 'products.id', '=', 'product_translations.product_id')
                        ->select('product_translations.name', 'product_translations.type', DB::raw('COUNT(*) AS total'))
                        ->whereTranslationLike('name', "%" . $request->keyword . "%")
                        ->orWhereTranslationLike('description', "%" . $request->keyword . "%")
                        ->whereHas('store', function (Builder $q) { $q->where('type', $_REQUEST['type']); })
                        ->where('active', 1)->groupBy('product_translations.name', 'product_translations.type')->get();
    
        return response()->json( ['products'=>ProductResource::collection($products)] );
    }

    /**
     * Get the selected product from all the stores have it.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json data
     */
    public static function searchResult(Request $request)
    {
        $products = Product::whereTranslationLike('name', "%" . $request->keyword . "%")
                    ->whereHas('store', function (Builder $q) { $q->where('type', $_REQUEST['type']); })->get();
        
        return response()->json( ['products'=>ProductResource::collection($products)] );
    }

    /**
     * Add filter to the search result.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json data
     */
    public static function searchResultFilter(Request $request)
    {
        $products = Product::whereTranslationLike('name', "%" . $request->keyword . "%")
                    ->whereHas('store', function (Builder $q) { $q->where('type', $_REQUEST['type']); });
        
        if($request->filter == "discount-rate")
            $products = $products->orderBy('unit_price', 'asc')->get();
        elseif($request->filter == "top-units")
            $products = $products->orderBy('amount', 'desc')->get();
        
        return response()->json( ['products'=>ProductResource::collection($products)] );
    }

    /**
     * Search in products by excel sheet.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json data
     */
    public static function searchSheet(Request $request)
    {
        $rules = [
            'search_sheet'   => 'required|mimes:xlsx',
        ];
        $request->validate($rules);
        
        $searchResult = [];
        $searchResult = Excel::toArray(new SearchSheetImport, $request->search_sheet);
        $products = [];

        foreach ($searchResult[0] as $index => $row) {
            if ($index <> 0) {
                $product =  Product::whereTranslationLike('name', "%" . $row[0] . "%")->whereTranslationLike('type', "%" . $row[1] . "%")
                ->where('amount', '>=', $row[2])->where('active', 1)->pluck('id');
                
                if( is_null($product) )
                {
                    $product2 = Product::whereTranslationLike('name', "%" . $row[0] . "%")->whereTranslationLike('type', "%" . $row[1] . "%")
                    ->where('amount', '<=', $row[2])->where('active', 1)->pluck('id');

                    if( !is_null($product2) )
                        array_push($products, $product);
                }
                else{
                    array_push($products, $product);
                    
                }
            }
        }

        // Validator::make($searchResult, [
        //     '*.0'  => 'required|max:191',
        //     '*.1'  => 'required|max:191',
        //     '*.2'  => 'required|integer|min:1'
        // ])->validate();
        
        $searchProducts = [];
        foreach($products as $prodctsIds)
        {
            $product3 =  Product::whereIn('id', $prodctsIds)->distinct()->get();
            array_push($searchProducts, $product3);
        }
        $tableCounter = count($searchProducts);
        return view('dashboard.stores.searchSheet', compact('searchProducts', 'tableCounter'));
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
        $Store = $this->model->findOrFail($id);
        $rules = [
            'email' => 'required|string|email|max:191|unique:app_settings,email,'.$Store->id,
            'phone' => 'required|regex:/^\+?\d[0-9-]{9,11}$/|unique:app_settings,phone,'.$Store->id,
            'logo' => 'nullable|image|max:2000',         
            'facebook_link'=>'nullable|string|max:191',
            'twitter_link'=>'nullable|string|max:191',
            'instagram_link'=>'nullable|string|max:191',
            'youtube_link'=>'nullable|string|max:191',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name'        => 'required|string|min:3|max:200',
                $locale . '.description' => 'required|string|min:3|max:500',
                $locale . '.about_us' => 'required|string|min:3|max:500',
                $locale . '.privacy_policy' => 'required|string|min:3|max:500',
            ];
        }

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
			return redirect()->back()->with(["updateWebsiteErrorMessage" => $validator->errors()->first()]);

        $request_data = $request->except(['_token', 'logo']);
        $request_data['owner_id'] = auth()->user()->id;

        if ($request->logo) {
            if ($Store->image != null) {
                Storage::disk('public_uploads')->delete('store_settings_images/' . $Store->image);
            }
            $request_data['image'] = $this->uploadImage($request->logo, 'store_settings_images');
        } //end of if

        $Store->update($request_data);
    	
    	$data = [
        	'log_type'	=> $this->getClassNameFromModel(),
        	'log_id'  	=> $Store->id,
    		'message' 	=> $this->getSingularModelName().'_has_been_updated',
        	'action_by'	=> auth()->user()->id,
    	];
    	$this->addLog($data);
    
        session()->flash('success', __('site.website_updated_successfully'));
        return redirect()->route('dashboard.users.edit', ['user' => auth()->user()->id]);
    }
}
