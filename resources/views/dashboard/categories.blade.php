@extends('dashboard.layouts.app')

{{-- @section('title', __('site.' . $module_name_plural . '.add')) --}}

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-1">
                    <h3 class="content-header-title">Categories</h3>
                </div>
                <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <a class="btn btn-info" href="add-category.html"><i class="ft-plus"></i> Add Category</a>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Categories</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="fa fa-ellipsis-v font-medium-3"></i></a>
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
                                    <div class="card-body card-dashboard">
                                        <table class="table table-striped table-bordered cat-configuration">
                                            <thead>
                                                <tr>
                                                    <th>Category EN</th>
                                                    <th>Sub Category EN</th>
                                                    <th>Category AR</th>
                                                    <th>Sub Category AR</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Category Name</td>
                                                    <td>Sub Category Name</td>
                                                    <td>اسم القسم</td>
                                                    <td>اسم القسم الفرعي</td>
                                                    <td><a class="btn btn-info" href="#"><i class="fa fa-cog fa-fw"></i> Edit</a></td>
                                                    <td><a class="btn btn-danger" href="#"><i class="fa fa-times fa-fw"></i>Delete</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Category Name</td>
                                                    <td>Sub Category Name</td>
                                                    <td>اسم القسم</td>
                                                    <td>اسم القسم الفرعي</td>
                                                    <td><a class="btn btn-info" href="#"><i class="fa fa-cog fa-fw"></i> Edit</a></td>
                                                    <td><a class="btn btn-danger" href="#"><i class="fa fa-times fa-fw"></i>Delete</a></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Category EN</th>
                                                    <th>Sub Category EN</th>
                                                    <th>Category AR</th>
                                                    <th>Sub Category AR</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Zero configuration table -->
            </div>
        </div>
    </div>
@endsection