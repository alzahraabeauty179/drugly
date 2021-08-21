@if (auth()->user()->can('update-'.$module_name_plural))
<a href="{{route('dashboard.'.$module_name_plural.'.show', $row)}}" title="@lang('site.subscribe_request')" class="btn btn-info btn-sm"
    data-original-title="@lang('site.subscribe_request') @lang('site.'.$module_name_singular)">
    <i class="fa fa-edit"> @lang('site.subscribe_request') </i>
</a>
@endif