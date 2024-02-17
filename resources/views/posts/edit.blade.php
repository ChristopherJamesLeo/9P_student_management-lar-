@extends('layouts.index')

@section("style")
<style>
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
            <a href="{{route('posts.index')}}" wire:navigate class="btn btn-primary rounded-0">Back</a>
            <hr>
            <div class="mt-3 row">
                <form id="update_form" action="{{route('posts.update',$post->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class=" col-md-4 col-sm-12 mb-2">
                            <div class="form-group mb-2">
                                {{-- hidden area --}}
                                <input type="hidden" name="dayable_type" value="App\Models\Post">
                                <input type="file" name="image" id="coverphotos" class="form-control rounded-0 shadow-none outline-none "/>
                                {{-- end hidden area --}}
                                
                            </div>
                            <label for="coverphotos">
                                <div class="gallery">
                                    <img src="{{asset($post->image)}}" class="d-inline-block" alt="">
                                    <span></span>
                                </div>
                            </label>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label for="passcode">Passcode</label>
                                        <input type="text" name="passcode" id="starttime" class="form-control rounded-0 shadow-none outline-none 
                                        @error('passcode') is-invalid @enderror" value="{{old('passcode',$post->passcode)}}" placeholder="Enter Zoom Passcode"  >
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="form-group">
                                        <label for="starttime">Start Time</label>
                                        <input type="time" name="starttime" id="starttime" class="form-control rounded-0 shadow-none outline-none 
                                        @error('starttime') is-invalid @enderror" value="{{$post->starttime}}" >
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="form-group">
                                        <label for="endtime">End Time</label>
                                        <input type="time" name="endtime" id="endtime" class="form-control rounded-0 shadow-none outline-none 
                                        @error('endtime') is-invalid @enderror" value="{{old("endtime",$post->endtime)}}">
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="form-group">
                                        <label for="startdate">Start Date</label>
                                        <input type="date" name="startdate" id="startdate" 
                                        value="{{old('startdate',$post->startdate)}}"
                                        class="form-control rounded-0 shadow-none outline-none 
                                        @error('startdate') is-invalid @enderror"  >
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="form-group">
                                        <label for="enddate">End Date</label>
                                        
                                        <input type="date" name="enddate" id="enddate" 
                                        value="{{old('enddate',$post->enddate)}}"
                                        class="form-control rounded-0 shadow-none outline-none 
                                        @error('enddate') is-invalid @enderror" >
                                    </div>
                                </div>
                                <div class=" mt-3">
                                    <div class="d-flex flex-wrap">
                                        @foreach ($days as $day)
                                            <label for="day_id{{$day->name}}" class="text-capitalize">{{$day->name}}</label>
                                            <div class="form-checkbox form-switch mx-1">
                                                <input type="checkbox" name="days[]" id="day_id{{$day->name}}"
                                                value="{{$day->id}}"
                                                @foreach ($dayables as $dayable)
                                                    
                                                    @if ($dayable["id"] === $day["id"])
                                                        checked
                                                    @endif
                                                @endforeach

                                                 class="form-check-input shadow-none outline-none " >
                                            </div>
                                        @endforeach
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class=" col-md-8 col-sm-12">
                            <div class="row">
                                <div class="col-12 mb-2 form-group">
                                    <label for="name">Title</label>
                                    <input type="text" name="name" id="name" class="form-control rounded-0 shadow-none outline-none @error('name') is-invalid @enderror " value="{{old("name",$post["name"])}}" placeholder="Title">
                                </div>
                                <div class="col-6 mb-2 form-group">
                                    <label for="fee">Fee</label>
                                    <input type="text" name="fee" id="fee" class="form-control rounded-0 shadow-none outline-none " value="{{old("fee",$post->fee)}}" placeholder="Fee">
                                </div>
                               
                                <div class="col-6 mb-2 form-group">
                                    <label for="tag_id">Tag</label> @error('tag_id') <span class="text-danger">*</span> @enderror
                                    <select name="tag_id" id="tag_id" class="form-select rounded-0 shadow-none outline-none">
                                        <option value="" selected disabled>Choose Tag</option>
                                        @foreach ($tags as $id => $name)
                                            <option value="{{$id}}" {{$id == $post->tag_id ? "selected" : ""}}>{{$name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="col-12 col-md-4 mb-2 form-group">
                                    <label for="type_id">Type</label>
                                    @error('type_id') <span class="text-danger">*</span> @enderror
                                    <select name="type_id" id="type_id" class="form-select rounded-0 shadow-none outline-none @error('type_id') is-invalid @enderror">
                                        <option value="" selected disabled>Choose Type</option>
                                        @foreach ($types as $id => $name)
                                            <option value="{{$id}}" {{$id == $post->type_id ? "selected" : ""}}>{{$name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="col-12 col-md-4 mb-2 form-group">
                                    <label for="attshow">Attended Show</label>
                                    @error('attshow') <span class="text-danger">*</span> @enderror
                                    <select name="attshow" id="attshow" class="form-select rounded-0 shadow-none outline-none">
                                        <option value="" selected disabled>Choose Attshow</option>
                                        @foreach ($atts as $id => $name)
                                            <option value="{{$id}}" {{$id == $post->attshow ? "selected" : ""}}>{{$name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="col-12 col-md-4 mb-2 form-group">
                                    <label for="status_id">Status</label>
                                    @error('status_id') <span class="text-danger">*</span> @enderror
                                    <select name="status_id" id="status_id" class="form-select rounded-0 shadow-none outline-none">
                                        <option value="" selected disabled>Choose Status</option>
                                        @foreach ($statuses as $id => $name)
                                            <option value="{{$id}}"  {{$id == $post->status_id ? "selected" : ""}}>{{$name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="col-12 mb-2 form-group">
                                    <label for="content">Content</label>
                                    <textarea name="content" id="content" 
                                    style="font-size: 14px;"
                                    rows="7" class="form-control rounded-0 outline-none shadow-none" >{{old('content',$post->content)}}</textarea>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" id="update_submit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#update_form_model" 
                                    data-email = {{Auth::user()->email}}
                                    class="btn btn-primary rounded-0">Submit</button>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                   
                    
                </form>
                
            </div>
        </div>
        

    </div> 
    {{-- end create status --}}

    {{-- start confirm box --}}
    <div id="update_form_model" class="modal fade">
        <div class="modal-dialog modal-sm modal-dialog-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>Confirm Edit</h6>
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
                                    <button type="button" class="btn btn-primary rounded-0 outline-none shadow-none confirm_email"
                                    data-email = {{Auth::user()->email}}
                                    >Submit</button>
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


        $(".confirm_email").click(function(){
            let getUserEmail = $("#update_submit").data("email");
            let getEmail = $(".confirm_email_box").val();

            if(getUserEmail === getEmail){
                $(`#update_form`).submit();
            }else{
                window.alert("Permission Denied");
            }
            
        })

    })
</script>
@endsection
