@extends('dashboard.layouts.app')

@section('title', __('site.'.$module_name_plural))

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-1">
                    <h3 class="content-header-title">Brands</h3>
                </div>
                <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Brands</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <a class="btn btn-info" href="{{route('dashboard.'.$module_name_plural.'.create')}}"><i class="ft-plus"></i> Add Brand </a>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Brands</h4>
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
                                        @if($rows->count() > 0)
                                            <table class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Brand</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($rows as $index=>$row)
                                                    <tr>
                                                        <td> {{++$index}} </td>
                                                        <td> {{ $row->name }} </td>
                                                        <td> @include('dashboard.buttons.edit') </td>
                                                        <td> @include('dashboard.buttons.delete') </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Brand</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                            {{$rows->appends(request()->query())->links()}}

                                        @else
                                            <h4>@lang('site.no_records')</h4>
                                        @endif
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