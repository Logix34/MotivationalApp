@extends('app')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Themes</h1>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Themes</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th> Theme Name</th>
                            <th>Created At</th>
                            <th>Background Image</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($userThemes as $userTheme)
                                <tr>
                                    <td>{{$userTheme->theme->name}}</td>
                                    <td>{{$userTheme->theme->created_at->format('d-m-y g:i A')}}</td>
                                    <td><img src="{{$userTheme->theme->background_image}}" height="150px" width="150px" class="ml-5"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
