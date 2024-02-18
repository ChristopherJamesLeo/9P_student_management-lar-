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
    .post_enroll_list_container {
        margin: 20px 0px;
        padding: 10px;
        border: 1px solid #f4f4f4;
        max-height: 400px;
        overflow: scroll;
    }

    .post_enroll_list_container ul li{
        padding: 10px;
        font-size: 14px;
        border-bottom: 1px solid #f4f4f4;
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
</style>
@endsection
@section('content_area')
    {{-- start create status --}}
    <div class="row">
        <div>
            <div class="d-flex gap-2">
                <a href="javascript:void(0)" class="btn btn-primary rounded-0 back_btn">Back</a>
            
                @if (!$post->checkenroll(Auth::user()->id))
                    {{-- start enroll --}}
                    <button type="button" id="enroll_btn"
                    data-bs-toggle="modal"
                    data-bs-target="#confirm_box"
                     class="btn btn-outline-primary rounded-0">Enroll</button>
                    
                    {{-- end enroll --}}
                @endif

                {{-- <form action="{{route('enrolls.store')}}" method="POST" id="enroll_form">
                    @csrf
                    @method("POST")
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                </form> --}}

                {{-- start model --}}
                <div id="confirm_box"  class="modal fade" >
                    <div class="modal-dialog modal-sm modal-dialog-center">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6>Confrim Submit</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('enrolls.store')}}" id="confirm_enroll" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method("POST")
                                    {{-- hidden Area --}}
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <input type="hidden" name="stage_id" value="2">
                                    {{-- end hidden area --}}
                                    <input type="hidden" name="" id="" class="user_email_box" value="{{Auth::user()->email}}">
                                    <div class="row">
                                       
                                        <div class="col-12 mb-3 form-group">
                                            <input type="text" name="name" id="" class="form-control rounded-0 outline-none shadow-none border" placeholder="" value="{{$post->name}}" readonly >
                                        </div>
                                        {{-- image upload --}}
                                        <div class="form-group mb-2">
                                            {{-- hidden area --}}
                                            <input type="file" name="image" id="coverphotos" class="form-control rounded-0 shadow-none outline-none "/>
                                            {{-- end hidden area --}}
                                            
                                        </div>
                                        
                                        <label for="coverphotos">
                                            <div class="gallery">
                                                <img src="" alt="">
                                                <span>Choose Images</span>
                                            </div>
                                        </label>
                                        {{-- end image upload --}}
                                        <div class="col-12 mb-3 form-group">
                                            <input type="email" class="form-control rounded-0 outline-none shadow-none border confirm_enroll_box" placeholder="Confirm Your Email" value="">
                                        </div>
                                        
                                        <div class="col-12 mb-3">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-primary rounded-0 outline-none shadow-none confirm_enroll">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end model --}}
            </div>

            <hr>
            <div class="mt-3 row">
                <div class="col-md-4 col-sm-12 mb-3">
                    <div class="text-center title">
                        <h5>{{$post->name}}</h5>
                        <small class="">{{$post->tag->name}}</small>
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="d-block text-start fw-bold" style="font-size: 13px">Attended Show</span>
                                <span class="d-block text-start" style="font-size: 13px">{{$post->attstatus->name}}</span>
                            </div>
                            
                            <div>
                                <span class="d-block text-end fw-bold" style="font-size: 13px">Status</span>
                                <span class="d-block text-end" style="font-size: 13px">{{$post->status->name}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 cover_photo">
                        <img src="{{asset($post->image)}}" width="100%" style="object-fit: cover" alt="{{$post->name}}">
                    </div>
                    <div >
                        <div>
                            <span class="fw-bold d-block text-center">Info</span>
                            <ul class="p-2 list-unstyled show_detail" style="font-size: 14px">
                                <li class=" d-flex justify-content-between">
                                    <span>Authorized By</span>
                                    <span>{{$post->user->name}}</span>
                                </li>
                                <li class=" d-flex justify-content-between">
                                    <span>Zoom Id</span>
                                    <span>{{$post->zoomid}}</span>
                                </li>
                                <li class=" d-flex justify-content-between">
                                    <span>Pass Code</span>
                                    <span>{{$post->passcode}}</span>
                                </li>
                                <li class="  d-flex justify-content-between">
                                    <span>Fee</span>
                                    <span>{{$post->fee}}</span>
                                </li>
                                <li class=" d-flex justify-content-between">
                                    <span>Title</span>
                                    <span>{{$post->tag->name}}</span>
                                </li>
                                <li class=" d-flex justify-content-between">
                                    <span>Type</span>
                                    <span>{{$post->type->name}}</span>
                                </li>
                                <li class=" d-flex justify-content-between">
                                    <span>Created At</span>
                                    <span><small>{{$post->created_at->format("d M Y | h:m:s a")}}</small></span>
                                </li>
                                <li class=" d-flex justify-content-between">
                                    <span>Updated_at</span>
                                    <span><small>{{$post->updated_at->format("d M Y | h:m:s a")}}</small></span>
                                </li>
                            </ul>
                        </div>
                       

                        <hr>
                        <div>
                            <span class="fw-bold d-block text-center">Date And Time</span>
                            <ul  class="p-2 list-unstyled show_detail" style="font-size: 14px">
                                <li class=" d-flex justify-content-between">
                                    <span>Start Date</span>
                                    <span>{{date("d M Y",strtotime($post->startdate))}}</span>
                                </li>
                                <li class="  d-flex justify-content-between">
                                    <span>End Date</span>
                                    <span>{{date("d M Y",strtotime($post->enddate))}}</span>
                                </li>
                                <li class=" d-flex justify-content-between">
                                    <span>Start Time</span>
                                    <span>{{date("h : m : s a",strtotime($post->startime))}}</span>
                                </li>
                                <li class="  d-flex justify-content-between">
                                    <span>End Time</span>
                                    <span>{{date("h : m : s a",strtotime($post->endtime))}}</span>
                                </li>
                            </ul>
                        </div>
                        

                        <hr>
                        <div>
                            <span class="fw-bold d-block text-center">Weekly</span>
                            <ul  class="p-2 list-unstyled show_detail" style="font-size: 14px">
                                @foreach ($post->days as $day)
                                    <li class="  d-flex justify-content-between">
                                        <span>{{$day->name}}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="d-flex">
                            <a href="{{route('posts.edit',$post->slug)}}"
                                wire:navigate 
                                class="w-100 btn btn-primary rounded-0 shadow-none outline-none">Edit</a>
                            <a href="javascript:void(0)"
                            data-bs-toggle="modal"
                            data-bs-target="#delete_model"
                            data-id={{$post->id}}  
                            data-email = {{Auth::user()->email}}
                            class="w-100 btn btn-outline-primary rounded-0 shadow-none outline-none delete_btn">Delete</a>
                        </div>
                        <form id="formdelete{{$post->id}}" action="{{route('posts.destroy',$post->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="dayable_type" value="App\Models\Post">
                        </form>

                    </div>
                </div>

                <div class="col-md-8 col-sm-12">
                    <div class="mb-5">
                        <h6 class="text-center">Message</h6>
                        <p class="" style="font-size: 14px;text-indent:80px;">
                            {{$post->content}}
                        </p>
                    </div>
                    <span class="" style="font-size: 15px">Enroll Total - {{count($enrolls)}} </span>
                    <div class="post_enroll_list_container">
                        <ul class="list-unstyled">
                            @foreach ($enrolls as $enroll)
                                <li class="d-flex justify-content-between">
                                    <span>
                                        <a href="{{route('users.show',$enroll->user->id)}}"
                                            wire:navigate>
                                            <small>{{$enroll->user->name}}</small>
                                        </a>
                                    </span> 

                                    <small>{{$enroll->stage->name}}</small>
                                    
                                    <span>{{$enroll->updated_at->diffForHumans()}}</span>
                                </li>
                            @endforeach
                           
                        </ul>
                    </div>
                    <div class="comment_box">
                        @livewire('post.comment',["post_id"=>$post->id])
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
                                <input type="text" name="name" id="" class="form-control rounded-0 outline-none shadow-none border" placeholder="Enter Status" value="{{$post->user->name}}" readonly >
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

        $(".confirm_enroll").click(function(){
            let getUserEmail = $(".user_email_box").val();
            let getEmail = $(".confirm_enroll_box").val();

            // console.log(getUserEmail,getEmail);
            if(getUserEmail === getEmail){
                $(`#confirm_enroll`).submit();
            }else{
                window.alert("Permission Denied");
                $(".confirm_enroll_box").focus();
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
