@extends('layouts.index')

@section('content_area')
    {{-- start create status --}}
    <div class="row">
        <div>
            @if (Auth::user()->id == 1 || Auth::user()->id == 2)
                <a href="{{route('posts.create')}}" wire:navigate class="btn btn-primary rounded-0">Create</a>
                <hr>
            @endif
           
            {{-- start search box --}}
            <div class="search_form_container">
                <form action="" method="">
                    <div class="row justify-content-end">
                        <div class="col-lg-4 col-md-6 mb-2">
                            <select name="filter" id="filter" class="form-control rounded-0 outline-none shadow-none" value="{{request('filter')}}">
                                <option value="" selected disabled>Search Post</option>
                                @foreach ($filterRoles as $filterRole)
                                    <option value="{{$filterRole->slug}}" {{$filterRole->slug == request("filter") ? "selected" : ""}}>{{$filterRole->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-2">
                            <div class="input-group">
                                <input type="text" name="searchonly" id="search_box" class="form-control rounded-0 outline-none shadow-none border" placeholder="Search Box...." value="{{request('searchonly')}}">
                                <button type="submit" class="btn btn-primary rounded-0 outline-none shadow-none"><i class="fas fa-search"></i></button>
                                <button type="button" id="restart_search_btn" class="btn btn-secondary"><i class="fas fa-sync"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- end search box --}}
            <div class="mt-3 row">
                <div class="table_container" style="overflow-x: scroll;">
                    <div class="table_main_container" style="width: 2000px">
                        <table class="table w-100" >
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Fee</th>
                                    <th>Tag Name</th>
                                    <th>Type</th>
                                    <th>Att Show</th>
                                    <th>Status</th>
                                    <th>By</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    @if (Auth::user()->id == 1 || Auth::user()->id == 2)
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $idx => $post)
                                    <tr>
                                        <td>{{$idx + $posts -> firstItem()}}</td>
                                        <td>
                                            <a href="{{route('posts.show',$post->slug)}}" wire:navigate>
                                                <div>
                                                    <img src="{{asset($post->image)}}" width="70px" height="70px" style="object-fit: cover" alt="">
                                                </div>
                                            </a>
                                            
                                        </td>
                                        <td>
                                            <a href="{{route('posts.show',$post->slug)}}" 
                                                wire:navigate
                                                class="nav-link">{{$post->name}}</a>
                                        </td>
                                        <td>{{$post->startdate}}</td>
                                        <td>{{$post->enddate}}</td>
                                        <td>{{$post->starttime}}</td>
                                        <td>{{$post->endtime}}</td>
                                        <td>{{$post->fee}}</td>
                                        <td>
                                            <span title="{{$post->tag->name}}">{{Str::limit($post->tag->name,20)}}</span>
                                        </td>
                                        <td>{{$post->type->name}}</td>
                                        <td>{{$post->attstatus->name}}</td>
                                        <td>{{$post->status->name}}</td>
                                        <td>{{$post->user->name}}</td>
                                        <td>{{$post->created_at -> format("d M y")}}</td>
                                        <td>{{$post->updated_at -> format("d M y")}}</td>
                                        @if (Auth::user()->id == 1 || Auth::user()->id == 2)

                                        <td>
                                            <div class="d-flex gap-2">

                                                <a href="{{route('posts.edit',$post->slug)}}"
                                                wire:navigate 
                                                 class="btn btn-outline-primary btn-sm edit_form_btn"><i class="fas fa-edit"></i>
                                                </a>

                                                {{-- <a href="javascript:void(0)" 
                                                data-id={{$post->id}} 
                                                class="btn btn-danger btn-sm delete_btn" ><i class="fas fa-trash"></i></a> --}}
                                            </div>
                                        </td>
                                        @endif

                                        {{-- <form id="formdelete{{$post->id}}" action="{{route('posts.destroy',$post->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form> --}}
                                    </tr>
                                @endforeach
                
                            </tbody>
                        </table>
                        {{ $posts->links("pagination::bootstrap-4") }}
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

        // start filter 
        document.querySelector("#filter").addEventListener("change",function(){
            // console.log(this.value);
            let getFilterSelectValue = this.value;

            window.location.href = window.location.href.split("?")[0]+"?filter="+getFilterSelectValue;
        })

        document.querySelector("#restart_search_btn").addEventListener("click",function(){
            const getfilter = document.getElementById("filter");
            const getsearch = document.getElementById("search_box");
            getfilter.selectedIndex = 0;
            getsearch.value = "";

            
            window.location.href = window.location.href.split("?")[0];
        })
        // end filter

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
        //         url : "poststatus",
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
