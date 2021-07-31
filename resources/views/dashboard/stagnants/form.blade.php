{{ csrf_field() }}

<input type="hidden" name="stagnant_id" value="{{ isset(request()->stagnant) ? request()->stagnant :  null }}">
<div class="form-group col-md-12 mb-2">
    <div class="form-group">
        <label class="bmd-label-floating">@lang('site.name')</label>
        <input type="text" class="form-control @error('name') is-invalid
            @enderror " name="name" value="{{ isset($row) ? $row->name : old('name') }}">

        @error('name')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</div>

<div class="form-group col-md-12 mb-2">
    <div class="form-group">
        <label class="bmd-label-floating">@lang('site.description')</label>
        <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid
            @enderror">{{ isset($row) ? $row->description : old('description') }}</textarea>

        @error('description')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</div>


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

<div class="form-group col-md-6 mb-2">
    <div class="form-group">
        <label class="bmd-label-floating">@lang('site.price')</label>
        <input type="number" class="form-control @error('price') is-invalid
            @enderror " name="price" value="{{ isset($row) ? $row->price : old('price') }}">

        @error('price')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</div>

<div class="form-group col-md-6 mb-2">
    <div class="form-group">
        <label class="bmd-label-floating">@lang('site.discount')</label>
        <input type="number" class="form-control @error('discount') is-invalid
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
        <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror "
            id="inputGroupFile01">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
        @error('image')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</fieldset>
