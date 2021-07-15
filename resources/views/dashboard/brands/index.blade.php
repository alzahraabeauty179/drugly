@extends('dashboard.layouts.app')

@section('title', __('site.'.$module_name_plural))

@section('content')
    <div class="app-content content">
        <div class="container-fluid row d-flex justify-content-center ">
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
                    @if( auth()->user()->isAbleTo('create_brand') )
                        <div class="col-md-12 mb-1">
                            <a class="btn btn-info" href="{{route('dashboard.'.$module_name_plural.'.create')}}"><i class="ft-plus"></i> @lang('site.add') @lang('site.'.$module_name_singular) </a>
                        </div>
                    @endif
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
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        @if($rows->count() > 0)
                                            <table class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>@lang('site.'.$module_name_singular)</th>
                                                        @if( auth()->user()->isAbleTo('edit_brand') )
                                                            <th>@lang('site.edit')</th>
                                                        @endif
                                                        @if( auth()->user()->isAbleTo('delete_brand') )
                                                            <th>@lang('site.delete')</th>
                                                        @endif
                                                        <th>@lang('site.logo')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($rows as $index=>$row)
                                                    <tr>
                                                        <td> {{++$index}} </td>
                                                        <td> {{ $row->name }} </td>
                                                        @if( auth()->user()->isAbleTo('edit_brand') )
                                                            <td> @include('dashboard.buttons.edit') </td>
                                                        @endif
                                                        @if( auth()->user()->isAbleTo('delete_brand') )
                                                            <td> @include('dashboard.buttons.delete') </td>
                                                        @endif
                                                        <td>
                                                            <figure class="col-md-3 col-sm-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                                                <a href="{{ asset($row->image_path) }}" itemprop="contentUrl">
                                                                    <img class="img-thumbnail img-fluid" src="{{ asset($row->image_path) }}" itemprop="thumbnail" alt="{{ $row->description }}" />
                                                                </a>
                                                            </figure>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>@lang('site.'.$module_name_singular)</th>
                                                        @if( auth()->user()->isAbleTo('edit_brand') )
                                                            <th>@lang('site.edit')</th>
                                                        @endif
                                                        @if( auth()->user()->isAbleTo('delete_brand') )
                                                            <th>@lang('site.delete')</th>
                                                        @endif
                                                        <th>@lang('site.logo')</th>
                                                    </tr>
                                                </tfoot>
                                            </table>

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