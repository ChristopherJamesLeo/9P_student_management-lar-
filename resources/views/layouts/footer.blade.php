    <!-- bootstrap 5.3 css1 js1 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    @livewireScripts

    <!-- jquery 3.7.1 js1-->
    <script src="{{asset('./assets/libs/jquery_3_7_1.js')}}"></script>

    {{-- jquery ajax --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    


    {{-- tostr js css1 js1 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    @if (session()->has("success"))
        <script>toastr.success('{{session()->get('success')}}', 'Successful')</script>
    @endif

    @if (session()->has("info"))
        <script>toastr.info('{{session()->get('info')}}', 'Information')</script>
    @endif


    @if ($errors)
        @foreach ($errors->all() as $error)
            <script>toastr.error('{{$error}}',"Warning",{timeOut:5000}) </script> 
        @endforeach
        
    @endif
    <!-- custom js -->
    <script src="{{asset('./assets/js/app.js')}}"></script>

    @yield('script')

</body>
</html>