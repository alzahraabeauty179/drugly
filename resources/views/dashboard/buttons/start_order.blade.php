@if (auth()->user()->can('read-'.$module_name_plural))
<a href="{{ route('dashboard.'.$module_name_plural.'.products', ['store'=>$row->id]) }}" title="@lang('site.start_order')" class="btn btn-info btn-sm"
    data-original-title="@lang('site.start_order') @lang('site.'.$module_name_singular)">
    <i class="ft-eye"> @lang('site.start_order') </i>
</a>
@endif