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
        @lang('site.all_users')
    </div>
    <div class="form-group pb-1">
        <div class="float-right">
        <input type="checkbox" name="all_users" id="switchery0" class="switchery" @error('users_id') @else checked @enderror />
        </div>
        <label for="switchery0" class="font-medium-2 text-bold-600">@lang('site.send_to_all_users')</label>
        
        @error('users_id')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</div>

<div class="form-group col-md-6" id="custom-users" style=" @error('users_id') @else display:none @enderror">
    <div class="text-bold-600 font-medium-2">
        @lang('site.custom_users')
    </div>
    <select class="select2 form-control @error('users_id') is-invalid @enderror" 
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
</div>

@push('script')
    <script>
        $(document).ready( function () {
            $('#switchery0').click(function() {
                if( $('#custom-users').css('display') == 'none' )
                    $('#custom-users').removeAttr('style');
                else
                    $('#custom-users').css('display', 'none')
            });
        });
    </script>
@endpush