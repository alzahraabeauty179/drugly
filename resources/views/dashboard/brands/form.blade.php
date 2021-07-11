{{ csrf_field() }}
@foreach (config('translatable.locales') as $index => $locale)
    <div class="row">
        <div class="form-group col-md-6 mb-2">
            <input  type="text" class="form-control @error($locale . ' .name') is-invalid
                    @enderror " name=" {{ $locale }}[name] "
                    placeholder="@lang('site.' . $locale . '.name')"
                    value="{{ isset($row) ? $row->translate($locale)->name : old($locale . '.name') }}">

            @error($locale . '.name')
                <small class=" text text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </small>
            @enderror
        </div>

        <div class="form-group col-md-6 mb-2">
            <input  type="text" class="form-control @error($locale . ' .description') is-invalid
                    @enderror " name=" {{ $locale }}[description] "
                    placeholder="@lang('site.' . $locale . '.description')"
                    value="{{ isset($row) ? $row->translate($locale)->description : old($locale . '.description') }}">

            @error($locale . '.description')
                <small class=" text text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </small>
            @enderror
        </div>
    </div>

@endforeach
<div class="row">
    <fieldset class="form-group col-md-12">
        <label for="basicInputFile">Upload Photo</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="inputGroupFile01" name="image">
            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
        </div>
        @error('image')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
        @enderror
    </fieldset>
</div>