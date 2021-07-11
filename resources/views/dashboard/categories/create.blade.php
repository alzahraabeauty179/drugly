@extends('dashboard.layouts.app')

<<<<<<< HEAD
{{-- @section('title', __('site.' . $module_name_plural . '.add')) --}}

@section('content')

=======
@section('title', __('site.add') .' '. __('site.' . $module_name_singular) )

@section('content')
<div class="app-content content">
    <div class="content-wrapper">


        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-1">
                <h3 class="content-header-title">@lang('site.'. $module_name_singular)</h3>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home', ) }}">@lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.'.$module_name_plural.'.index', ) }}">@lang('site.'.$module_name_plural)</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('site.add') @lang('site.'.$module_name_singular)</li>
                    </ol>
                </div>
            </div>
        </div>


        <div class="content-body">
            <section id="form-control-repeater">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-capitlaize" id="file-repeater"><i class="ft-plus"></i>@lang('site.add') @lang('site.'.$module_name_singular)</h4>
                                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
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
                                <div class="card-body">
                                    <form class="form row" enctype="multipart/form-data" method="POST" action="{{ route('dashboard.categories.store', ) }}">
                                        @method('POST')

                                        @include('dashboard.'.$module_name_plural.'.form')


                                        <div class="form-group col-md-6">
                                            <button data-repeater-create="" class="btn btn-primary">
                                                <i class="ft-plus"></i> @lang('site.add')
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
>>>>>>> 647ebd9dba771750f50220a6a85b17db44d61a15
@endsection