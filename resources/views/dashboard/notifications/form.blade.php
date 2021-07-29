{{ csrf_field() }}

@foreach (config('translatable.locales') as $index => $locale)
    <div class="form-group col-md-6 mb-2">
        <div class="form-group">
            <label class="bmd-label-floating">@lang('site.' . $locale . '.title')</label>
            <input type="text" class="form-control @error($locale . ' .title') is-invalid
            @enderror " name=" {{ $locale }}[title]"
                value="{{ isset($row) ? $row->translate($locale)->title : old($locale . '.title') }}">

            @error($locale . '.title')
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
            <textarea name=" {{ $locale }}[content]" id="" cols="30" rows="10" class="form-control @error($locale . ' .content') is-invalid
            @enderror">{{ isset($row) ? $row->translate($locale)->content : old($locale . '.content') }}</textarea>

            @error($locale . '.content')
                <small class=" text text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </small>
            @enderror
        </div>
    </div>
@endforeach

<div class="form-group col-md-6">
    <div class="text-bold-600 font-medium-2">
        @lang('site.custom_users')
    </div>
    <select class="select2 form-control @error($locale . ' .users_id') is-invalid @enderror" 
            id="users_id" name="users_id[]" multiple="multiple"
    >
        <optgroup label="@lang('site.medical_store')">
            @forelse($users as $user)
                @if($user->type == "medical_store")
                <option value="{{$user->id}}" 
                    {{ isset($row) && $row->id == $user->id  ? 'selected' : '' }} >
                    {{$user->name}}
                </option>
                @endif

                @empty
                <optgroup label="@lang('site.no_medical_stores')">
                </optgroup>
            @endforelse
        </optgroup>

        <optgroup label="@lang('site.beauty_company')">
            @forelse($users as $user)
                @if($user->type == "beauty_company")
                <option value="{{$user->id}}" 
                    {{ isset($row) && $row->id == $user->id  ? 'selected' : '' }} >
                    {{$user->name}}
                </option>
                @endif

                @empty
                <optgroup label="@lang('site.no_beauty_companies')">
                </optgroup>
            @endforelse
        </optgroup>

        <optgroup label="@lang('site.pharmacy')">
            @forelse($users as $user)
                @if($user->type == "pharmacy")
                <option value="{{$user->id}}" 
                    {{ isset($row) && $row->id == $user->id  ? 'selected' : '' }} >
                    {{$user->name}}
                </option>
                @endif

                @empty
                <optgroup label="@lang('site.no_beauty_pharmacies')">
                </optgroup>
            @endforelse
        </optgroup>
    </select>

    @error($locale . '.users_id')
    <small class=" text text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </small>
    @enderror
</div>

<div class="form-group col-md-6">
    <div class="text-bold-600 font-medium-2">
        @lang('site.all_users')
    </div>
    <div class="form-group pb-1">
              <div class="float-right">
                <input type="checkbox" name="switchery" id="switchery0" class="switchery" checked/>
              </div>
              <label for="switchery0" class="font-medium-2 text-bold-600">Switchery Default</label>
            </div>
</div>

<!-- <div class="form-group col-md-6">
    <div class="text-bold-600 font-medium-2">
        @lang('site.users')
    </div>
    <select class="select2 form-control" multiple="multiple">		
        <optgroup label="Central Time Zone">
            <option value="AL">Alabama</option>
            <option value="AR">Arkansas</option>
            <option value="IL">Illinois</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="MN">Minnesota</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="OK">Oklahoma</option>
            <option value="SD">South Dakota</option>
            <option value="TX">Texas</option>
            <option value="TN">Tennessee</option>
            <option value="WI">Wisconsin</option>
        </optgroup>
        <optgroup label="Eastern Time Zone">
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="IN">Indiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="OH">Ohio</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WV">West Virginia</option>
        </optgroup>
    </select>
</div> -->