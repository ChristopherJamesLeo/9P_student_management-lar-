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
            <a href="javascript:void(0)" 
            data-bs-target="#create_announcement_modal"
            data-bs-toggle="modal"
            class="btn btn-primary rounded-0">Create</a>
            {{-- start create model --}}
            <div id="create_announcement_modal" class="modal fade">
                <div class="modal-dialog modal-lg modal-dialog-center">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6>Create Announcement Form</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('announcements.store')}}" method="POST" enctype="multipart/form-data" >
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
                                                <span class="">Choose Images</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="row">
                                            <div class="col-12 form-group mb-2">
                                                <input type="text" name="title" id="title" class="form-control rounded-0 outline-none shadow-none" value="{{old('title')}}" placeholder="Enter Title">
                                            </div>
                                            <div class="col-12 form-group mb-2">
                                                <textarea name="message" id="message" 
                                                class="form-control rounded-0 shadow-none outline-none"
                                                cols="" 
                                                rows="7" 
                                                placeholder="Enter Message">{{old('message')}}</textarea>
                                            </div>
                                            <div class="col-12 form-group mb-2">
                                                <select name="post_id" id="post_id" class="form-control rounded-0 shadow-none outline-none">
                                                    <option value="" selected disabled>Choose Post</option>
                                                    @foreach ($posts as $post)
                                                        <option value="{{$post->id}}">{{$post->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 form-group mb-2">
                                                <select name="role_id" id="role_id" class="form-control rounded-0 shadow-none outline-none">
                                                    <option value="" selected disabled>Choose Role</option>
                                                    @foreach ($roles as $id => $name)
                                                        <option value="{{$id}}">{{$name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" id="leave_submit_btn" class="btn btn-primary rounded-0 outline-none shadow-none">Submit</button>
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


            <div class="mt-2 row">
                <div class="table_container" style="overflow-x: scroll;">
                    <div class="table_main_container" style="width: 1500px">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>title</th>
                                    <th>Message</th>
                                    <th>Post Name</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>By</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($announcements as $idx => $announcement)
                                    <tr>
                                        <td>{{$idx + $announcements -> firstItem()}}</td>
                                        <td class="invoice_img">
                                            @if ($announcement->image != null)
                                                <a href="{{asset($announcement->image)}}" 
                                                    data-source="{{$announcement->image}}"
                                                    title = "{{$announcement->user->name}}"
                                                    class="">
                                                    <img src="{{asset($announcement->image)}}" width="70px" height="70px" style="object-fit: cover" alt="">
                                                </a>
                                            @endif
                                            
                                        </td>
                                        <td>
                                            <a>
                                                {{$announcement->title}}
                                            </a>
                                        </td>
                                        <td>
                                            <span title="{{$announcement->message}}">{{Str::limit($announcement->message,30)}}</span>
                                        </td>
                                        <td>
                                            <a href="{{route('posts.show',$announcement->post->slug)}}"
                                                wire:navigate>
                                                {{$announcement->post->name}}
                                            </a>
                                        </td>
                                        <td>{{$announcement->role->name}}</td>
                                        <td>{{$announcement->status->name}}</td>
                                        <td>{{$announcement->user->name}}</td>
                                        
                                        <td>{{$announcement->created_at -> format("d M y")}}</td>
                                        <td>{{$announcement->updated_at -> format("d M y")}}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="javascript:void(0)"
                                                data-id = "{{$announcement->id}}"
                                                data-image = "{{$announcement->image}}"
                                                data-title = "{{$announcement->title}}"
                                                data-post = "{{$announcement->post->id}}"
                                                data-user = "{{$announcement->user->name}}"
                                                data-message = "{{$announcement->message}}"
                                                data-role = "{{$announcement->role->id}}"
                                                data-status = "{{$announcement->status->id}}"
                                                data-bs-toggle = "modal"
                                                data-bs-target = "#editmodal"
                                                class="btn btn-outline-primary btn-sm edit_form_btn"><i class="fas fa-edit"></i></a>

                                                <a href="javascript:void(0)" 
                                                data-id={{$announcement->id}} 
                                                class="btn btn-danger btn-sm delete_btn" ><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                        <form id="formdelete{{$announcement->id}}" action="{{route('announcements.destroy',$announcement->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                    </tr>
                                @endforeach
                
                            </tbody>
                        </table>
                        {{ $announcements->links("pagination::bootstrap-4") }}
                    </div>
                </div>

        
                <div id="editmodal" class="modal fade">
                    <div class="modal-dialog modal-lg modal-dialog-center">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6>Edit Announcement</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="editform" method="POST" enctype="multipart/form-data">
                                    @csrf 
                                    @method("PUT")
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="p-2 border show_leave_img_container">
                                                <a href="" title="" data-source="">
                                                    <img src="" id="show_edit_img" class="" width="100%" height="auto" style="object-fit: cover"  alt="show invoice">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group mb-2">
                                                        <input type="file" name="image" id="edit_coverphotos" class="form-control rounded-0 shadow-none outline-none "/>
                                                    </div>
                                                    <label for="edit_coverphotos">
                                                        <div class="gallery edit_gallery">
                                                            <img src="" alt="">
                                                            <span class="d-block">Choose Images</span>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="col-12 form-group mb-2">
                                                    <input type="text" name="title" id="edit_title" class="form-control rounded-0 outline-none shadow-none" value="{{old('title')}}" placeholder="Enter Title">
                                                </div>
                                                <div class="col-12 form-group mb-2">
                                                    <textarea name="message" id="edit_message" 
                                                    class="form-control rounded-0 shadow-none outline-none"
                                                    cols="" 
                                                    rows="7" 
                                                    placeholder="Enter Message">{{old('message')}}</textarea>
                                                </div>
                                                <div class="col-12 form-group mb-2">
                                                    <select name="post_id" id="edit_post_id" class="form-control rounded-0 shadow-none outline-none">
                                                        <option value="" selected disabled>Choose Post</option>
                                                        @foreach ($posts as $post)
                                                            <option value="{{$post->id}}">{{$post->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 form-group mb-2">
                                                    <select name="role_id" id="edit_role_id" class="form-control rounded-0 shadow-none outline-none">
                                                        <option value="" selected disabled>Choose Role</option>
                                                        @foreach ($roles as $id => $name)
                                                            <option value="{{$id}}">{{$name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 form-group mb-2">
                                                    <select name="status_id" id="edit_status_id" class="form-control rounded-0 shadow-none outline-none">
                                                        <option value="" selected disabled>Choose Status</option>
                                                        @foreach ($statuses as $id => $name)
                                                            <option value="{{$id}}">{{$name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-primary rounded-0 outline-none shadow-none">Submit</button>
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
            </div>
        </div>
        

    </div> 
    {{-- end create status --}}
@endsection

@section("script")

<script>
    $(document).ready(function(){
        // start edit form
        $(".edit_form_btn").click(function(){
            let getId = $(this).data("id");
            let getTitle = $(this).data("title")
            let getImage = $(this).data("image");
            let getPost = $(this).data("post");
            let getMessage = $(this).data("message");
            let getRole = $(this).data("role");
            let getStatus = $(this).data("status");

            $("#show_edit_img").attr("src",`${getImage}`);

            $("#edit_title").val(`${getTitle}`);
            $("#edit_post_id").val(`${getPost}`);
            $("#edit_message").val(`${getMessage}`);
            $("#edit_role_id").val(`${getRole}`);
            $("#edit_status_id").val(`${getStatus}`);

            $("#editform").attr("action",`/announcements/${getId}`)
        })
        // end edit form

        // start delete btn
        $(".delete_btn").click(function(){
            let getId = $(this).data("id");
            if(window.confirm("Are You Sure To Delete!!!")){
                $(`#formdelete${getId}`).submit();
            }
            
        })
        // end delete btn

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


        let geteditprofile = document.querySelector("#edit_coverphotos");
        let editgetshowimg = document.querySelector(".edit_gallery img");
        let editgetimgtitle = document.querySelector(".edit_gallery span");
        geteditprofile.addEventListener("change",function(){
            var reader = new FileReader();
            reader.onload = function(e){
                editgetshowimg.style.display="block";
                editgetimgtitle.style.display = "none";
                editgetshowimg.setAttribute("src",e.target.result); 
            }
            reader.readAsDataURL(this.files[0]);
        })
    })
</script>
@endsection
