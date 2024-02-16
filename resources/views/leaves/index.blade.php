@extends('layouts.index')
@section("style")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content_area')
    {{-- start create status --}}
    <div class="row">
        <div>
            <div class="row">
                <div class="table_container">
                    <div class="table_main_container">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Post Name</th>
                                    <th>Stage</th>
                                    <th>By</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaves as $idx => $leave)
                                {{-- {{$leave->post->name}} --}}
                                    <tr>
                                        <td>{{$idx + $leaves -> firstItem()}}</td>
                                        <td class="invoice_img">
                                            <a href="{{asset($leave->image)}}" 
                                                data-source="{{$leave->image}}"
                                                title = "{{$leave->user->name}}"
                                                class="">
                                                <img src="{{asset($leave->image)}}" width="70px" height="70px" style="object-fit: cover" alt="">
                                            </a>
                                            
                                        </td>
                                        <td>
                                            <a href="{{route('users.show',$leave->user->id)}}"
                                                wire:navigate>
                                                {{$leave->user->name}}
                                            </a>
                                        </td>
                                        <td>
                                            {{date("d M Y",strToTime($leave->startdate))}}
                                        </td>
                                        <td>
                                            {{date("d M Y",strToTime($leave->enddate))}}
                                        </td>
                                        <td>
                                            <a href="{{route('posts.show',$leave->post->id)}}"
                                                wire:navigate>
                                                {{$leave->post->name}}
                                            </a>
                                        </td>
                                        <td>{{$leave->stage->name}}</td>
                                        <td>{{$leave->admin->name}}</td>
                                        
                                        <td>{{$leave->created_at -> format("d M y")}}</td>
                                        <td>{{$leave->updated_at -> format("d M y")}}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="javascript:void(0)"
                                                data-id = "{{$leave->id}}"
                                                data-image = "{{$leave->image}}"
                                                data-post = "{{$leave->post->name}}"
                                                data-user = "{{$leave->user->name}}"
                                                data-message = "{{$leave->message}}"
                                                data-stage-id = "{{$leave->stage->id}}"
                                                data-bs-toggle = "modal"
                                                data-bs-target = "#editmodal"
                                                class="btn btn-outline-primary btn-sm edit_form_btn"><i class="fas fa-edit"></i></a>

                                                <a href="javascript:void(0)" 
                                                data-id={{$leave->id}} 
                                                class="btn btn-danger btn-sm delete_btn" ><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                        <form id="formdelete{{$leave->id}}" action="{{route('leaves.destroy',$leave->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                    </tr>
                                @endforeach
                
                            </tbody>
                        </table>
                        {{ $leaves->links("pagination::bootstrap-4") }}
                    </div>
                </div>

        
                <div id="editmodal" class="modal fade">
                    <div class="modal-dialog modal-lg modal-dialog-center">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6>Edit Form</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="editform" method="POST">
                                    @csrf 
                                    @method("PUT")
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="p-2 border show_leave_img_container">
                                                <a href="" title="" data-source="">
                                                    <img src="" class="" width="100%" height="auto" style="object-fit: cover"  alt="show invoice">
                                                </a>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="row">
                                                <div class="col-12 mb-3 form-group">
                                                    <input type="text" name="postname" id="postname" class="form-control rounded-0 outline-none shadow-none border" readonly>
                                                </div>
                                                <div class="col-12 mb-3 form-group">
                                                    <input type="text" name="username" id="username" class="form-control rounded-0 outline-none shadow-none border" readonly>
                                                </div>
                                                <div class="col-12 mb-3 form-group">
                                                    <textarea name="message" id="editmessage" class="form-control rounded-0 outline-none shadow-none border" readonly></textarea>
                                                </div>
                                                <div class="col-12 mb-3 form-group">
                                                    <select name="stage_id" id="stage_id" class="form-select rounded-0 outline-none shadow-none">
                                                        @foreach ($stages as $idx => $stage)
                                                            <option value="{{$idx}}">{{$stage}}</option>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
        // start edit form
        $(".edit_form_btn").click(function(){

            let getId = $(this).data("id");

            let getPost = $(this).attr("data-post");

            let getName = $(this).data("user");

            let getImage = $(this).data("image");

            let getStatusId = $(this).data("stage-id");

            let getMessage = $(this).data("message");

            // console.log(getPost);

            $("#postname").val(getPost);

            $("#username").val(getName);
            
            $("#stage_id").val(getStatusId);

            $("#editmessage").val(getMessage);

            $(".show_leave_img_container a").attr("href",getImage);
            $(".show_leave_img_container a").attr("title",getPost);
            $(".show_leave_img_container a").attr("data-source",getImage);

            $(".show_leave_img_container a img").attr("src",getImage);


            $("#editform").attr("action",`/leaves/${getId}`)
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


        

        // start magnific pop up
        $('.invoice_img,.show_leave_img_container').magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true,
                titleSrc: function(item) {
                    return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
                }
            },
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 300, 
                opener: function(element) {
                    return element.find('img');
                }
            }
            
        });
        // end magnific pop up
    })
</script>
@endsection
