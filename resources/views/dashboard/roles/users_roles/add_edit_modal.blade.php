<!-- Modal Users Roles -->

<div    class="modal fade" id="{{ isset($row) ? 'edit_user_role_'.$row->user_id.$row->role_id : 'add_user_role' }}" 
        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('site.'.$module_name_singular )</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a class="close" data-dismiss="modal" aria-label="Close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="card-content collpase show">
                    <div class="card-body">
                        {{-- <div class="card-text">
                            <p class="card-text">@lang('site.update_profile_hint')</p>
                        </div> --}}

                        <div class="container-fluid row d-flex justify-content-center ">
                            @if( Session::has('createUserRoleError') )
                                <div class="alert col-sm-6 text-center alert-{{session('message_type') == 'success' ?  'success'  :  'warning' }}"
                                        role="alert">
                                    {{session('createUserRoleError')}}
                                </div>
                            @elseif( isset($row) && Session::has('updateUserRoleError') && session("id") == $row->user_id.$row->role_id)
                                <div class="alert col-sm-6 text-center alert-{{session('message_type') == 'success' ?  'success'  :  'warning' }}"
                                        role="alert">
                                    {{session('createUserRoleError')}}
                                </div>
                            @endif
                        </div><!-- end alert -->

                        <form   class="form" method="POST" enctype="multipart/form-data" id="{{ isset($row) ? 'edit_user_role_form_'.$row->user_id.$row->role_id : 'add_user_role_form' }}"
                                action="{{ route('dashboard.user.role.createUpdate') }}"
                        >
                            @method('POST')
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="text-bold-600 font-medium-2">
                                                @lang('site.users')
                                            </div>
                                        	@if( isset($row) )
                                        		<span>{{ $row->user->name }}</span>
                                        	@else
                                            <select class="select2 form-control" id="user_id" name="user_id">
                                                @foreach($users as $user)
                                                <option value="{{$user->id}}">
                                                    {{$user->name.' - '.__('site.' . $user->type) }}
                                                </option>
                                                @endforeach
                                            </select>
                                        	@endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="text-bold-600 font-medium-2">
                                                @lang('site.roles')
                                            </div>
                                            <select class="select2 form-control" id="role_id" name="role_id">
                                                @foreach($roles as $role)
                                                <option value="{{$role->id}}" {{ isset($row) && $row->role_id == $role->id  ? 'selected' : '' }}>
                                                    {{$role->display_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 

            <div class="modal-footer" style="border-top: none;">
                <div class="form-actions">
                    <button type="button" class="btn btn-outline-warning mr-1" data-dismiss="modal">
                        <i class="ft-x"></i> @lang('site.cancel')
                    </button>
                    <button type="submit" form="{{ isset($row) ? 'edit_user_role_form_'.$row->user_id.$row->role_id : 'add_user_role_form' }}" 
                            class="btn btn-outline-primary">
                        <i class="ft-check"></i> @lang('site.save')
                    </button>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- ./End Modal Users Roles -->