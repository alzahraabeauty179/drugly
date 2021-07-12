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
    <div class="form-group col-md-6 mb-2">
        <div class="form-group">
            <label class="bmd-label-floating">@lang('site.' . $locale . '.description')</label>
            <textarea name=" {{ $locale }}[description]" id="" cols="30" rows="10" class="form-control @error($locale . ' .description') is-invalid
            @enderror">{{ isset($row) ? $row->translate($locale)->description : old($locale . '.description') }}</textarea>

            @error($locale . '.description')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
@endforeach

<div class="form-group col-md-6">
    <div class="text-bold-600 font-medium-2">
        @lang('site.categories')
    </div>
    <select class="select2 form-control @error($locale . ' .description') is-invalid @enderror" 
            id="category_id" name="parent_id"
    >
        <optgroup label="@lang('site.select')">
            @foreach($categories as $category)
                <option value="{{$category->id}}" 
                    {{ isset($row) && $row->id == $category->id  ? 'selected' : '' }} >
                    {{$category->name}}
                </option>
            @endforeach
        </optgroup>
    </select>

    @error($locale . '.description')
    <small class=" text text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </small>
    @enderror
</div>

<fieldset class="form-group col-md-6">
    <label for="basicInputFile">Upload Photo</label>
    <div class="custom-file">
        <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror " id="inputGroupFile01">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
        @error('image')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</fieldset>