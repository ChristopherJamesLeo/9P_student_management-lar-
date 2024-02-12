@if (session()->has("success"))
        <script>toastr.success('{{session()->get('success')}}', 'Successful')</script>
    @endif

    @if (session()->has("info"))
        <script>toastr.success('{{session()->get('info')}}', 'Information')</script>
    @endif

    @if ($errors)
        @foreach ($errors->all() as $errors)
            <script>toastr.error('{{$error}}',"Warning",{timeOut:5000}) </script> 
        @endforeach
        
    @endif