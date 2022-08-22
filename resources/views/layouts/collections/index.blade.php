@extends('app')
@section('content')
    <style>
         .fa-solid{
             color:  #ff6666;
         }
    </style>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Collections</h1>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Collections</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Collection Name</th>
                            <th>Collection Status</th>
                            <th>Ratings</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>

                           @foreach($collections as $k=>$collection)
                               <tr>
                                   <td>{{$collection->collection_name}}</td>
                                   <td>{{($collection->collection_type =='0')? 'public': "Private"}} </td>
                                    <td>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="star-rating{{$k}}">
                                                        <span id="fa{{$k}}" class="fa-star fa-regular"  data-rating="1" ></span>
                                                        <span id="fa{{$k}}" class="fa-star fa-regular"  data-rating="2" ></span>
                                                        <span id="fa{{$k}}" class="fa-star fa-regular"  data-rating="3" ></span>
                                                        <span id="fa{{$k}}" class="fa-star fa-regular"  data-rating="4" ></span>
                                                        <span id="fa{{$k}}" class="fa-star fa-regular"  data-rating="5" ></span>
                                                        <input type="hidden"  id="collection_rating{{$k}}" name="rating" class="rating-value" value="{{$collection->ratings_avg_rating}}">
                                                        <input type="hidden" id="collection_id{{$k}}" name="collection_id" value="{{$collection->id}}">
                                                        {{$collection->id}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                       @if($collection->collection_type == '0')
                                           <td>
                                               <a type="button" href=" {{url('change_collection-type/'.$collection->id)}}" class="btn btn-danger">Private</a>
                                           </td>
                                            @else($collection->collection_type == '1')
                                               <td>
                                                   <a type="button" href=" {{url('change_collection-type/'.$collection->id)}}" class="btn btn-success">Public</a>
                                               </td>
                                       @endif
                               </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $( document ).ready(function() {
            var SetRatingStar = function(id){
            var $star_rating = $('.star-rating'+id+' #fa'+id);

                $star_rating.on('click', function () {
                    var werw=$star_rating.siblings('input.rating-value').val($(this).data('rating'));
                    ajaxCall(id);
                    return $star_rating.each(function() {
                        if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
                            return $(this).removeClass('fa-regular').addClass('fa-solid');
                        }else{
                            return $(this).removeClass('fa-solid').addClass('fa-regular');
                        }
                    });
                });
            return $star_rating.each(function() {
                if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
                    return $(this).removeClass('fa-regular').addClass('fa-solid');
                } else {
                    return $(this).removeClass('fa-solid').addClass('fa-regular');
                }
            });
        };
            @foreach($collections as $k=>$collection)
            SetRatingStar({{$k}});
            @endforeach


        });
        function ajaxCall(id){
            $.ajax({
                method:'POST',
                headers: {
                    'X-CSRF-Token':' {{csrf_token()}}'
                },
                data: {
                    'collection_id' : $('#collection_id'+id).val(),
                    'rating'        :$('#collection_rating'+id).val(),
                },
                url: "collection-ratings",
                success:function (data) {
                   location.reload();

                }
            });
        }
    </script>
@endsection
