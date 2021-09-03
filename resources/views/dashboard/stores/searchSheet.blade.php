@extends('dashboard.layouts.app')

@section('title', __('site.search_sheet_result'))

@section('content')
<div class="app-content content">

    <div class="container-fluid row d-flex justify-content-center">
        @if(count($errors->getMessages()) > 0)
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>@lang('site.excel_validation_errors')</strong>
                <ul>
                    @foreach($errors->getMessages() as $errorMessages)
                        @foreach($errorMessages as $errorMessage)
                            <li>
                                {{ $errorMessage }}
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>                           
        @endif

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
                <h3 class="content-header-title"> @lang('site.search_sheet_result')</h3>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('site.home' )</a>
                        </li>
                        <li class="breadcrumb-item active"> @lang('site.search_sheet_result')</li>
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
                                <h4 class="card-title"> @lang('site.search_sheet_result')</h4>
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
                            <!-- Advanced Search -->
                            <div class="col-12">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-md-5">
                                        <div class="row d-flex justify-content-center align-items-center">
                                            <!-- Upload Search Excel -->
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <form   enctype="multipart/form-data" method="POST"
                                                            action="{{ route('dashboard.stores.searchSheet') }}">
                                                            @method('POST')
                                                            @csrf
                                                        <div class="form-group">
                                                            <label for="search_sheet">@lang('site.upload_search_excel')</label>
                                                            <input type="file" class="form-control-file" name="search_sheet" />
                                                        </div>
                                                        <button class="btn btn-primary btn-sm">
                                                            <i class="ft-plus"></i> @lang('site.search')
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- ./Upload Search Excel -->
                                        </div>
                                    </div>

                                    <!-- Result Filter -->
                                    <div  id="search-result-filter" class="col-md-4" style="display: none;">
                                        <div class="row d-flex justify-content-center align-items-center">
                                            <div class="col-md-6">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="customCheck" id="discount-rate">
                                                    <label class="custom-control-label" style="margin-left: 20px;"
                                                        for="discount-rate">@lang('site.discount_rate')</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="customCheck" id="top-units">
                                                    <label class="custom-control-label" style="margin-left: 20px;"
                                                        for="top-units">@lang('site.top_units')</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./Result Filter -->
                                </div>
                            </div>
                            <!-- ./Advanced Search -->
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard" id="products-container">
                                    @forelse( $searchProducts as $key=>$searchProduct )
                                        <table class="table table-striped table-bordered zero-configuration" id="prodcuts-table-{{$key++}}">
                                            <thead>
                                                <tr>
                                                    <th>@lang('site.product')</th>
                                                    <th>@lang('site.type')</th>
                                                    <th>@lang('site.available')</th>
                                                    <th>@lang('site.store')</th>
                                                    <th>@lang('site.start_order')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($searchProduct as $storeProduct)
                                                <tr>
                                                    <td> 
                                                        {{ $storeProduct->name }}
                                                    </td>
                                                    <td> 
                                                        {{ $storeProduct->type }}
                                                    </td>
                                                    <td> 
                                                        {{ $storeProduct->amount.' '.$storeProduct->unit }}
                                                    </td>
                                                    <td> <a href="{{ route('dashboard.stores.show', [ 'store' => $storeProduct->store->id ]) }}" >
                                                        {{ $storeProduct->store->name }} </a> 
                                                    </td>
                                                    <td><a  href="{{ route('dashboard.stores.products', ['store' => $storeProduct->store->id]) }}" 
                                                            title="{{__('site.start_order')}}" class="btn btn-info btn-sm" 
                                                            data-original-title="{{__('site.start_order')}}"><i class="ft-eye"> {{__('site.start_order')}} </i></a></td>
                                                </tr>
                                                @empty
                                                <tr><td colspan="5" style="text-align: center;"><h4>@lang('site.no_records')</h4></td></tr>
                                            @endforelse
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>@lang('site.product')</th>
                                                    <th>@lang('site.type')</th>
                                                    <th>@lang('site.available')</th>
                                                    <th>@lang('site.store')</th>
                                                    <th>@lang('site.start_order')</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    @empty
                                        <h1 style="text-align: center;">@lang('site.there_is_no_result')</h1>
                                    @endforelse
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
<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

{{-- end  datatables style for yajar package --}}
@endpush

@push('script')
    {{-- start datatables script for yajar package --}}
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
            crossorigin="anonymous">
    </script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready( function () {
            for(var i=1; i <= {{$tableCounter}}; i++ )
                $('#prodcuts-table-'+i).DataTable();
        });
    </script>
@endpush