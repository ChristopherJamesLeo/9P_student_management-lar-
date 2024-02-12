@extends('layouts.index')

@section('content_area')
    {{-- start create status --}}
    <div class="row">
        <div>
            <form action="{{route('genders.store')}}" method="POST">
                @csrf
                @method("POST")
                <div class="mb-2 form-group">
                    <input type="text" name="name" id="name" class="form-control rounded-0 border outline-none shadow-none" placeholder="Gender" value="{{old('name')}}">
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
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>By</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($genders as $idx => $gender)
                                    <tr>
                                        {{-- <td>{{$idx + $statuses -> firstItem()}}</td> --}}
                                        <td>{{$idx + $genders -> firstItem()}}</td>
                                        <td>{{$gender->name}}</td>
                                        <td>
                                            <div class="form-checkbox form-switch">
                                                <input type="checkbox" name="" id="" 
                                                {{$gender->status_id == 3 ? "checked" : " "}} 
                                                data-id = {{$gender->id}} 
                                                class="form-check-input shadow-none outline-none change-btn" >
                                            </div>
                                        </td>
                                        <td>{{$gender->user["name"]}}</td>
                                        <td>{{$gender->created_at -> format("d M y")}}</td>
                                        <td>{{$gender->updated_at -> format("d M y")}}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="javascript:void(0)"
                                                data-id = {{$gender->id}}
                                                data-name = {{$gender->name}}
                                                data-status-id = {{$gender->status_id}}
                                                data-bs-toggle = "modal"
                                                data-bs-target = "#editmodal"
                                                 class="btn btn-outline-primary btn-sm edit_form_btn"><i class="fas fa-edit"></i></a>
                                                <a href="javascript:void(0)" 
                                                data-id={{$gender->id}} 
                                                class="btn btn-danger btn-sm delete_btn" ><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                        <form id="formdelete{{$gender->id}}" action="{{route('genders.destroy',$gender->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                    </tr>
                                @endforeach
                
                            </tbody>
                        </table>
                        {{ $genders->links("pagination::bootstrap-4") }}
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
                                            <input type="text" name="name" id="editname" class="form-control rounded-0 outline-none shadow-none border" placeholder="Enter Status" value="{{old('name')}}">
                                        </div>
                                        <div class="col-12 mb-3 form-group">
                                            <select name="status_id" id="status_id" class="form-select rounded-0 outline-none shadow-none">
                                                @foreach ($statuses as $idx => $status)
                                                    <option value="{{$idx}}">{{$status}}</option>
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
            let getStatusId = $(this).data("status-id");

            // console.log(getStatusId);

            $("#editname").val(getName);

            $("#status_id").val($(this).data("status-id"));

            $("#editform").attr("action",`/genders/${getId}`)

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

        $(".change-btn").click(function(){
            var getId = $(this).data("id");
            let setstatus = $(this).prop("checked") === true ? 3 : 4 ;

            // console.log(status_id);

            $.ajax({
                url : "genderstatus",
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
