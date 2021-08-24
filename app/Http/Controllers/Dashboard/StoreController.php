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
use Validator;
use DB;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
                $locale . '.description' => 'nullable|string|min:3|max:500',
                $locale . '.about_us' => 'nullable|string|min:3|max:500',
                $locale . '.privacy_policy' => 'nullable|string|min:3|max:500',
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

        return view('dashboard.' . $module_name_plural . '.show', compact('module_name_singular', 'module_name_plural'));
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
                $locale . '.description' => 'nullable|string|min:3|max:500',
                $locale . '.about_us' => 'nullable|string|min:3|max:500',
                $locale . '.privacy_policy' => 'nullable|string|min:3|max:500',
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
