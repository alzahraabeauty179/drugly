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
                                                    <input type="text" placeholder="Product Search..." class="form-control" id="search-by-products">
                                                </div>
                                            </div>
                                            <!-- ./Search by products -->

                                            <!-- Upload Excel -->
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <form action="">
                                                        <label for="">Upload Excel</label>
                                                        <input type="file" class="form-control-file" />
                                                        <button class="btn btn-primary btn-sm">
                                                            <i class="ft-plus"></i> @lang('site.make_order')
                                                        </button>
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
                                <div class="card-body card-dashboard">

                                    <form action="{{route('dashboard.makeOrder')}}" method="POST">
                                        @method('POST')
                                        {{ csrf_field() }}
                                        <table class="table table-bordered" id="data-table">
                                            <thead>
                                                <tr>
                                                    <th class="active">
                                                        <input type="checkbox" class="select-all checkbox"
                                                            name="select-all" />
                                                    </th>
                                                    <th>@lang('site.name')</th>
                                                    <th>@lang('site.type')</th>
                                                    <th>@lang('site.available')</th>
                                                    <th>@lang('site.unit_price')</th>
                                                </tr>
                                            </thead>
                                        </table>
                                        <div class="col-md-12 mt-1">
                                            <button data-repeater-create="" class="btn btn-primary">
                                                <i class="ft-plus"></i> @lang('site.make_order')
                                            </button>
                                        </div>
                                    </form>

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
{{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">  --}}
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
{{-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" > --}}

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">


{{-- end  datatables style for yajar package --}}
@endpush
@push('script')
{{-- start datatables script for yajar package --}}
<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script>
    $(function() {
    $('#data-table').DataTable({       
        dom: "Blfrtip",
        processing: true,
        serverSide: true,
        ajax: {
            url: '{!! route('dashboard.products') !!}',
            data: function (d) {
                d.store = '{!! request()->store !!}';
            }
        },
        type : 'POST',
        columns: [
            { data: '<input type="checkbox" class="select-all checkbox" name="select-all">', name: '<input type="checkbox" class="select-all checkbox" name="select-all">', orderable: false, searchable: false},
            { data: 'name', name: 'name' , orderable: false, },
            { data: 'type', name: 'type', orderable: false, },
            { data: 'available', name: 'available', orderable: false, },
            { data: 'unit_price', name: 'unit_price', orderable: false, },
        ], 
    });
});
</script>
<script>
    $(function (e) {
        $(".select-all").click(function () {
            $(".select-item").prop('checked', $(this).prop('checked'));
        });
    });
</script>

<script>
    var products = [];
    function SelectProduct(e, val) {
        products.push($(e).val());
        // not finished yet!
        console.log(products);        
    };
</script>
@endpush