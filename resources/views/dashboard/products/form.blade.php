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
@foreach (config('translatable.locales') as $index => $locale)
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
    <select class="select2 form-control @error('category_id') is-invalid @enderror"
            id="category_id" name="category_id"
    >
        <optgroup label="@lang('site.select')">
            @foreach(App\Models\Category::all() as $category)
                <option value="{{$category->id}}"
                    {{ isset($row) && $row->id == $category->id  ? 'selected' : '' }} >
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



<div class="form-group col-md-6">
    <div class="text-bold-600 font-medium-2">
        @lang('site.brands')
    </div>
    <select class="select2 form-control @error($locale . ' .brand_id') is-invalid @enderror"
            id="brand_id" name="brand_id"
    >
        <optgroup label="@lang('site.select')">
            @foreach(App\Models\Brand::all() as $brand)
                <option value="{{$brand->id}}"
                    {{ isset($row) && $row->id == $brand->id  ? 'selected' : '' }} >
                    {{$brand->name}}
                </option>
            @endforeach
        </optgroup>
    </select>

    @error($locale . '.brand_id')
    <small class=" text text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </small>
    @enderror
</div>

@foreach (config('translatable.locales') as $index => $locale)
    <div class="form-group col-md-6 mb-2">
        <div class="form-group">
            <label class="bmd-label-floating">@lang('site.' . $locale . '.type')</label>
            <input type="text" class="form-control @error($locale . ' .type') is-invalid
            @enderror " name=" {{ $locale }}[type]"
                value="{{ isset($row) ? $row->translate($locale)->type : old($locale . '.type') }}">

            @error($locale . '.type')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
@endforeach

{{-- @foreach (config('translatable.locales') as $index => $locale)
    <div class="form-group col-md-6 mb-2">
        <div class="form-group">
            <label class="bmd-label-floating">@lang('site.' . $locale . '.unit')</label>
            <input type="text" class="form-control @error($locale . ' .unit') is-invalid
            @enderror " name=" {{ $locale }}[unit]"
                value="{{ isset($row) ? $row->translate($locale)->unit : old($locale . '.unit') }}">

            @error($locale . '.unit')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
@endforeach --}}

<input type="hidden" name="owner_id" value="{{auth()->user()->id}}">
<div class="form-group col-md-6 mb-2">
    <div class="form-group">
        <label class="bmd-label-floating">@lang('site.amount')</label>
        <input type="number" class="form-control @error('amount') is-invalid
            @enderror " name="amount" value="{{ isset($row) ? $row->amount : old('amount') }}">

        @error('amount')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</div>


<div class="form-group col-md-6 mb-2">
    <div class="form-group">
        <label class="bmd-label-floating">@lang('site.unit_price')</label>
        <input type="number" step="0.01" class="form-control @error('unit_price') is-invalid
            @enderror " name="unit_price" value="{{ isset($row) ? $row->unit_price : old('unit_price') }}">

        @error('unit_price')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</div>

<div class="form-group col-md-6 mb-2">
    <div class="form-group">
        <label class="bmd-label-floating">@lang('site.discount')</label>
        <input type="number" step="0.01" class="form-control @error('discount') is-invalid
            @enderror " name="discount" value="{{ isset($row) ? $row->discount : old('discount') }}">

        @error('discount')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
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

<div class="form-group col-md-6 mb-2">
    <div class="form-group">
        <label class="bmd-label-floating">@lang('site.expiry_date')</label>
        <input type="date" class="form-control @error('expiry_date') is-invalid
            @enderror " name="expiry_date" value="{{ isset($row) ? $row->expiry_date : old('expiry_date') }}">

        @error('expiry_date')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</div>
