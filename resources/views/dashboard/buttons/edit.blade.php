@if (auth()->user()->can('update-'.$module_name_plural))
<a href="{{route('dashboard.'.$module_name_plural.'.edit', $row)}}" title="@lang('site.delete')" class="btn btn-info btn-sm"
    data-original-title="@lang('site.edit') @lang('site.'.$module_name_singular)">
    <i class="fa fa-edit"> @lang('site.edit') </i>
</a>
@endif