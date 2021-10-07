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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.' .$module_name_plural. '.index') }}">@lang('site.'.$module_name_plural )</a></li>
                        <li class="breadcrumb-item active">{{$row->name}}</li>

                    </ol>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    {{-- <div class="col-md-12 mb-1">
                        @if (auth()->user()->can('create-'.$module_name_plural))
                        <a class="btn btn-info" href="{{route('dashboard.'.$module_name_plural.'.create')}}"><i
                                class="ft-plus"></i> @lang('site.add') @lang('site.'.$module_name_singular )</a>
                        @endif
                    </div> --}}
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{$row->name}}</h4>
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

                                    <table class="table table-bordered" id="data-table">
                                        <thead>
                                            <tr>
                                                <th>@lang('site.id')</th>
                                                <th>@lang('site.name')</th>
                                                <th>@lang('site.created_at')</th>
                                                <th>@lang('site.updated_at')</th>
                                                <th>@lang('site.action')</th>
                                            </tr>
                                        </thead>
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
            url: '{!! route('dashboard.subarea') !!}',
            data: function (d) {
                d.subArea = '{!! request()->area !!}';
            }
        },

        type : 'POST',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' , orderable: false, },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action' , orderable: false, searchable: false}
        ], 
    });
});
</script>

@endpush