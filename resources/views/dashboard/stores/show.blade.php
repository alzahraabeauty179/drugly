@extends('dashboard.layouts.app')

@section('title', __('site.'.$module_name_plural))

@section('content')
    <div class="app-content content">
        <div class="container-fluid row d-flex justify-content-center">
            @if(session('success'))
                <div class="alert alert-success col-sm-6 text-center" role="alert">
                    {!! session('success') !!}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger col-sm-6 text-center" role="alert">
                    {!! session('error') !!}
                </div>
            @endif
        </div>

        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-1">
                    <h3 class="content-header-title">@lang('site.'.$module_name_plural)</h3>
                </div>
                <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('site.home')</a>
                            </li>
                            <li class="breadcrumb-item active">@lang('site.'.$module_name_plural)</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">@lang('site.'.$module_name_plural)</h4>
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
                                <!-- Advanced Search -->
                                <div class="col-12">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-md-5">
                                            <div class="row d-flex justify-content-center align-items-center">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <select class="select2 form-control"
                                                            id="single_disabled_result">
                                                            <optgroup label="Alaskan/Hawaiian Time Zone">
                                                                <option value="AK">Alaska</option>
                                                                <option value="HI" disabled>Hawaii(disabled)</option>
                                                            </optgroup>
                                                            <optgroup label="Pacific Time Zone">
                                                                <option value="CA">California</option>
                                                                <option value="NV">Nevada</option>
                                                                <option value="OR" disabled>Oregon(disabled)</option>
                                                                <option value="WA">Washington</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <form action="">
                                                            <label for="">Upload Excel</label>
                                                            <input type="file" class="form-control-file" />
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row d-flex justify-content-center align-items-center">
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            name="customCheck" id="customCheck2">
                                                        <label class="custom-control-label" style="margin-left: 20px;"
                                                            for="customCheck2">Discount Rate</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            name="customCheck" id="customCheck3">
                                                        <label class="custom-control-label" style="margin-left: 20px;"
                                                            for="customCheck3">Top Units</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="select2 form-control" id="single_disabled_result">
                                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                                    <option value="AK">Stores</option>
                                                    <option value="HI" disabled>Hawaii(disabled)</option>
                                                </optgroup>
                                                <optgroup label="Pacific Time Zone">
                                                    <option value="CA">California</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="OR" disabled>Oregon(disabled)</option>
                                                    <option value="WA">Washington</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./Advanced Search -->
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table class="table table-striped table-bordered cat-configuration">
                                            <thead>
                                                <tr>
                                                    <th class="active">
                                                        <input type="checkbox" class="select-all checkbox"
                                                            name="select-all" />
                                                    </th>
                                                    <th>Product Name</th>
                                                    <th>Available</th>
                                                    <th>Store Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="active">
                                                        <input type="checkbox" class="select-item checkbox"
                                                            name="select-item" value="1000" />
                                                    </td>
                                                    <td>Product Test 1</td>
                                                    <td>50 Units</td>
                                                    <td>Store Test 1</td>
                                                </tr>
                                                <tr>
                                                    <td class="active">
                                                        <input type="checkbox" class="select-item checkbox"
                                                            name="select-item" value="1000" />
                                                    </td>
                                                    <td>Product Test 2</td>
                                                    <td>50 Units</td>
                                                    <td>Store Test 2</td>
                                                </tr>
                                                <tr>
                                                    <td class="active">
                                                        <input type="checkbox" class="select-item checkbox"
                                                            name="select-item" value="1000" />
                                                    </td>
                                                    <td>Product Test 3</td>
                                                    <td>50 Units</td>
                                                    <td>Store Test 3</td>
                                                </tr>
                                                <tr>
                                                    <td class="active">
                                                        <input type="checkbox" class="select-item checkbox"
                                                            name="select-item" value="1000" />
                                                    </td>
                                                    <td>Product Test 4</td>
                                                    <td>50 Units</td>
                                                    <td>Store Test 4</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="col-md-12 mt-1">
                                            <a class="btn btn-primary" href=""><i class="ft-plus"></i> Order Now</a>
                                        </div>
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

@push('script')
    <script>
        $(function (e) {
            $(".select-all").click(function () {
                $(".select-item").prop('checked', $(this).prop('checked'));
            });
        });
    </script>
@endpush