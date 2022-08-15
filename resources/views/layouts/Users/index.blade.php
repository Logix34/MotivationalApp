@extends('app')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>first Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        var dt = $('#dataTable').DataTable( {
            "processing": true,
            "responsive": true,
            "ordering": false,
            "serverSide": true,
            "ajax": "{{ url('/users_list')}}",
            "columns": [
                { "data": "first_name"},
                { "data": "last_name" },
                { "data": "email" },
                { "data": "status" },
                { "data": "action",searchable: true,orderable: false }
            ],
            "order": [[1, 'Asc']]
        } );
    </script>
@endsection
