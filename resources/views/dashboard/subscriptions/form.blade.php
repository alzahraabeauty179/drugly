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
        	<textarea 	name=" {{ $locale }}[description]" id="" cols="30" rows="10"
            			class="form-control @error($locale . '.description') is-invalid
            @enderror">{{ isset($row) ? $row->translate($locale)->description : old($locale . '.description') }}</textarea>

        	@error($locale.'.description')
        	<small class=" text text-danger" role="alert">
            	<strong>{{ $message }}</strong>
        	</small>
        	@enderror
    	</div>
	</div>
@endforeach

<div class="form-group col-md-6">
    <div class="text-bold-600 font-medium-2">
        @lang('site.price')
    </div>
	<input 	type="number" class="form-control @error('price') is-invalid
            @enderror " name="price" min=0 step=0.01
            value="{{ isset($row) ? $row->price : old('price') }}">

    @error($locale . '.price')
    <small class=" text text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </small>
    @enderror
</div>

<div class="form-group col-md-6">
    <div class="text-bold-600 font-medium-2">
        @lang('site.duriation') @lang('site./month')
    </div>

	<input 	type="number" class="form-control @error('duriation') is-invalid
            @enderror " name="duriation" min=1 step=1
            value="{{ isset($row) ? $row->duriation : old('duriation') }}">

    @error($locale . '.duriation')
    <small class=" text text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </small>
    @enderror
</div>

<div class="form-group col-md-6">
    <div class="text-bold-600 font-medium-2">
        @lang('site.for')
    </div>
    <select class="select2 form-control @error($locale . ' .type') is-invalid @enderror" 
            id="type" name="type"
    >
        <optgroup label="@lang('site.select')">
            <option value="medical_store">@lang('site.medical_store')</option>
        	<option value="beauty_company">@lang('site.beauty_company')</option>
        	<option value="pharmacy">@lang('site.pharmacy')</option>
        </optgroup>
    </select>

    @error($locale . '.type')
    <small class=" text text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </small>
    @enderror
</div>

<fieldset class="form-group col-md-6">
    <label for="basicInputFile">@lang('site.upload_photo')</label>
    <div class="custom-file">
        <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror "
            id="inputGroupFile01">
        <label class="custom-file-label" for="inputGroupFile01">@lang('site.choose_file')</label>
        @error('image')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</fieldset>