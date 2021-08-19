@extends('dashboard.layouts.app')

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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.'.$module_name_plural.'.index') }}">@lang('site.'.$module_name_plural)</a>
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
                                <h4 class="card-title text-capitlaize" id="file-repeater"><i
                                        class="ft-plus"></i>@lang('site.add') @lang('site.'.$module_name_singular)</h4>
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
                                    <form class="form row" enctype="multipart/form-data" method="POST"
                                        action="{{ route('dashboard.'.$module_name_plural.'.store') }}">
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


        {{-- start add from excel sheet and download excel temp for upload it  --}}
        <div class="content-body">
            <section id="form-control-repeater">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-capitlaize" id="file-repeater"><i
                                        class="ft-plus"></i>@lang('site.add') @lang('site.'.$module_name_singular)</h4>
                                <a href="{{ route('dashboard.download.sheetExcel', ) }}" class="btn btn-info"> Download
                                    Excel </a>
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
                                    <form class="form row" enctype="multipart/form-data" method="POST"
                                        action="{{ route('dashboard.'.$module_name_plural.'.store') }}">
                                        @method('POST')
                                        @csrf
                                        <div class="form-group col-md-4">
                                            <div class="text-bold-600 font-medium-2">
                                                @lang('site.categories')
                                            </div>
                                            <select
                                                class="select2 form-control @error('category_id') is-invalid @enderror"
                                                id="category_id" name="category_id" required>
                                                <optgroup label="@lang('site.select')">
                                                    @foreach(App\Models\Category::all() as $category)
                                                    <option value="{{$category->id}}"
                                                        {{ isset($row) && $row->id == $category->id  ? 'selected' : '' }}>
                                                        {{$category->name}}
                                                    </option>
                                                    @endforeach
                                                </optgroup>
                                            </select>

                                            @error('category_id')
                                            <small class=" text text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                            @enderror
                                        </div>

                                        <div class="col-md-2"></div>
                                        <fieldset class="form-group col-md-6">
                                            <label for="basicInputFile">Upload Excel</label>
                                            <div class="custom-file">
                                                <input type="file" name="excel" required
                                                    class="custom-file-input @error('excel') is-invalid @enderror "
                                                    id="inputGroupFile01">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose
                                                    file</label>
                                                @error('excel')
                                                <small class=" text text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                                @enderror
                                            </div>
                                        </fieldset>
                                        <div class="col-md-6"></div>
                                        <div class="form-group col-md-6">
                                            <button data-repeater-create="" class="btn btn-primary">
                                                <i class="ft-plus"></i> @lang('site.Upload')
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
         {{-- end add from excel sheet and download excel temp for upload it  --}}

          {{-- start update from excel sheet and download excel temp for  this category  --}}
        <div class="content-body">
            <section id="form-control-repeater">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-capitlaize" id="file-repeater"><i
                                        class="ft-plus"></i>@lang('site.update') @lang('site.'.$module_name_singular)</h4>
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
                                    <form class="form row" enctype="multipart/form-data" method="POST"
                                        action="{{ route('dashboard.'.$module_name_plural.'.store') }}">
                                        @method('POST')
                                        @csrf
                                        <div class="form-group col-md-4">
                                            <div class="text-bold-600 font-medium-2">
                                                @lang('site.categories')
                                            </div>
                                            <select
                                                class="select2 form-control @error('category_id') is-invalid @enderror"
                                                id="category_id" name="category_id" required>
                                                <optgroup label="@lang('site.select')">
                                                    @foreach(App\Models\Category::all() as $category)
                                                    <option value="{{$category->id}}"
                                                        {{ isset($row) && $row->id == $category->id  ? 'selected' : '' }}>
                                                        {{$category->name}}
                                                    </option>
                                                    @endforeach
                                                </optgroup>
                                            </select>

                                            @error('category_id')
                                            <small class=" text text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                            @enderror
                                        </div>

                                        <div class="col-md-2"></div>
                                        <fieldset class="form-group col-md-6">
                                            <label for="basicInputFile">Upload Excel</label>
                                            <div class="custom-file">
                                                <input type="file" name="excel" 
                                                    class="custom-file-input @error('excel') is-invalid @enderror "
                                                    id="inputGroupFile01">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose
                                                    file</label>
                                                @error('excel')
                                                <small class=" text text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                                @enderror
                                            </div>
                                        </fieldset>
                                        <div class="col-md-6"></div>
                                        <div class="form-group col-md-6">
                                            <button data-repeater-create="" class="btn btn-primary">
                                                <i class="ft-plus"></i> @lang('site.Upload')
                                            </button>

                                            <input type="submit" value="download Excel" formmethod="POST" formaction="{{ route('dashboard.proCat.sheetExcel') }}">
                                        
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
         {{-- end add from excel sheet and download excel temp for this category  --}}

    </div>
</div>
@endsection