@extends('layouts.index')

@section('content_area')
    {{-- start create status --}}
    <div class="row">
        <div>
            <a href="{{route('posts.create')}}" wire:navigate class="btn btn-primary rounded-0">Create</a>
            <hr>
            <div class="mt-3 row">
                <div class="table_container" style="overflow-x: scroll;">
                    {{-- <div class="table_container" style="overflow-x: scroll;"> --}}
                    <div class="table_main_container" >
                        {{-- <div class="table_main_container" style="width: 2000px"> --}}
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>No.</th>
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
                                        {{-- <td>{{$idx + $statuses -> firstItem()}}</td> --}}
                                        <td>{{$idx + $posts -> firstItem()}}</td>
                                        <td>{{$post->name}}</td>
                                        <td>{{$post->startdate}}</td>
                                        <td>{{$post->enddate}}</td>
                                        <td>{{$post->starttime}}</td>
                                        <td>{{$post->endtime}}</td>
                                        <td>{{$post->fee}}</td>
                                        <td>{{$post->tag_id}}</td>
                                        <td>{{$post->type_id}}</td>
                                        <td>{{$post->attshow}}</td>
                                        <td>
                                            <div class="form-checkbox form-switch">
                                                <input type="checkbox" name="" id="" 
                                                {{$post->status_id == 3 ? "checked" : " "}} 
                                                data-id = {{$post->id}} 
                                                class="form-check-input shadow-none outline-none change-btn" >
                                            </div>
                                        </td>
                                        <td>{{$post->user["name"]}}</td>
                                        <td>{{$post->created_at -> format("d M y")}}</td>
                                        <td>{{$post->updated_at -> format("d M y")}}</td>
                                        <td>
                                            <div class="d-flex gap-2">

                                                <a href="javascript:void(0)"
                                                 class="btn btn-outline-primary btn-sm edit_form_btn"><i class="fas fa-edit"></i>
                                                </a>

                                                <a href="javascript:void(0)" 
                                                data-id={{$post->id}} 
                                                class="btn btn-danger btn-sm delete_btn" ><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                        <form id="formdelete{{$post->id}}" action="{{route('posts.destroy',$post->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
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
        $(".delete_btn").click(function(){
            let getId = $(this).data("id");
            if(window.confirm("Are You Sure To Delete!!!")){
                $(`#formdelete${getId}`).submit();
            }
            
        })
        // end delete btn

        $(".change-btn").click(function(){
            var getId = $(this).data("id");
            let setstatus = $(this).prop("checked") === true ? 3 : 4 ;

            // console.log(status_id);

            $.ajax({
                url : "poststatus",
                type : "GET",
                dataType : "json",
                data : {
                    "id" : getId,
                    "status_id" : setstatus
                },
                success : function(response){
                    console.log(response.success);
                }
            });

        })
    })
</script>
@endsection
