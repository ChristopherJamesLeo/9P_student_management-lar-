@extends('layouts.index')

@section('content_area')
    {{-- start create status --}}
    <div class="row">
        @livewire("status.create")
    </div> 
    {{-- end create status --}}
@endsection

