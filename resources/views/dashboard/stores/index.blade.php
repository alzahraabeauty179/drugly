@extends('dashboard.layouts.app')

@section('title', isset($_REQUEST['medical_store'])? __('site.warehouses'):__('site.cosmetic_companies'))

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
                <h3 class="content-header-title"> @if( isset($_REQUEST['medical_store']) ) @lang('site.warehouses') @else @lang('site.cosmetic_companies') @endif </h3>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('site.home' )</a>
                        </li>
                        <li class="breadcrumb-item active"> @if( isset($_REQUEST['medical_store']) ) @lang('site.warehouses') @else @lang('site.cosmetic_companies') @endif </li>
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
                                <h4 class="card-title"> @if( isset($_REQUEST['medical_store']) ) @lang('site.warehouses') @else @lang('site.cosmetic_companies') @endif </h4>
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
                                            <!-- Search by products -->
                                            <div class="col-6" style="display: block ruby;">
                                                <i class="ficon ft-search" id="find-product" style="cursor: pointer;"></i>
                                                <div class="form-group">
                                                    <input type="text" placeholder="@lang('site.product_search')" class="form-control" id="search-by-products">
                                                </div>
                                            </div>
                                            <!-- ./Search by products -->
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
                                    {!! $dataTable->table(['class' => 'table table-bordered', ]) !!}
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

{{csrf_field()}}

@push('style')
{{-- start datatables style for yajar package --}}
<!-- Bootstrap CSS -->
<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">

{{-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" > --}}

{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> --}}

{{-- end  datatables style for yajar package --}}

{{-- Search by products  --}}
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
<script src="{{ asset('js/jquery-ui.js') }}"></script>
@endpush


@push('script')
{{-- start datatables script for yajar package --}}
<!-- jQuery -->
<!-- <script src="//code.jquery.com/jquery.js"></script> -->
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{!! $dataTable->scripts() !!}

{{-- Search by products  --}}
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script>
    var type = "{{ isset($_REQUEST['medical_store'])? 'medical_store' : 'beauty_company' }}", products_name = [];

    $(document).on('keyup','#search-by-products',function(event){
        $.post("{{ route('dashboard.stores.searchByProduct') }}",{'keyword':$('#search-by-products').val(),'type':type,'_token':$('input[name=_token]').val()},function(data){
            
            if( data["products"].length != 0)
                products_name = data.products.map(function (value, index, array) { return value.name; });
       
            $("#search-by-products").autocomplete({ source: products_name });
        })
    });

    function dispalySearchResult(data)
    {
        if( $('#search-by-products').val() != "" )
            {
                $("#storedatatable-table_wrapper").empty();

                var container = "", url = "{{ route('dashboard.stores.show', [ 'store' => ':id']) }}";

                $.each(data.products,function(key,val){
                    url         =   url.replace(':id', val.storeId);
                    container   +=  `<tr>
                                        <td>`+val.storeId+`</td>
                                        <td>`+val.storeName+`</td>
                                        <td>`+val.amount+' '+val.unit+`</td>
                                        <td>$ `+val.unitPrice+`</td>
                                        <td><a href="`+url+`" title="{{__('site.show')}}" class="btn btn-info btn-sm" data-original-title="{{__('site.show')}}"><i class="ft-eye"> {{__('site.show')}} </i></a></td>
                                    </tr>`;
                });
       
                $("#products-container").append(`
                    <table class="table table-striped table-bordered cat-configuration" id="searchResultTable">
                        <thead>
                            <tr>
                                <th>{{__('site.id')}}</th>
                                <th>{{isset($_REQUEST['medical_store'])? __('site.warehouses') : __('site.cosmetic_companies')}}</th>
                                <th>{{__('site.available')}}</th>
                                <th>{{__('site.unit_price')}}</th>
                                <th>{{__('site.show')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            `+
                                container
                            +`
                        </tbody>
                    </table>
                `);
            }
    }

    $(document).on('click','#find-product',function(event){
        $.post("{{ route('dashboard.stores.searchResult') }}",{'keyword':$('#search-by-products').val(),'_token':$('input[name=_token]').val(),'type':type},function(data){
            dispalySearchResult(data);
        }).then( function(){
            $('#searchResultTable').DataTable();
            $('#search-result-filter').css('display', '');
        }).then( function(){
            $(document).on('click','.custom-control-input',function(event){
                if(this.id == "top-units")
                    $('#discount-rate').prop('checked', false);
                else if(this.id == "discount-rate")
                    $('#top-units').prop('checked', false);
                
                $.post("{{ route('dashboard.stores.searchResultFilter') }}",{'keyword':$('#search-by-products').val(),'filter':this.id,'_token':$('input[name=_token]').val(),'type':type},function(data){
                    $("#searchResultTable_wrapper").remove();
                    dispalySearchResult(data);
                }).then( function(){
                    $('#searchResultTable').DataTable();
                });
            })
        });
    });
</script>

@endpush