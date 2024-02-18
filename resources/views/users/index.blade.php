@extends('layouts.index')

@section('content_area')
    {{-- start create status --}}
    <div class="row">
        <div>
            {{-- <a href="{{route('users.create')}}" wire:navigate class="btn btn-primary rounded-0">Create</a> --}}
            <hr>
            <div class="mt-3 row">
                {{-- <div class="table_container" style="overflow-x: scroll;"> --}}
                    <div class="table_container" style="overflow-x: scroll;">
                    {{-- <div class="table_main_container" > --}}
                        <div class="table_main_container" style="width: 2000px">
                        <table class="table w-100" >
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Reg No.</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Role</th>
                                    <th>City</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $idx => $user)
                                    <tr>
                                        <td>{{$idx + $users -> firstItem()}}</td>
                                        <td>
                                            <a href="{{route('users.show',$user->slug)}}" 
                                                wire:navigate
                                                class="">{{$user->name}}</a>
                                        </td>
                                        <td>
                                            {{$user->registration->reg_no}}
                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->gender->name}}</td>
                                        <td>{{$user->role->name}}</td>
                                        <td>{{$user->city->name}}</td>
                                        <td>{{$user->country->name}}</td>
                                        <td>{{$user->status->name}}</td>
                                        <td>{{$user->created_at -> format("d M y")}}</td>
                                        <td>{{$user->updated_at -> format("d M y")}}</td>
                                        <td>
                                            <div class="d-flex gap-2">

                                                <a href="{{route('users.edit',$user->id)}}"
                                                wire:navigate 
                                                 class="btn btn-outline-primary btn-sm edit_form_btn"><i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links("pagination::bootstrap-4") }}
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

        // start delete btn
        // $(".delete_btn").click(function(){
        //     let getId = $(this).data("id");
        //     if(window.confirm("Are You Sure To Delete!!!")){
        //         $(`#formdelete${getId}`).submit();
        //     }
            
        // })
        // end delete btn

        // $(".change-btn").click(function(){
        //     var getId = $(this).data("id");
        //     let setstatus = $(this).prop("checked") === true ? 3 : 4 ;

        //     // console.log(status_id);

        //     $.ajax({
        //         url : "userstatus",
        //         type : "GET",
        //         dataType : "json",
        //         data : {
        //             "id" : getId,
        //             "status_id" : setstatus
        //         },
        //         success : function(response){
        //             console.log(response.success);
        //         }
        //     });

        // })
    })
</script>
@endsection
