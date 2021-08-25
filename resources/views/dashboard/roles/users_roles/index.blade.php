@extends('dashboard.layouts.app')

@section('title', __('site.'.$module_name_plural))

@section('content')
<div class="app-content content">

    <div class="container-fluid row d-flex justify-content-center">
        @if(session('success'))
            <div class="alert alert-success col-sm-6 text-center" role="alert">
                {!! session('success') !!}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger col-sm-6 text-center" role="alert">
                {!! session('error') !!}
            </div>
        @endif
    </div>
    
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-1">
                <h3 class="content-header-title">@lang('site.'.$module_name_plural )</h3>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('site.home' )</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('site.'.$module_name_plural )</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                @php
               
                    $users = App\User::whereNotHas('roles');
                    $roles = App\Role::all();
                @endphp
                <div class="row">
                    <div class="col-md-12 mb-1">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#add_user_role"><i
                                class="ft-plus"></i> @lang('site.add') @lang('site.'.$module_name_singular )</button>
                        @include( 'dashboard.roles.users_roles.add_edit_modal' )
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('site.'.$module_name_plural )</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table class="table table-striped table-bordered zero-configuration" id="myUsersRolesTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>@lang('site.name')</th>
                                                <th>@lang('site.role')</th>
                                                <th>@lang('site.created_at')</th>
                                                <th>@lang('site.update')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($rows as $index=>$row)
                                            <tr>
                                                <td> {{++$index}} </td>
                                                <td>{{$row->user->name}}</td>
                                                <td> 
                                                    {{$row->role->display_name}}
                                                </td>
                                                <td> {{ Carbon\Carbon::parse($row->created_at)->format('d M Y h:m') }} </td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_user_role_{{$row->user_id.$row->role_id}}">
                                                        <i class="fa fa-cog fa-fw"></i> @lang('site.update')
                                                    </button>
                                                    @include( 'dashboard.roles.users_roles.add_edit_modal' )
                                                </td>
                                            </tr>
                                            @empty
                                                <tr><td colspan="4" style="text-align: center;"><h4>@lang('site.no_records')</h4></td></tr>
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>@lang('site.name')</th>
                                                <th>@lang('site.role')</th>
                                                <th>@lang('site.created_at')</th>
                                                <th>@lang('site.update')</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Zero configuration table -->
        </div>
    </div>
</div>
@endsection

@push('style')

{{-- start datatables style for yajar package --}}
<!-- Bootstrap CSS -->
<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

{{-- end  datatables style for yajar package --}}
@endpush

@push('script')
    {{-- start datatables script for yajar package --}}
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <!-- BS JavaScript -->
    <!-- <script type="text/javascript" src="{{asset('assets\libs\bootstrap\bootstrap.min.js')}}"></script> -->

    <script>
        $(document).ready( function () {
            $('#myUsersRolesTable').DataTable();
        } );
    </script>

    @if( Session::has('createUserRoleError') )
        <script>
            $(document).ready(function(){
                $('#add_user_role').modal({show: true});
            });
        </script>
    @endif

    @if( Session::has('updateUserRoleError') )
        <script>
            $(document).ready(function(){
                $('#edit_user_role_{{session("id")}}').modal({show: true});
            });
        </script>
    @endif
@endpush