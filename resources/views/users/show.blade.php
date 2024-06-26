@extends('layouts.index')

@section("style")
<style>

    .leave_table_container {
        width: 100%;
        max-height: 200px;
        overflow-y: scroll;
    }
    label[for="coverphotos"]{
        display: block;
        margin-bottom: 10px;
    }
    label {
        font-size: 14px;
    }
    .gallery {
        width: 100%;
        background-color: #eee;
        color: #aaa;
        display: flex;
        justify-content: center;
    }
    .gallery img {
        display: none;
        width: 200px;
        height: auto;
        border: 2px solid #aaa;
        border-radius: 0px;
        object-fit: cover;
        padding: 2px;
        /* margin: 0 5px; */
    }
    .gallery.removetxt span{
        display: none;
    }
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
    .enroll_container {
        font-size: 14px;
    }
    .enroll_container:hover {
        border-color : rgba(0, 0, 255, 0.54) !important;
    }

    .contact_email_form .form-control,.contact_email_form .form-control::placeholder {
        font-size: 14px;
    }
</style>
@endsection
@section('content_area')
    {{-- start create status --}}
    <div class="row">
        <div>
            <a href="javascript:void(0)" class="btn btn-primary rounded-0 back_btn">Back</a>
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

                    @if (Auth::user()->id != $user->id)
                        <div class="mt-3 d-flex">
                            @if (!$user -> checklike($user->id))
                                <a href="{{route('user.like',$user->id)}}" 
                                wire:navigate
                                class="w-100 btn btn-primary rounded-0 shadow-none outline-none">Like</a>
                            @else
                                <a href="{{route('user.unlike',$user->id)}}" 
                                wire:navigate
                                class="w-100 btn btn-primary rounded-0 shadow-none outline-none">Unlike</a>
                            @endif
                                <a href="{{route('user.message',$user->slug)}}"
                                    wire:navigate
                                    class="w-100 btn btn-outline-primary rounded-0 shadow-none outline-none ">Message</a>
                        </div>
                    @endif
                    
                    <div class="p-2 cover_photo">
                    </div>
                    <div >
                        <div>
                            <span class="fw-bold d-block text-center">Info</span>
                            <ul class="p-2 list-unstyled show_detail" style="font-size: 14px">
                                <li class=" d-flex justify-content-between">
                                    <span>Like</span>
                                    <span><small>{{$user->countlike($user->id)}} Likes</small></span>
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
                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <div class="d-flex">
                                <a href="javascript:void(0)" 
                                data-bs-toggle = "modal"
                                data-bs-target="#user_login_edit_form"
                                class="w-100 btn btn-primary rounded-0">Edit</a>
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
                        @endif


                    </div>
                </div>

                {{-- start user edit log in form modal --}}
                <div id="user_login_edit_form" class="modal fade">
                    <div class="modal-dialog modal-lg modal-dialog-center">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6>Edit User Info</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('users.update',$user->id)}}" method="POST">
                                    @csrf
                                    @method("PUT")
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 mb-2 form-group">
                                            <label for="name">User Name</label>

                                            <input type="text" name="name" id="name" class="form-control rounded-1 outline-none shadow-none border" value="{{old('name',$user->name)}}" placeholder="Enter Your Name" readonly>
                                        </div>
                                        <div class="col-md-6 col-sm-12 mb-2 form-group">
                                            <label for="email">User Email</label>
                                            <input type="email" name="email" id="email" class="form-control rounded-1 outline-none shadow-none border" value="{{old('email',$user->email)}}" placeholder="Enter Your Email" readonly>
                                        </div>
                                        @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
                                            <div class="col-md-6 col-sm-12 mb-2 form-group">
                                                <label for="status_id">Status</label>
                                                <select name="status_id" id="status_id" class="form-select rounded-0 shadow-none outline-none">
                                                    <option value="" selected disabled>Choose Status</option>
                                                    @foreach ($statuses as $id => $name)
                                                        <option value="{{$id}}"  {{$id == $user->status_id ? "selected" : ""}}>{{$name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-sm-12 mb-2 form-group">
                                                <label for="role_id">Role</label>
                                                <select name="role_id" id="role_id" class="form-select rounded-0 shadow-none outline-none">
                                                    <option value="" selected disabled>Choose Role</option>
                                                    @foreach ($roles as $id => $name)
                                                        <option value="{{$id}}"  {{$id == $user->role_id ? "selected" : ""}}>{{$name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif

                                        <div class="col-md-6 col-sm-12 mb-2 form-group">
                                            <label for="gender_id">Gender</label>
                                            <input type="text" name="gender" id="gender" class="form-control rounded-1 outline-none shadow-none border" value="{{old('gender',$user->gender->name)}}"  readonly>
                                        </div>
                                        
                                        <div class="col-md-6 col-sm-12 mb-2 form-group">
                                            <label for="city_id">City</label>
                                            <input type="text" name="city" id="city" class="form-control rounded-1 outline-none shadow-none border" value="{{old('gender',$user->city->name)}}"  readonly>
                                        </div>
                                        <div class="col-md-12 col-sm-12 mb-2 form-group">
                                            <label for="country_id">Country</label>
                                            <input type="text" name="country" id="country" class="form-control rounded-1 outline-none shadow-none border" value="{{old('gender',$user->country->name)}}" readonly>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary rounded-0">Submit</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                {{-- end user edit log in form modal --}}

                <div class="col-md-8 col-sm-12">
                    <div class="mb-5">
                        @if (count($leaves) > 0)
                            
                            <div class="mb-3 border p-2 leave_container">
                                <h5 style="font-size: 16px">Leave Record</h5>
                                <span class="d-block text-end" style="font-size: 12px;">Total Leave - {{count($leaves)}}</span>
                                <div class="leave_table_container">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Stage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($leaves as $leave)
                                                <tr>
                                                    <td>
                                                        {{date("d M Y",strToTime($leave->startdate))}}
                                                    </td>
                                                    <td>
                                                        {{date("d M Y",strToTime($leave->enddate))}}
                                                    </td>
                                                    <td>{{$leave->stage->name}}</td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
    
                                </div>
                                
                                
                            </div>
                        
                        @endif
                        {{-- start leave button --}}
                    @if( $user->id != Auth::user()->id)
                           
                         
                        @if ($user->role_id == 1 || $user->role_id == 2 )
                                    
                            <div class="mb-3 d-grid">
                                <button type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#leave_model"
                                class="btn btn-primary rounded-0 shadow-none border-none outline-none">Leave</button>
                            </div>

                            {{-- start leave model --}}
                            <div id="leave_model" class="modal fade">
                                <div class="modal-dialog modal-lg modal-dialog-center">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6>Leave Form</h6>
                                            
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('leaves.store')}}" id="leave_from" method="POST" enctype="multipart/form-data" >
                                                @csrf 
                                                @method("POST")
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group mb-2">
                                                            <input type="file" name="image" id="coverphotos" class="form-control rounded-0 shadow-none outline-none "/>
                                                            
                                                        </div>
                                                        <label for="coverphotos">
                                                            <div class="gallery">
                                                                <img src="" alt="">
                                                                <span>Choose Images</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="row">
                                                            <input type="hidden" name="admin_id" value="{{$user->id}}">
                                                            <div class="col-12 mb-2 form-group">
                                                                <label for="">To</label>
                                                                <input type="text" name="" id="" class="form-control rounded-0 outline-none shadow-none" value="{{$user->name}}" readonly>
                                                            </div>
                                                            <div class="col-12 mb-2 form-group">
                                                                <label for="startdate">Start Date</label>
                                                                <input type="date" name="startdate" id="startdate" class="form-control rounded-0 outline-none shadow-none" value="{{$today}}">
                                                            </div>
                                                            <div class="col-12 mb-2 form-group">
                                                                <label for="enddate">End Date</label>
                                                                <input type="date" name="enddate" id="enddate" class="form-control rounded-0 outline-none shadow-none" value="{{$today}}">
                                                            </div>
                                                            <div class="col-12 mb-2 form-group">
                                                                <label for="post_id">Class</label>
                                                                <select name="post_id" id="post_id" class="form-control rounded-0 outline-none shadow-none">
                                                                    <option value="" selected disabled>Choos Class</option>
                                                                    @foreach ($posts as $post)
                                                                        <option value="{{$post->post_id}}">{{$post->post->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-12 mb-2 form-group">
                                                                <label for="message">Message</label>
                                                                <textarea  name="message" id="message" class="form-control rounded-0 outline-none shadow-none" >{{old("message")}}</textarea>
                                                            </div>
                                                            {{-- user email hidden --}}
                                                            <input type="hidden" name="" id="user_email" value="{{Auth::user()->email}}">
                                                            {{-- user email hidden --}}
                                                            <div class="col-12 mb-3 form-group">
                                                                
                                                                <input type="text" name="" id="confirm_leave_email" class="form-control rounded-0 outline-none shadow-none" placeholder="Confirm Your Email">
                                                            </div>
                                                            <div class="col-12 mb-3">
                                                                <div class="d-flex justify-content-end">
                                                                    <button type="button" id="leave_submit_btn" class="btn btn-primary rounded-0 outline-none shadow-none">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end leave model --}}
                        @endif
                        {{-- end leave button --}}
                        
                        {{-- start email contact form --}}
                        <form action="{{route('user.sendemail',$user->id)}}" method="POST" class="contact_email_form">
                            @csrf
                            @method("POST")
                            <div class="row">
                                <h6>Send Email</h6>
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <div class="col-md-6 col-sm-12 mb-2 form-group">
                                    <input type="text" name="comemail" id="comemail" class="form-control rounded-0 outline-none shadow-none" placeholder="Enter Email Address" value="{{old('comemail',$user->email)}}" readonly>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-2 form-group">
                                    <input type="text" name="comsubject" id="comsubject" class="form-control rounded-0 outline-none shadow-none" placeholder="Enter Subject" value="{{old('comsubject')}}">
                                </div>
                                <div class="col-md-12 col-sm-12 mb-2 form-group">
                                    <textarea type="text" name="comcontent" id="comcontent" rows="5" class="form-control rounded-0 outline-none shadow-none" placeholder="Enter Subject">{{old('comcontent')}}</textarea>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary rounded-0">Send</button>
                                </div>

                            </div>
                        </form>
                        {{-- end email contact form --}}
                        <hr>
                    @endif
                        <h6 class="mt-2">Enrolls</h6>
                        <div class="row">
                            @foreach ($enrolls as $enroll)
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <div class="p-2 border d-flex flex-column gap-2 enroll_container">
                                        <span><a href="{{route('posts.show',$enroll->post->slug)}}" wire:navigate>{{$enroll->post->name}}</a></span>
                                        <span>{{$enroll->stage->name}}</span>
                                        <span>{{$enroll->updated_at->diffForHumans()}}</span>
                                    </div>
                                </div>
                            @endforeach
                            
                        </div>
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

    document.querySelector(".back_btn").addEventListener("click",function(){
        window.history.back();
    })
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

        $("#leave_submit_btn").click(function(){
            let getUserEmail = $("#user_email").val();
            let getEmail = $("#confirm_leave_email").val();
            
            console.log(getUserEmail,getEmail);

            if(getUserEmail === getEmail){
                $(`#leave_from`).submit();
            }else{
                window.alert("Permission Denied");
            }
            
        })

        // show image
        let getprofileinputbox = document.querySelector("#coverphotos");
        let getshowimg = document.querySelector(".gallery img");
        let getimgtitle = document.querySelector(".gallery span");
        getprofileinputbox.addEventListener("change",function(){
            var reader = new FileReader();
            reader.onload = function(e){
                getshowimg.style.display="block";
                getimgtitle.style.display = "none";
                getshowimg.setAttribute("src",e.target.result); 
            }
            reader.readAsDataURL(this.files[0]);
        })

    })
</script>
@endsection
