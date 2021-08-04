{{ csrf_field() }}

@foreach (config('translatable.locales') as $index => $locale)
    <div class="form-group col-md-6 mb-2">
        <div class="form-group">
            <label class="bmd-label-floating">@lang('site.' . $locale . '.name')</label>
            <input type="text" class="form-control @error($locale . ' .name') is-invalid
            @enderror " name=" {{ $locale }}[name]"
                value="{{ isset($row) ? $row->translate($locale)->name : old($locale . '.name') }}">

            @error($locale . '.name')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
@endforeach

<div class="form-group col-md-6">
    <div class="text-bold-600 font-medium-2">
        @lang('site.areas')
    </div>
    <select class="select2 form-control @error($locale . ' .parent_id') is-invalid @enderror" 
            id="area_id" name="parent_id"
    >
        <optgroup label="@lang('site.select')">
            <option></option>
            @forelse($areas as $area)
                <option value="{{$area->id}}" 
                    {{ isset($row) && $row->id == $area->id  ? 'selected' : '' }} >
                    {{$area->name}}
                </option>
                @empty
                <option></option>
            @endforelse
        </optgroup>
    </select>

    @error($locale . '.parent_id')
    <small class=" text text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </small>
    @enderror
</div>