@extends('app')
@section('content')
    <style>
        .star-rating {
        line-height:32px;
        font-size:1.25em;
        }

        .star-rating .fa-solid{color: darkred;}
    </style>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Categories</h1>
            <a href="" data-toggle="modal" data-target="#AddModalLabel" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-plus"></i>
                Add category
            </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">categories</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>description</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>
                                <td>
                                    <a class="btn btn-sm" onclick="editCategory({{$category->id}})"><i class="fas fa-edit"></i></a>
                                    <a class="btn  delete btn-sm"  href="{{url('delete_Category/' .$category->id) }}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--    Add Categories Model--}}
    <div class="modal fade" id="AddModalLabel" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddModalLabel">Add Category</h5>
                </div>
                <form action="{{route('add_categories')}}" method="POST" autocomplete="off" >
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" name="name" class="form-control validate" id="name" placeholder="Enter Name" required>
                        </div>
                       <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" class="form-control validate" id="description" placeholder="Enter Description" required>
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
    <!-- /////////////////////////////////////////...........Edit model Category form ..........////////////////-->
    <div class="modal fade" id="updateModalLabel" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Category</h5>
                </div>
                <form method="post" action="{{route('update_categories')}}" autocomplete="off" novalidate>
                    @csrf
                    <input type="hidden" id="category_id" name="id" class="form-control">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" name="name" class="form-control" id="category_name" placeholder="Enter Name">
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Description</label>
                            <input type="text" name="description" class="form-control" id="edit_description" placeholder="Enter Description" required>
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


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="star-rating">
                    <span id="fa" class="fa-regular fa-star " data-rating="1"></span>
                    <span id="fa" class="fa-regular fa-star" data-rating="2" ></span>
                    <span id="fa"  class="fa-regular fa-star" data-rating="3"></span>
                    <span id="fa" class="fa-regular fa-star" data-rating="4" ></span>
                    <span id="fa" class="fa-regular fa-star" data-rating="5"></span>
                        <input type="hidden" name="whatever1" class="rating-value" value="">
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

    <script>
        setTimeout(() => {
            $('.alert').alert('close');
        }, 2000); function editCategory(id)
        {

            $.ajax({
                url:"{{ url('edit/category') }}"+"/"+id,
                success:function (data) {
                    console.log(data.id);
                    $("#category_id").val(data.id);
                    $("#category_name").val(data.name);
                    $("#edit_description").val(data.description);
                    $("#updateModalLabel").modal("show");
                }
            })
        }

            var $star_rating = $('.star-rating #fa');

            var SetRatingStar = function(){
            return $star_rating.each(function() {
            if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
            return $(this).removeClass('fa-regular').addClass('fa-solid');
        } else {
            return $(this).removeClass('fa-solid').addClass('fa-regular');
        }
        });
        };
            $star_rating.on('click', function() {
            $star_rating.siblings('input.rating-value').val($(this).data('rating'));
            return SetRatingStar();
        });
            console.log($star_rating);
    </script>
@endsection
