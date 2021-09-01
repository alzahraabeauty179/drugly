@extends('dashboard.layouts.app')

@section('title', isset($_REQUEST['medical_store'])? __('site.warehouses'):__('site.cosmetic_companies'))

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
                                            <!-- Upload Excel -->
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <form   enctype="multipart/form-data" method="POST"
                                                            action="{{ route('dashboard.orders.store') }}">
                                                            @method('POST')
                                                            @csrf
                                                        <div class="form-group">
                                                            <input type="hidden" name="store_id" value="{!! request()->store !!}">

                                                            <label for="order_sheet">@lang('site.upload_order_excel')</label>
                                                            <input type="file" class="form-control-file" name="order_sheet" />
                                                        </div>
                                                        <button class="btn btn-primary btn-sm">
                                                            <i class="ft-plus"></i> @lang('site.make_order')
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- ./Upload Excel -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ./Advanced Search -->
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <form action="{{ route('dashboard.orders.store') }}" method="POST">
                                        @method('POST')
                                        {{ csrf_field() }}
                                        <table class="table table-bordered" id="data-table">
                                            <thead>
                                                <tr>
                                                    <th class="active">
                                                        <input type="checkbox" class="select-all checkbox"
                                                            name="select_all" />
                                                    </th>
                                                    <th>@lang('site.name')</th>
                                                    <th>@lang('site.type')</th>
                                                    <th>@lang('site.available')</th>
                                                    <th>@lang('site.unit')</th>
                                                    <th>@lang('site.unit_price') $</th>
                                                </tr>
                                            </thead>
                                        </table>
                                        <div class="col-md-12 mt-1">
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#make_order_manually" class="btn btn-primary">
                                                <i class="ft-plus"></i> @lang('site.make_order')
                                            </button>
                                            @component('components.make_order') @endcomponent
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
            { data: 'name', name: 'name' , orderable: true, },
            { data: 'type', name: 'type', orderable: true, },
            { data: 'available', name: 'available', orderable: true, },
            { data: 'unit', name: 'unit', orderable: true, },
            { data: 'unit_price', name: 'unit_price', orderable: true, },
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
    var select_manually = [];
    function SelectProduct(e, val) {
        
        if ($(e).is(':checked'))
            select_manually.push($(e).val());
        else
            select_manually.splice( $.inArray($(e).val(), select_manually), 1 );

        if(!$('#select-manually').is(name))
            $('#select-manually').attr("name", "select_manually");
        
        $('#select-manually').val(select_manually);      
    };
</script>
@endpush