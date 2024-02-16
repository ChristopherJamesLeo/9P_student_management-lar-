@extends('layouts.index')

@section('content_area')
    {{-- start create status --}}
    <div class="row">
        <div>
            <form action="{{route('attendances.store')}}" method="POST">
                @csrf
                @method("POST")
                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-2 form-group">
                        <input type="text" name="name" id="name" class="form-control rounded-0 border outline-none shadow-none" placeholder="Att Code" value="{{old('name')}}">
                    </div>
                    <div class="col-md-4 col-sm-12 mb-2 form-group">
                        <input type="date" name="classdate" id="classdate" class="form-control rounded-0 border outline-none shadow-none" placeholder="Att Code" value="{{old('classdate')}}">
                    </div>
                    <div class="col-md-4 col-sm-12 mb-2 form-group">
                        <select name="post_id" id="post_id" class="form-select rounded-0 outline-none shadow-none">
                            <option value="" selected disabled>Select Class</option>
                            @foreach ($posts as $idx => $post)
                                <option value="{{$idx}}">{{$post}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="d-flex gap-2 justify-content-end">
                    <button type="reset" class="btn btn-secondary rounded-0">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-0">Submit</button>
                </div>
        
            </form>
        
            <div class="row">
                <div class="table_container">
                    <div class="table_main_container">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Att Code</th>
                                    <th>Name</th>
                                    <th>Classdate</th>
                                    <th>Post</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $idx => $attendance)
                                    <tr>
                                        {{-- <td>{{$idx + $statuses -> firstItem()}}</td> --}}
                                        <td>{{$idx + $attendances -> firstItem()}}</td>
                                        <td>{{$attendance->name}}</td>

                                        <td>{{$attendance->user["name"]}}</td>
                                        <td>{{date('d M y',strToTime($attendance->classdate))}}</td>
                                        <td>{{$attendance->post["name"]}}</td>

                                        <td>{{$attendance->created_at -> format("d M y")}}</td>
                                        <td>{{$attendance->updated_at -> format("d M y")}}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="javascript:void(0)"
                                                data-id = "{{$attendance->id}}"
                                                data-name = "{{$attendance->name}}"
                                                data-post-id = "{{$attendance->post_id}}"
                                                data-bs-toggle = "modal"
                                                data-bs-target = "#editmodal"
                                                 class="btn btn-outline-primary btn-sm edit_form_btn"><i class="fas fa-edit"></i></a>
                                                <a href="javascript:void(0)" 
                                                data-id={{$attendance->id}} 
                                                class="btn btn-danger btn-sm delete_btn" ><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                        <form id="formdelete{{$attendance->id}}" action="{{route('attendances.destroy',$attendance->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                    </tr>
                                @endforeach
                
                            </tbody>
                        </table>
                        {{ $attendances->links("pagination::bootstrap-4") }}
                    </div>
                </div>

        
                <div id="editmodal" class="modal fade">
                    <div class="modal-dialog modal-sm modal-dialog-center">
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
                                        <div class="col-12 mb-3 form-group">
                                            <input type="text" name="name" id="editname" class="form-control rounded-0 outline-none shadow-none border" placeholder="Enter Status" value="{{old('name')}}" readonly>
                                        </div>
                                        
                                        <div class="col-12 mb-3 form-group">
                                            <select name="post_id" id="editpost_id" class="form-select rounded-0 outline-none shadow-none">
                                                @foreach ($posts as $idx => $post)
                                                    <option value="{{$idx}}">{{$post}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary rounded-0 outline-none shadow-none">Submit</button>
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
            let getName = $(this).data("name");
            let getPostId = $(this).data("post-id")
            console.log(getPostId);

            $("#editname").val(getName);

            $("#editpost_id").val($(this).data("post-id"));


            $("#editform").attr("action",`/attendances/${getId}`)

            // console.log(getId,getName)
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

    })
</script>
@endsection
