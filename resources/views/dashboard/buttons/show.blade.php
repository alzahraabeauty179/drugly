@if (auth()->user()->can('update-'.$module_name_plural) ||  auth()->user()->type == 'pharmacy')
<a href="{{route('dashboard.'.$module_name_plural.'.show', $row)}}" title="@lang('site.show')" class="btn btn-info btn-sm"
    data-original-title="@lang('site.show') @lang('site.'.$module_name_singular)">
    <i class="ft-eye"> @lang('site.show') </i>
</a>
@endif