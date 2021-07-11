<form action="{{route('dashboard.'.$module_name_plural.'.destroy', $row)}}" method="POST" style="display: inline-block">
    {{csrf_field()}}
    {{method_field('DELETE')}}

    <button type="submit" rel="tooltip" title="" class="btn btn-danger" data-original-title="@lang('site.delete')">
        <i class="fa fa-times fa-fw"> @lang('site.delete')</i>
    </button> 
</form>