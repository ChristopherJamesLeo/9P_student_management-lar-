@extends('layouts.index')

@section('content_area')
    {{-- start create status --}}
    <div class="row">
        <div>
            <a href="{{route('posts.create')}}" wire:navigate class="btn btn-primary rounded-0">Create</a>
            <hr>
            <div class="mt-3 row">
                <div class="table_container" style="overflow-x: scroll;">
                    <div class="table_main_container" style="width: 2000px">
                        <table class="table w-100" >
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Fee</th>
                                    <th>Tag Name</th>
                                    <th>Type</th>
                                    <th>Att Show</th>
                                    <th>Status</th>
                                    <th>By</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $idx => $post)
                                    <tr>
                                        <td>{{$idx + $posts -> firstItem()}}</td>
                                        <td>
                                            <a href="{{route('posts.show',$post->slug)}}" wire:navigate>
                                                <div>
                                                    <img src="{{asset($post->image)}}" width="70px" height="70px" style="object-fit: cover" alt="">
                                                </div>
                                            </a>
                                            
                                        </td>
                                        <td>
                                            <a href="{{route('posts.show',$post->slug)}}" 
                                                wire:navigate
                                                class="nav-link">{{$post->name}}</a>
                                        </td>
                                        <td>{{$post->startdate}}</td>
                                        <td>{{$post->enddate}}</td>
                                        <td>{{$post->starttime}}</td>
                                        <td>{{$post->endtime}}</td>
                                        <td>{{$post->fee}}</td>
                                        <td>
                                            <span title="{{$post->tag->name}}">{{Str::limit($post->tag->name,20)}}</span>
                                        </td>
                                        <td>{{$post->type->name}}</td>
                                        <td>{{$post->attstatus->name}}</td>
                                        <td>{{$post->status->name}}</td>
                                        <td>{{$post->user->name}}</td>
                                        <td>{{$post->created_at -> format("d M y")}}</td>
                                        <td>{{$post->updated_at -> format("d M y")}}</td>
                                        <td>
                                            <div class="d-flex gap-2">

                                                <a href="{{route('posts.edit',$post->slug)}}"
                                                wire:navigate 
                                                 class="btn btn-outline-primary btn-sm edit_form_btn"><i class="fas fa-edit"></i>
                                                </a>

                                                {{-- <a href="javascript:void(0)" 
                                                data-id={{$post->id}} 
                                                class="btn btn-danger btn-sm delete_btn" ><i class="fas fa-trash"></i></a> --}}
                                            </div>
                                        </td>
                                        {{-- <form id="formdelete{{$post->id}}" action="{{route('posts.destroy',$post->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form> --}}
                                    </tr>
                                @endforeach
                
                            </tbody>
                        </table>
                        {{ $posts->links("pagination::bootstrap-4") }}
                    </div>
                </div>

            </div>
        </div>
        

    </div> 
    {{-- end create status --}}
@endsection

@section("script")

<script>
    $(document).ready(function(){

        // start delete btn
        // $(".delete_btn").click(function(){
        //     let getId = $(this).data("id");
        //     if(window.confirm("Are You Sure To Delete!!!")){
        //         $(`#formdelete${getId}`).submit();
        //     }
            
        // })
        // end delete btn

        // $(".change-btn").click(function(){
        //     var getId = $(this).data("id");
        //     let setstatus = $(this).prop("checked") === true ? 3 : 4 ;

        //     // console.log(status_id);

        //     $.ajax({
        //         url : "poststatus",
        //         type : "GET",
        //         dataType : "json",
        //         data : {
        //             "id" : getId,
        //             "status_id" : setstatus
        //         },
        //         success : function(response){
        //             console.log(response.success);
        //         }
        //     });

        // })
    })
</script>
@endsection
