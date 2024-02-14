@extends('layouts.index')

@section("style")
<style>
    .show_detail li{
        padding: 10px 10px;
    }
    .show_detail li:hover {
        background-color: #f4f4f4;
    }

    .comment_box {
        /* max-height: 500px; */
        padding: 10px;
        border: 1px solid #f4f4f4;

        overflow-y: scroll ;
    }
    .comment_box ul li {
        font-size: 14px;
        padding: 20px;
        border-bottom: 1px solid #f4f4f4;
    }
    .comment_box ul li:last-of-type{
        border: none;
        padding: 20px 10px 10px 10px;
    }
</style>
@endsection
@section('content_area')
    {{-- start create status --}}
    <div class="row">
        <div>
            <a href="{{route('users.index')}}" wire:navigate class="btn btn-primary rounded-0">Back</a>
            <hr>
            <div class="mt-3 row">
                <div class="col-md-4 col-sm-12 mb-3">
                    <div class="text-center title">
                        <h5>{{$user->name}}</h5>
                        <small class="">{{$user->registration->reg_no}}</small>
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="d-block text-start fw-bold" style="font-size: 13px">Email</span>
                                <span class="d-block text-start" style="font-size: 13px">{{$user->email}}</span>
                            </div>
                            <div>
                                <span class="d-block text-end fw-bold" style="font-size: 13px">Status</span>
                                <span class="d-block text-end" style="font-size: 13px">{{$user->status->name}}</span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="mt-3 d-flex">
                        <a href="{{route('users.edit',$user->id)}}" 
                            class="w-100 btn btn-primary rounded-0 shadow-none outline-none">Like</a>

                        <a href="javascript:void(0)"
                            class="w-100 btn btn-outline-primary rounded-0 shadow-none outline-none ">Follow</a>
                    </div>
                    <div class="p-2 cover_photo">
                    </div>
                    <div >
                        <div>
                            <span class="fw-bold d-block text-center">Info</span>
                            <ul class="p-2 list-unstyled show_detail" style="font-size: 14px">
                                <li class=" d-flex justify-content-between">
                                    <span>Like</span>
                                    <span><small>1 Likes</small></span>
                                </li>
                                <li class=" d-flex justify-content-between">
                                    <span>Follower</span>
                                    <span><small>1 Followers</small></span>
                                </li>
                                <hr>
                                <li class=" d-flex justify-content-between">
                                    <span>Gender</span>
                                    <span><small>{{$user->gender->name}}</small></span>
                                </li>
                                <li class=" d-flex justify-content-between">
                                    <span>Role</span>
                                    <span><small>{{$user->role->name}}</small></span>
                                </li>
                                <li class=" d-flex justify-content-between">
                                    <span>City</span>
                                    <span><small>{{$user->city->name}}</small></span>
                                </li>
                                <li class=" d-flex justify-content-between">
                                    <span>Country</span>
                                    <span><small>{{$user->country->name}}</small></span>
                                </li>
                                <li class=" d-flex justify-content-between">
                                    <span>Created At</span>
                                    <span><small>{{$user->created_at->format("d M Y | h:m:s a")}}</small></span>
                                </li>
                                <li class=" d-flex justify-content-between">
                                    <span>Updated_at</span>
                                    <span><small>{{$user->updated_at->format("d M Y | h:m:s a")}}</small></span>
                                </li>
                            </ul>
                        </div>
                        
                        <hr>
                        <div class="d-flex">
                            <a href="{{route('users.edit',$user->id)}}"
                                wire:navigate 
                                class="w-100 btn btn-primary rounded-0 shadow-none outline-none">Edit</a>
                            <a href="javascript:void(0)"
                            data-bs-toggle="modal"
                            data-bs-target="#delete_model"
                            data-id={{$user->id}}  
                            data-email = {{Auth::user()->email}}
                            class="w-100 btn btn-outline-primary rounded-0 shadow-none outline-none delete_btn">Delete</a>
                        </div>
                        <form id="formdelete{{$user->id}}" action="{{route('users.destroy',$user->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="dayable_type" value="App\Models\User">
                        </form>

                    </div>
                </div>

                <div class="col-md-8 col-sm-12">
                    <div class="mb-5">
                       
                    </div>

                    

                </div>
            </div>
        </div>
        

    </div> 
    {{-- end create status --}}

    {{-- start confirm box --}}
    <div id="delete_model" class="modal fade">
        <div class="modal-dialog modal-sm modal-dialog-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>Confrim Delete</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editform" method="POST">

                        <div class="row">
                            <div class="col-12 mb-3 form-group">
                                <input type="text" name="name" id="" class="form-control rounded-0 outline-none shadow-none border" placeholder="Enter Status" value="{{$user->name}}" readonly >
                            </div>
                            <div class="col-12 mb-3 form-group">
                                <input type="email" class="form-control rounded-0 outline-none shadow-none border confirm_email_box" placeholder="Confirm Your Email" value="">
                            </div>
                            <div class="col-12 mb-3">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary rounded-0 outline-none shadow-none confirm_email">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end confirm box --}}
@endsection

@section("script")

<script>
    $(document).ready(function(){


        $(".confirm_email").click(function(){
            let getId = $(".delete_btn").data("id");;
            let getUserEmail = $(".delete_btn").data("email");
            let getEmail = $(".confirm_email_box").val();

            if(getUserEmail === getEmail){
                $(`#formdelete${getId}`).submit();
            }else{
                window.alert("Permission Denied");
            }
            
        })

    })
</script>
@endsection
