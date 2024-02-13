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
        max-height: 500px;
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
            <a href="{{route('posts.index')}}" wire:navigate class="btn btn-primary rounded-0">Back</a>
            <hr>
            <div class="mt-3 row">
                <div class="col-md-4 col-sm-12 mb-3">
                    <div class="text-center title">
                        <h5>{{$post->name}}</h5>
                        <small class="">{{$post->tag->name}}</small>
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="d-block text-start" style="font-size: 13px">Attended Show</span>
                                <span class="d-block text-start" style="font-size: 13px">{{$post->attstatus->name}}</span>
                            </div>
                            <div>
                                <span class="d-block text-end" style="font-size: 13px">Status</span>
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
                            <a href="{{route('posts.edit',$post->id)}}"
                                wire:navigate 
                                class="w-100 btn btn-primary rounded-0 shadow-none outline-none">Edit</a>
                            <a href="javascript:void(0)"
                            data-bs-toggle="modal"
                            data-bs-target="#delete_model"
                            data-id={{$post->id}}  
                            data-email = {{$post->user->email}}
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
                    <div class="comment_box">
                        <ul class="list-unstyled">
                            <li class="">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Minima voluptatem nihil excepturi illo fuga minus, consequatur laborum dolorum quia doloremque culpa, aspernatur debitis omnis nobis et molestias ut, non odio!
                                </p>
                                <div class="d-flex justify-content-end">
                                    <small class="fw-bold">Username | <small class="fw-normal">12 minutes ago</small></small> 
                                   
                                </div>
                            </li>
                            <li>
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" name="name" id="name" class="form-control rounded-0 outline-none shadow-none " autocomplete="off"
                                            placeholder="Comment here...">
                                            <button class="btn btn-info text-white"><i class="fas fa-paper-plane"></i></button>
                                        </div>
                                       
                                    </div>
                                </form>
                            </li>
                        </ul>
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
