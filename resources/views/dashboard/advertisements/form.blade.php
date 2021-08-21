{{ csrf_field() }}

@foreach (config('translatable.locales') as $index => $locale)
<div class="form-group col-md-6 mb-2">
    <div class="form-group">
        <label class="bmd-label-floating">@lang('site.' . $locale . '.title')</label>
        <input type="text" class="form-control @error($locale.'.title') is-invalid
            @enderror " name=" {{ $locale }}[title]"
            value="{{ isset($row) ? $row->translate($locale)->title : old($locale . '.title') }}">

        @error($locale.'.title')
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
        <label class="bmd-label-floating">@lang('site.' . $locale . '.content')</label>
        <textarea name=" {{ $locale }}[content]" id="" cols="30" rows="10"
            class="form-control @error($locale . '.content') is-invalid
            @enderror">{{ isset($row) ? $row->translate($locale)->content : old($locale . '.content') }}</textarea>

        @error($locale.'.content')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</div>
@endforeach

<div class="form-group col-md-6">
    <div class="text-bold-600 font-medium-2">
        @lang('site.end_date')
    </div>
	<input type="date" class="form-control @error('end_date') is-invalid
            @enderror " name="end_date" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
            value="{{ isset($row) ? $row->end_date : old('end_date') }}">

    @error('end_date')
    <small class=" text text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </small>
    @enderror
</div>

<div class="form-group col-md-6">
    <div class="text-bold-600 font-medium-2">
        @lang('site.display_method')
    </div>
    <select class="select2 form-control @error('display_method') is-invalid @enderror" id="display_method" name="display_method">
        <option value="horizontal" {{ isset($row) && $row->display_method == 'horizontal'  ? 'selected' : '' }}>
            @lang('site.horizontal')
        </option>
    	<option value="vertical" {{ isset($row) && $row->display_method == 'vertical'  ? 'selected' : '' }}>
            @lang('site.vertical')
        </option>
    	<option value="longitudinal" {{ isset($row) && $row->display_method == 'longitudinal'  ? 'selected' : '' }}>
            @lang('site.longitudinal')
        </option>
    </select>

    @error('display_method')
    <small class=" text text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </small>
    @enderror
</div>

<div class="form-group col-md-6">
    <div class="text-bold-600 font-medium-2">
        @lang('site.users')
    </div>
    <select class="select2 form-control @error('owner_id') is-invalid @enderror" id="user_id" name="owner_id">
        <option value="" selected></option>
        @foreach(App\User::where('type', '!=', 'super_admin')->get() as $user)
        <option value="{{$user->id}}" {{ isset($row) && $row->owner_id == $user->id  ? 'selected' : '' }}>
            {{$user->name}}
        </option>
        @endforeach
    </select>

    @error('owner_id')
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

