@extends('app')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Quotes</h1>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quotes</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Author Name</th>
                            <th>Category</th>
                            <th>Sub-Category</th>
                            <th>Collection</th>
                            <th>Quote</th>
                            <th>likes</th>
                            <th>Dis-Likes</th>
                            <th>Favorite</th>
                            <th>Un-Favorite</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($quotations as $quotes)
                            <tr>
                                <td>{{$quotes->author_name}}</td>
                                <td>{{!empty($quotes->category->name)? $quotes->category->name: "Category Not Found"}} </td>
                                <td>{{!empty($quotes->subcategory->name)? $quotes->subcategory->name: "Subcategory Not Found"}} </td>
                                <td>{{!empty($quotes->collection->collection_name)? $quotes->collection->collection_name: "Collection Not Found"}} </td>
                                <td>{{$quotes->quote}}</td>
                                <td>{{$quotes->likes_count}}</td>
                                <td>{{$quotes->dislikes_count}}</td>
                                <td>{{$quotes->favorites_count}}</td>
                                <td>{{$quotes->unfavorites_count}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 @endsection
