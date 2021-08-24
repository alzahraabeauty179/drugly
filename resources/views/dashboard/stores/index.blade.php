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
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="search-by-products">
                                                </div>
                                            </div>
                                            <!-- ./Search by products -->

                                            <!-- Upload Excel -->
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <form action="">
                                                        <label for="">Upload Excel</label>
                                                        <input type="file" class="form-control-file" />
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- ./Upload Excel -->
                                        </div>
                                    </div>

                                    <!-- Result Filter -->
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

@push('style')

{{csrf_field()}}

{{-- start datatables style for yajar package --}}
<!-- Bootstrap CSS -->
<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">

{{-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" > --}}

{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> --}}

{{-- end  datatables style for yajar package --}}

{{-- Search by products  --}}
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
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script>
    var type = "{{ isset($_REQUEST['medical_store'])? 'medical_store' : 'beauty_company' }}", products_name = [];

    $(document).on('keyup','#search-by-products',function(event){
        $.post("{{ route('dashboard.stores.searchByProduct') }}",{'keyword':$('#search-by-products').val(),'type':type,'_token':$('input[name=_token]').val()},function(data){
            
            if( data["products"].length != 0)
                products_name = data.products.map(function (value, index, array) { return value.name; });
       
            $("#search-by-products").autocomplete({ source: products_name });
        }).then( function(){
            $.post("{{ route('dashboard.stores.searchResult') }}",{'keyword':$('#search-by-products').val(),'_token':$('input[name=_token]').val(),'type':type},function(data){
                $("#storedatatable-table_wrapper").css('display', 'none')
                $("#products-container").append(`
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
                `);
            });
        });
    });

    // $(document).on('click','#search-by-products',function(event){
    //     $.post("{{ route('dashboard.stores.searchResult') }}",{'keyword':$('#search-by-products').val(),'_token':$('input[name=_token]').val(),'type':type},function(data){
    //         $("#storedatatable-table_wrapper").css('display', 'none')
    //         $("#products-container").append(`
    //             <table class="table table-striped table-bordered cat-configuration">
    //                 <thead>
    //                     <tr>
    //                         <th class="active">
    //                             <input type="checkbox" class="select-all checkbox"
    //                                 name="select-all" />
    //                         </th>
    //                         <th>Product Name</th>
    //                         <th>Available</th>
    //                         <th>Store Name</th>
    //                     </tr>
    //                 </thead>
    //                 <tbody>
    //                     <tr>
    //                         <td class="active">
    //                             <input type="checkbox" class="select-item checkbox"
    //                                 name="select-item" value="1000" />
    //                         </td>
    //                         <td>Product Test 1</td>
    //                         <td>50 Units</td>
    //                         <td>Store Test 1</td>
    //                     </tr>
    //                     <tr>
    //                         <td class="active">
    //                             <input type="checkbox" class="select-item checkbox"
    //                                 name="select-item" value="1000" />
    //                         </td>
    //                         <td>Product Test 2</td>
    //                         <td>50 Units</td>
    //                         <td>Store Test 2</td>
    //                     </tr>
    //                     <tr>
    //                         <td class="active">
    //                             <input type="checkbox" class="select-item checkbox"
    //                                 name="select-item" value="1000" />
    //                         </td>
    //                         <td>Product Test 3</td>
    //                         <td>50 Units</td>
    //                         <td>Store Test 3</td>
    //                     </tr>
    //                     <tr>
    //                         <td class="active">
    //                             <input type="checkbox" class="select-item checkbox"
    //                                 name="select-item" value="1000" />
    //                         </td>
    //                         <td>Product Test 4</td>
    //                         <td>50 Units</td>
    //                         <td>Store Test 4</td>
    //                     </tr>
    //                 </tbody>
    //             </table>
    //         `);
    //     });
    // });
    $(function (e) {
        $(".select-all").click(function () {
            $(".select-item").prop('checked', $(this).prop('checked'));
        });
    });
</script>

@endpush