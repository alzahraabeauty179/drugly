<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\StagnantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Stagnant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StagnantsController extends BackEndDatatableController
{
    public function __construct(Stagnant $model, StagnantDataTable $catDataTable)
    {
        parent::__construct($model, $catDataTable);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name'          => 'required|string|min:5|max:150',
            'description'   => 'nullable|string|min:5|max:150',
            'amount'        => 'required|numeric|min:1|max:200',
            'expiry_date'   => 'nullable|date',
            'price'         => 'required|numeric|min:1|max:1000',
            'discount'      => 'nullable|numeric|min:1|max:1000',
            'image'         => 'nullable|image|max:2048',
            'stagnant_id'   => ['nullable','numeric', Rule::exists('stagnants', 'id')->whereNull('stagnant_id')],
        ]);

        $request_data = $request->except(['_token', 'image']);
        $request_data['owner_id'] = auth()->user()->id;

        if ($request->image) {
            $request_data['image'] = $this->uploadImage($request->image, $this->getClassNameFromModel() . '_images');
        }

        $this->model->create($request_data);
        session()->flash('success', __('site.add_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

    public function update(Request $request, $id)
    {
        $stagnant = $this->model->findOrFail($id);
        $request->validate([
            'name'          => 'required|string|min:5|max:150',
            'description'   => 'nullable|string|min:5|max:150',
            'amount'        => 'required|numeric|min:1|max:200',
            'expiry_date'   => 'nullable|date',
            'price'         => 'required|numeric|min:1|max:1000',
            'discount'      => 'nullable|numeric|min:1|max:1000',
            'image'         => 'nullable|image|max:2048',
        ]);

        $request_data = $request->except(['_token', 'image']);
        if ($request->image) {
            if ($stagnant->image != null) {
                Storage::disk('public_uploads')->delete($this->getClassNameFromModel() . '_images/' . $stagnant->image);
            }
            $request_data['image'] = $this->uploadImage($request->image, $this->getClassNameFromModel() . '_images');
        } //end of if

        $stagnant->update($request_data);
        session()->flash('success', __('site.updated_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

}

