@extends('dashboard.layouts.app')


@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        {!! $dataTable->table() !!}

    </div>
</div>
@endsection

@push('style')

{{-- start datatables style for yajar package --}}
<!-- Bootstrap CSS -->
{{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
{{-- <link rel="stylesheet" href="{{ asset('dashboard_files/datatable/jquery.dataTables.min.css') }}"> --}}

{{-- end  datatables style for yajar package --}}
@endpush
@push('script')
 {{-- start datatables script for yajar package --}}
    <!-- jQuery -->
    {{-- <script src="//code.jquery.com/jquery.js"></script> --}}
    <!-- DataTables -->
    {{-- <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script> --}}
    <script src="{{ asset('dashboard_files/datatable/jquery.dataTables.min.js') }}"></script>
    <!-- Bootstrap JavaScript -->
    {{-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> --}}
    {{-- end  datatables script for yajar package --}}
    {!! $dataTable->scripts() !!}


@endpush