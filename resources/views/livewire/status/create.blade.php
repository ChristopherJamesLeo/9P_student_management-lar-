<div>
    <form action="" method="POST" wire:submit="save">
        <div class="mb-2 form-group">
            @error('name')
                <span class="text-danger">Require Field</span>
            @enderror
            <input type="text" name="name" wire:model="name" id="name" class="form-control rounded-0 border outline-none shadow-none" placeholder="Status" value="{{old('name')}}">
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary rounded-0">Submit</button>
        </div>

    </form>

    <div class="row">
        <table class="table ">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>By</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($statuses as $idx => $status)
                    <tr>
                        {{-- <td>{{$idx + $statuses -> firstItem()}}</td> --}}
                        <td>{{++$idx}}</td>
                        <td>{{$status->name}}</td>
                        <td>{{$status->user["name"]}}</td>
                        <td>{{$status->created_at -> format("d:m:y")}}</td>
                        <td>{{$status->updated_at -> format("d:m:y")}}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="javascript:void(0)"
                                data-id = {{$status->id}}
                                data-name = {{$status->name}}
                                data-bs-toggle = "modal"
                                data-bs-target = "#editmodal"
                                 class="btn btn-outline-primary btn-sm edit_form_btn"><i class="fas fa-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm delete_btn" data-id={{$status->id}}><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                        <form id="formdelete{{$status->id}}" action="{{route('statuses.destroy',$status->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{-- {{ $statuses->links("pagination::bootstrap-4") }} --}}

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

@section("script")
    <script>
        $(document).ready(function(){
            // start edit form
            $(".edit_form_btn").click(function(){
                let getId = $(this).data("id");
                let getName = $(this).data("name");

                $("#editname").val(getName);

                $("#editform").attr("action",`/statuses/${getId}`)

                console.log(getId,getName)
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
