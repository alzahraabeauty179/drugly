{{ csrf_field() }}


<div class="form-group col-md-6 mb-2">
    <div class="form-group">
        <label class="bmd-label-floating">@lang('site.name')</label>
        <input name="name" class="form-control @error('name') is-invalid  @enderror" value="{{ isset($row) ? $row->name : old('name') }}">
        @error('name')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</div>


<div class="form-group col-md-6 mb-2">
    <div class="form-group">
        <label class="bmd-label-floating">@lang('site.description')</label>
        <input name="description" class="form-control @error('description') is-invalid  @enderror" value="{{ isset($row) ? $row->description : old('description') }}">
        @error('description')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</div>

@php
$models = config('laratrust_seeder.role_structure.super');
// dd($models);
$maps = ['create', 'read', 'update', 'delete'];
@endphp


    @foreach ($models as $model => $detail)
    <div class="list-group col-md-3 mb-2">
        <div class="form-group">
        <a href="#" class="list-group-item active">
            @lang('site.'.$model)
        </a>
        @foreach ($maps as $map)
        <label>@lang('site.'.$map)</label>
        <input type="checkbox" style="height: 20px" class="form-control" name="permissions[]"
                {{ isset($row) && $row->hasPermission($map . '-' . $model) ? 'checked' : '' }}
                value="{{ $map . '-' . $model }}">
        @endforeach
    </div>
    </div>

    @endforeach

    <div class="col-md-12"></div>
