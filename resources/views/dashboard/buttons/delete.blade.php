@if (auth()->user()->can('delete-'.$module_name_plural))
<form action="{{route('dashboard.'.$module_name_plural.'.destroy', $row)}}" method="POST" style="display: inline-block">
    {{csrf_field()}}
    {{method_field('DELETE')}}

    <button type="submit" title="@lang('site.delete')" class="btn btn-danger btn-sm" data-original-title="@lang('site.delete')">
        <i class="fa fa-times"> @lang('site.delete')</i>
    </button> 
</form>
@endif