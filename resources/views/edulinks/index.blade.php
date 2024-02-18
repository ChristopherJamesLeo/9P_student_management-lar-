@extends('layouts.index')

@section('content_area')
    {{-- start create status --}}
    <div class="row">
        <div>
            <a href="javascript:void(0)"
            data-bs-target="#create_form"
            data-bs-toggle="modal" 
            class="btn btn-primary rounded-0">Create</a>


            {{-- start create Model --}}
            <div id="create_form" class="modal fade">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Create Education Link</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('edulinks.store')}}" method="POST">
                                @csrf
                                @method("POST")
                                <div class="row">
                                    <div class="col-12 form-group mb-2">
                                        <select name="post_id" id="post_id" class="form-control rounded-0 outline-none shadow-none">
                                            <option value="" selected disabled>Choose Post</option>

                                            @foreach ($posts as $idx => $name)
                                                <option value="{{$idx}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 form-group mb-2">
                                        <select name="tag_id" id="tag_id" class="form-control rounded-0 outline-none shadow-none">
                                            <option value="" selected disabled>Choose Class</option>

                                            @foreach ($tags as $idx => $name)
                                                <option value="{{$idx}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 form-group mb-2">
                                        <input type="date" name="classdate" id="classdate" class="form-control rounded-0 outline-none shadow-none" >
                                    </div>
                                    <div class="col-12 form-group mb-2">
                                        <input type="text" name="link" id="link" class="form-control rounded-0 outline-none shadow-none" placeholder="Enter Link" value="{{old("link")}}">
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary rounded-0 shadow-none outline-none">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            {{-- end create model --}}

            <hr>
            <div class="mt-3 row">
                    <div class="table_container" style="overflow-x: scroll;">
                        <div class="table_main_container" style="width: 1600px">
                        <table class="table w-100" >
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Class</th>
                                    <th>Class Type</th>
                                    <th>Date</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Stage</th>
                                    <th>By</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($edulinks as $idx => $edulink)
                                    @foreach ($enrolls as $enroll)
                                        @if ($edulink->post_id == $enroll->post_id)
                                            <tr>
                                                <td>{{$idx + $edulinks -> firstItem()}}</td>
                                                <td>
                                                    <a href="{{route('posts.show',$edulink->post->slug)}}"
                                                    wire:navigate>{{$edulink->post->name}}</a>
                                                </td>
                                                <td>{{$edulink->tag->name}}</td>
                                                <td>{{date("d M y",strToTime($edulink->classdate))}}</td>
                                                <td>
                                                    <a href="{{$edulink->link}}" target="_blank" title="{{$edulink->link}}">{{Str::limit($edulink->link,20)}}</a>
                                                </td>
                                                <td>{{$edulink->status->name}}</td>
                                                <td>{{$edulink->stage->name}}</td>
                                                <td>{{$edulink->user->name}}</td>
                                                <td>{{$edulink->created_at -> format("d M y")}}</td>
                                                <td>{{$edulink->updated_at -> format("d M y")}}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="javascript:void(0)"
                                                        data-id = "{{$edulink->id}}"
                                                        data-post-id = "{{$edulink->post->id}}"
                                                        data-tag-id = "{{$edulink->tag->id}}"
                                                        data-classdate = "{{$edulink->classdate}}"
                                                        data-link = "{{$edulink->link}}"
                                                        data-stage-id = "{{$edulink->stage->id}}"
                                                        data-status-id = "{{$edulink->status->id}}"
                                                        data-bs-toggle = "modal"
                                                        data-bs-target = "#edit_form"
                                                        class="btn btn-outline-primary btn-sm edit_form_btn"><i class="fas fa-edit"></i>
                                                        </a>
        
                                                        <a href="javascript:void(0)" 
                                                        data-id={{$edulink->id}} 
                                                        class="btn btn-danger btn-sm delete_btn" ><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>
                                                <form id="formdelete{{$edulink->id}}" action="{{route('edulinks.destroy',$edulink->id)}}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        {{ $edulinks->links("pagination::bootstrap-4") }}
                    </div>
                </div>

            </div>
        </div>
        

    </div> 
    {{-- end create status --}}

    {{-- start edit form --}}
    <div id="edit_form" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 mb-3" id="exampleModalLabel">Edit Education Link</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  method="POST" id="edit_box_form">
                        @csrf
                        @method("PUT")
                        <div class="row">
                            <div class="col-md-6 col-sm-12 form-group mb-2">
                                <select name="post_id" id="edit_post_id" class="form-control rounded-0 outline-none shadow-none">
                                    <option value="" selected disabled>Choose Post</option>

                                    @foreach ($posts as $idx => $name)
                                        <option value="{{$idx}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 form-group mb-2">
                                <select name="tag_id" id="edit_tag_id" class="form-control rounded-0 outline-none shadow-none">
                                    <option value="" selected disabled>Choose Class</option>

                                    @foreach ($tags as $idx => $name)
                                        <option value="{{$idx}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 col-sm-12 form-group mb-2">
                                <input type="date" name="classdate" id="edit_classdate" class="form-control rounded-0 outline-none shadow-none" >
                            </div>
                            <div class="col-md-12 col-sm-12 form-group mb-2">
                                <input type="text" name="link" id="edit_link" class="form-control rounded-0 outline-none shadow-none" placeholder="Enter Link" value="{{old("link")}}">
                            </div>
                            <div class="col-md-6 col-sm-12 form-group mb-2">
                                <select name="status_id" id="edit_status_id" class="form-control rounded-0 outline-none shadow-none">
                                    <option value="" selected disabled>Choose Status</option>

                                    @foreach ($statuses as $idx => $name)
                                        <option value="{{$idx}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12  form-group mb-2">
                                <select name="stage_id" id="edit_stage_id" class="form-control rounded-0 outline-none shadow-none">
                                    <option value="" selected disabled>Choose Stage</option>

                                    @foreach ($stages as $idx => $name)
                                        <option value="{{$idx}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="" id="user_email" value="{{Auth::user()->email}}">
                            <div class="col-md-12 col-sm-12 form-group mb-2">
                                <input type="text" name="" id="edit_email_confirm" class="form-control rounded-0 outline-none shadow-none" placeholder="Confirm You Email">
                            </div>

                            <input type="hidden" name="edulink_id" id="edulink_id" value="">
                            <div class="d-flex justify-content-end">
                                <button type="button" id="submit_btn" class="btn btn-primary rounded-0 shadow-none outline-none">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end edit form --}}
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

        // start edit form
        $(".edit_form_btn").click(function(){
            let getId = $(this).data("id");
            let getpost = $(this).data("post-id");
            let gettag = $(this).data("tag-id");
            let getclassdate = $(this).data("classdate");
            let getlink = $(this).data("link");
            let getstatus = $(this).data("status-id");
            let getstage = $(this).data("stage-id");

            // console.log(getpost,gettag,getclassdate,getlink,getstatus,getstage);

            $("#edit_post_id").val(getpost);
            $("#edit_tag_id").val(gettag);
            $("#edit_classdate").val(getclassdate);
            $("#edit_link").val(getlink);
            $("#edit_status_id").val(getstatus);
            $("#edit_stage_id").val(getstage);

            $("#edit_box_form").attr("action",`/edulinks/${getId}`)
        })

        $("#submit_btn").click(function(){
            
            let getuseremail = $("#user_email").val();

            let getconemail = $("#edit_email_confirm").val();

            if(getuseremail === getconemail){
                $(`#edit_box_form`).submit();
            }else{
                window.alert("Permission Denied");
                $("#edit_email_confirm").focus();
            }
        })
        // end edit form

        // $(".change-btn").click(function(){
        //     var getId = $(this).data("id");
        //     let setstatus = $(this).prop("checked") === true ? 3 : 4 ;

        //     // console.log(status_id);

        //     $.ajax({
        //         url : "edulinkstatus",
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
