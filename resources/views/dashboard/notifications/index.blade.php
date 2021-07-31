@extends('dashboard.layouts.app')

@section('title', __('site.announcements'))

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
                <h3 class="content-header-title">@lang('site.announcements')</h3>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('site.home' )</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('site.announcements')</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-md-12 mb-1">
                        <a class="btn btn-info" href="{{route('dashboard.'.$module_name_plural.'.create')}}"><i
                            class="ft-plus"></i> @lang('site.add') @lang('site.announcement' )</a>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('site.announcement' )</h4>
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
                                    @php $local = App::getLocale(); @endphp
                                    <table class="table table-striped table-bordered zero-configuration" id="myAnnouncesTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>@lang('site.title')</th>
                                                <th>@lang('site.content')</th>
                                                <th>@lang('site.send_date')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($rows as $index=>$noti)
                                            <tr>
                                                <td> {{++$index}} </td>
                                                <td> 
                                                    @if(gettype($noti->data) == 'string')
                                                        {{ json_decode($noti->data)->title->$local }}
                                                    @else
                                                        {{ $noti->data['title'][App::getLocale()] }}
                                                    @endif
                                                </td>
                                                <td> 
                                                    @include( 'dashboard.users.notis.' . \Illuminate\Support\Str::snake( class_basename($noti->type, '_') ) )
                                                </td>
                                                <td> {{ Carbon\Carbon::parse(json_decode($noti->data)->sendAt)->format('d M Y h:m') }} </td>
                                            </tr>
                                            @empty
                                                <tr><td colspan="4" style="text-align: center;"><h4>@lang('site.no_records')</h4></td></tr>
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>@lang('site.title')</th>
                                                <th>@lang('site.content')</th>
                                                <th>@lang('site.send_date')</th>
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
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
            crossorigin="anonymous">
    </script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#myAnnouncesTable').DataTable();
        } );
    </script>
@endpush