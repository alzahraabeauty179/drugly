@php
    $module_name_singular = 'category';
    $module_name_plural   = 'categories';
@endphp
@extends('dashboard.layouts.app')

@section('title', __('site.'.$module_name_plural))

@section('content')
<div class="app-content content">

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-1">
                <h3 class="content-header-title">@lang('site.'.$module_name_plural )</h3>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('site.home' )</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('site.'.$module_name_plural )</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-md-12 mb-1">
                        <a class="btn btn-info" href="{{route('dashboard.'.$module_name_plural.'.create')}}"><i
                                class="ft-plus"></i> @lang('site.add')  @lang('site.'.$module_name_singular )</a>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('site.'.$module_name_plural )</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
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

                                    {!! $dataTable->table() !!}

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

@push('style')

{{-- start datatables style for yajar package --}}
<!-- Bootstrap CSS -->
{{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
{{-- <link rel="stylesheet" href="{{ asset('dashboard_files/datatable/jquery.dataTables.min.css') }}"> --}}

{{-- end  datatables style for yajar package --}}
@endpush
@push('script')
 {{-- start datatables script for yajar package --}}
    <!-- jQuery -->
    {{-- <script src="//code.jquery.com/jquery.js"></script> --}}
    <!-- DataTables -->
    {{-- <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script> --}}
    <script src="{{ asset('dashboard_files/datatable/jquery.dataTables.min.js') }}"></script>
    <!-- Bootstrap JavaScript -->
    {{-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> --}}
    {{-- end  datatables script for yajar package --}}
    {!! $dataTable->scripts() !!}


@endpush