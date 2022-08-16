@extends('app')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sub-Categories</h1>
            <a href="" data-toggle="modal" data-target="#AddModalLabel" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-plus"></i>
                Add Sub-Category
            </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sub-Categories</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category Name </th>
                            <th>description</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($subcategories as $subcategory)
                            <tr>
                                <td>{{$subcategory->name}}</td>
                                <td>{{$subcategory->category->name}}</td>
                                <td>{{$subcategory->description}}</td>
                                <td>
                                    <a class="btn btn-sm" onclick="editCategory({{$subcategory->id}})"><i class="fas fa-edit"></i></a>
                                    <a class="btn  delete btn-sm"  href="{{url('delete_sub-category/' .$subcategory->id) }}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--    Add Sub-Categories Model--}}
    <div class="modal fade" id="AddModalLabel" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddModalLabel">Add Sub-Category</h5>
                </div>
                <form method="post" action="{{route('add_sub-categories')}}" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="form-label">Sub-Category Name</label>
                            <input type="text" name="name" class="form-control validate" id="name" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control" name="category_id" id="category_id">
                                {{$categories}}
                                @foreach($categories as $category)
                                    <option {{ isset($detail->category_id)&&$detail->category_id == $category->name?'selected':"" }} value="{{ $category->id }}">{{ $category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" class="form-control validate" id="description" placeholder="Enter description" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--    Edit Sub-Categories Model--}}
    <div class="modal fade" id="updateModalLabel" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Sub-Category</h5>
                </div>
                <form method="post" action="{{route('update_sub-categories')}}" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <input  name="id" type="hidden" id="subcategory_id">
                        <div class="form-group">
                            <label for="subcategory_name" class="form-label">Sub-Category Name</label>
                            <input type="text" name="name" class="form-control" id="subcategory_name" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label for="editcategory_id">Category</label>
                            <select class="form-control" name="category_id" id="editcategory_id">
                                {{$categories}}
                                @foreach($categories as $category)
                                    <option {{ isset($detail->category_id)&&$detail->category_id == $category->name?'selected':"" }} value="{{ $category->id }}">{{ $category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editsubcategory_description" class="form-label">Sub-Category Name</label>
                            <input type="text" name="description" class="form-control" id="editsubcategory_description" placeholder="Enter description" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div></form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function editCategory(id)
        {

            $.ajax({
                url:"{{ url('edit/sub-category') }}"+"/"+id,
                success:function (data) {
                    $("#subcategory_id").val(data.id);
                    console.log(data.id);
                    $("#subcategory_name").val(data.name);
                    $("#editcategory_id").val(data.category_id);
                    $("#editsubcategory_description").val(data.description);
                    $("#updateModalLabel").modal("show");
                }
            })
        }
    </script>

@endsection
