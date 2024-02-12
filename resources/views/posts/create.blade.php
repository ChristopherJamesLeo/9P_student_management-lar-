@extends('layouts.index')

@section('content_area')
    {{-- start create status --}}
    <div class="row">
        <div>
            <a href="{{route('posts.index')}}" wire:navigate class="btn btn-primary rounded-0">Back</a>
            <hr>
            <div class="mt-3 row">

            </div>
        </div>
        

    </div> 
    {{-- end create status --}}
@endsection

@section("script")

<script>
    $(document).ready(function(){

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
    })
</script>
@endsection
