<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Dashboard\BackEndController;
use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends BackEndDatatableController
{
    public function __construct(Product $model, ProductDataTable $proDataTable)
    {
        parent::__construct($model, $proDataTable);
    }

    public function store(Request $request)
    {
        // return $request;
        if ($request->file()) {
            return $this->storeFromExcel($request);
        }
        // return $request;
        $rules = [
            'image' => 'nullable|image|max:2048',
            'amount' => 'required',
            'unit_price' => 'required',
            'expiry_date' => 'required',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name'        => 'required|string|min:3|max:200',
                $locale . '.description' => 'nullable|string|min:3|max:500',
                $locale . '.unit' => 'required|string|min:2|max:200',
                $locale . '.type' => 'required|string|min:2|max:200',
            ];
        }
        $request->validate($rules);

        $request_data = $request->except(['_token', 'image']);
        // $request_data['owner_id'] = auth()->user()->id;

        if ($request->image) {
            $request_data['image'] = $this->uploadImage($request->image, $this->getClassNameFromModel() . '_images');
        }

        $product = $this->model->create($request_data);
    
        $data = [
        	'log_type'	=> $this->getClassNameFromModel(),
        	'log_id'  	=> $product->id,
    		'message' 	=> $this->getSingularModelName().'_has_been_added',
        	'action_by'	=> auth()->user()->id,
    	];
    	$this->addLog($data);
    
        session()->flash('success', __('site.add_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
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
        $product = $this->model->findOrFail($id);
        $rules = [
            'image' => 'nullable|image|max:2000',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name'        => 'required|string|min:3|max:200',
                $locale . '.description' => 'nullable|string|min:3|max:500',
            ];
        }
        $request->validate($rules);

        $request_data = $request->except(['_token', 'image']);
        if ($request->image) {
            if ($product->image != null) {
                Storage::disk('public_uploads')->delete($this->getClassNameFromModel() . '_images/' . $product->image);
            }
            $request_data['image'] = $this->uploadImage($request->image, $this->getClassNameFromModel() . '_images');
        } //end of if

        $product->update($request_data);
    	
    	$data = [
        	'log_type'	=> $this->getClassNameFromModel(),
        	'log_id'  	=> $product->id,
    		'message' 	=> $this->getSingularModelName().'_has_been_updated',
        	'action_by'	=> auth()->user()->id,
    	];
    	$this->addLog($data);
    
        session()->flash('success', __('site.updated_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $product = $this->model->findOrFail($id);
        if ($product->image != null) {
            Storage::disk('public_uploads')->delete($this->getClassNameFromModel() . '_images/' . $product->image);
        }
    	
    	$data = [
        	'log_type'	=> $this->getClassNameFromModel(),
        	'log_id'  	=> $product->id,
    		'message' 	=> $this->getSingularModelName().'_has_been_deleted',
        	'action_by'	=> auth()->user()->id,
    	];
    	$this->addLog($data);
    
        $product->delete();
        session()->flash('success', __('site.deleted_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }


    public function downloadSheet()
    {
        $file = Storage::disk('public_uploads')->download('\sheetExcel/products.xlsx');

        return $file;
    }

    public function storeFromExcel($request)
    {
        $file = $request->file('excel');
        // dd( Excel::import(new SuppliersImport, $file));

        $import = new ProductsImport;
        Excel::import($import, $file);
        $MYData =  ($import->data);

        $newOne = array();

        for ($i = 1; $i < count($MYData); $i++) {
            if ($MYData[$i]->filter()->isNotEmpty()) {
                $newOne['owner_id'][]        = auth()->user()->id;
                $newOne['category_id'][]     = intval($MYData[$i][0]);
                $newOne['brand_id'][]        = intval($MYData[$i][1]);
                $newOne['amount'][]          = intval($MYData[$i][2]);
                $newOne['unit_price'][]      = intval($MYData[$i][3]);
                $newOne['expiry_date'][]     = intval($MYData[$i][4]);
                // 'expiry_date'     =>  Carbon::createFromFormat('Y-m-d', time())->timestamp,
                // 'expiry_date'     =>  Carbon::createFromFormat('Y-m-d', time())->timestamp,
                // 'expiry_date'     => date('Y-m-d H:i:s', strtotime($MYData[4])),
                $newOne['active'][]          = intval($MYData[$i][5]);
                $newOne['ar'][]                  = [
                    'name'         => $MYData[$i][6],
                    'description'  => $MYData[$i][8],
                    'unit'         => $MYData[$i][10],
                    'type'         => $MYData[$i][12],
                ];
                $newOne['en'][]                   = [
                    'name'         => $MYData[$i][7],
                    'description'  => $MYData[$i][9],
                    'unit'         => $MYData[$i][10],
                    'type'         => $MYData[$i][13],
                ];
            }
        }

        // return $newOne;
        for ($i = 0; $i < count($newOne['category_id']); $i++) {
            $this->model->create([
                'owner_id'        => auth()->user()->id,
                'category_id'     => $newOne['category_id'][$i],
                'brand_id'        => $newOne['brand_id'][$i],
                'amount'          => $newOne['amount'][$i],
                'unit_price'      => $newOne['unit_price'][$i],
                'expiry_date'     => $newOne['expiry_date'][$i],
                // 'expiry_date'     =>  Carbon::createFromFormat('Y-m-d', time())->timestamp,
                'expiry_date'     => null,
                'active'          => $newOne['active'][$i],
                'ar'                  => [
                    'name'         => $newOne['ar'][$i]['name'],
                    'description'  => $newOne['ar'][$i]['description'],
                    'unit'         => $newOne['ar'][$i]['unit'],
                    'type'         => $newOne['ar'][$i]['type'],
                ],
                'en'                   => [
                    'name'         => $newOne['en'][$i]['name'],
                    'description'  => $newOne['en'][$i]['description'],
                    'unit'         => $newOne['en'][$i]['unit'],
                    'type'         => $newOne['en'][$i]['type'],
                ],
            ]);
        }

        session()->flash('success', __('site.add_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }
}
