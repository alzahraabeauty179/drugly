@extends('dashboard.layouts.app')

{{-- @section('title', __('site.' . $module_name_plural . '.add')) --}}

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-1">
                    <h3 class="content-header-title">Add Sub-Category</h3>
                </div>
                <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item"><a href="categories.html">Categories</a></li>
                            <li class="breadcrumb-item active">Add Sub-Category</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="form-control-repeater">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-capitlaize" id="file-repeater"><i class="ft-plus"></i> Add Sub-Category</h4>
                                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form row">
                                            <div class="form-group col-md-6 mb-2">
                                                <input type="text" class="form-control" placeholder="Sub-Category Name EN" name="medicament">
                                            </div>
                                            <div class="form-group col-md-6 mb-2">
                                                <input type="text" class="form-control" placeholder="Sub-Category Name AR" name="medicament">
                                            </div>
                                            <fieldset class="form-group col-md-6 mb-2">
                                                <!-- <label for="basicInputFile">Upload Photo</label> -->
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile01">
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                </div>
                                            </fieldset>
                                            <div class="form-group col-md-6 mb-2">
                                                <select name="interested" class="form-control">
                                                    <option value="none" selected="" disabled="">Choose Category</option>
                                                    <option value="Category">Category</option>
                                                    <option value="Category">Category</option>
                                                    <option value="Category">Category</option>
                                                    <option value="Category">Category</option>
                                                    <option value="Category">Category</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <button type="button" data-repeater-create="" class="btn btn-primary">
                                                    <i class="ft-plus"></i> Add
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection