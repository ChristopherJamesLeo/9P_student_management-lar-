@extends('layouts.index')
@section('style')
    <style>
        span {
            font-size: 14px;
            font-weight: 500 !important;
            color: #000 !important;
        }
        .form-group label {
            font-size: 14px;
        }
        .form-group .form-control,.form-group .form-select  {
            font-size: 14px;
        }
    </style>
@endsection
@section('content_area')
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="p-2 rounded-1 border profile_container">
                <div class=" profile_content_header">
                    <div class="py-3 text-center profile_img_container">
                        <img src="{{asset('./assets/imgs/profiles/about.jpg.webp')}}" width="150px" height="150px" class="rounded-circle border" alt="user_img">
                    </div>
                    <div class="text-center">
                        <h5>{{$user->name}}</h5>
                        <span>{{$user->email}}</span>
                        <div class="px-3 d-flex justify-content-between">
                            <span class="">{{$user->registration->reg_no}}</span>
                            <span class="">{{$user->role->name}}</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="profile_content_body">
                    <ul class="list-unstyled">
                        <li class="px-2 py-1 d-flex justify-content-between">
                            <span>Followers</span>
                            <span>1 Followers</span>
                        </li>
                        <li class="px-2 py-1 d-flex justify-content-between">
                            <span>Likes</span>
                            <span>1 Likes</span>
                        </li>
                        <li class="px-2 py-1 d-flex justify-content-between">
                            <span>Gender</span>
                            <span>{{$user->gender->name}}</span>
                        </li>
                        <li class="px-2 py-1 d-flex justify-content-between">
                            <span>Role</span>
                            <span>{{$user->role->name}}</span>
                        </li>
                        <li class="px-2 py-1 d-flex justify-content-between">
                            <span>City</span>
                            <span>{{$user->city->name}}</span>
                        </li>
                        <li class="px-2 py-1 d-flex justify-content-between">
                            <span>Country</span>
                            <span>{{$user->country->name}}</span>
                        </li>
                        <li class="px-2 py-1 d-flex justify-content-between">
                            <span>Status</span>
                            <span>{{$user->status->name}}</span>
                        </li>
                        {{-- <li class="px-2 py-1 d-flex justify-content-between">
                            <span>Phone</span>
                            <span>09957092779</span>
                        </li> --}}
                        <li class="px-2 py-1 d-flex justify-content-between">
                            <span>Created At</span>
                            <span>{{date("d M Y",strToTime($user->created_at))}}</span>
                        </li>
                        
                    </ul>
                </div>
                <hr>
                <div class="px-2 py-1 profile_content_footer">
                    <div class=" d-flex gap-2 justify-content-between">
                        <a href="javascript:void(0)" 
                        data-bs-toggle = "modal"
                        data-bs-target="#user_login_edit_form"
                        class="w-100 btn btn-success rounded-2">Edit</a>
                        <a href="#" class="w-100 btn btn-danger rounded-2">Delete</a>
                    </div>
                    <a href="#usre_password_edit"
                    data-bs-toggle="modal" 
                     class="mt-2 w-100 btn btn-danger">Change Password</a>
                </div>
            </div>
        </div>
        {{-- start user edit log in form modal --}}
        <div id="user_login_edit_form" class="modal fade">
            <div class="modal-dialog modal-lg modal-dialog-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6>Edit User Info</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('dashboard.update',$user->id)}}" method="POST">
                            @csrf
                            @method("PUT")
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-2 form-group">
                                    <label for="name">User Name</label>

                                    <input type="text" name="name" id="name" class="form-control rounded-1 outline-none shadow-none border" value="{{old('name',$user->name)}}" placeholder="Enter Your Name">
                                </div>
                                <div class="col-md-6 col-sm-12 mb-2 form-group">
                                    <label for="email">User Email</label>
                                    <input type="email" name="email" id="email" class="form-control rounded-1 outline-none shadow-none border" value="{{old('email',$user->email)}}" placeholder="Enter Your Email">
                                </div>
                                @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
                                    <div class="col-md-6 col-sm-12 mb-2 form-group">
                                        <label for="status_id">Status</label>
                                        <select name="status_id" id="status_id" class="form-select rounded-0 shadow-none outline-none">
                                            <option value="" selected disabled>Choose Status</option>
                                            @foreach ($statuses as $id => $name)
                                                <option value="{{$id}}"  {{$id == $user->status_id ? "selected" : ""}}>{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-2 form-group">
                                        <label for="role_id">Role</label>

                                        <select name="role_id" id="role_id" class="form-select rounded-0 shadow-none outline-none">
                                            <option value="" selected disabled>Choose Role</option>
                                            @foreach ($roles as $id => $name)
                                                <option value="{{$id}}"  {{$id == $user->role_id ? "selected" : ""}}>{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div class="col-md-6 col-sm-12 mb-2 form-group">
                                    <label for="gender_id">Gender</label>
                                    <select name="gender_id" id="gender_id" class="form-select rounded-0 shadow-none outline-none">
                                        <option value="" selected disabled>Choose Gender</option>
                                        @foreach ($genders as $id => $name)
                                            <option value="{{$id}}"  {{$id == $user->gender_id ? "selected" : ""}}>{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-6 col-sm-12 mb-2 form-group">
                                    <label for="city_id">City</label>
                                    
                                    <select name="city_id" id="city_id" class="form-select rounded-0 shadow-none outline-none">
                                        <option value="" selected disabled>Choose City</option>
                                        @foreach ($cities as $id => $name)
                                            <option value="{{$id}}"  {{$id == $user->city_id ? "selected" : ""}}>{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-2 form-group">
                                    <label for="country_id">Country</label>
                                    <select name="country_id" id="country_id" class="form-select rounded-0 shadow-none outline-none">
                                        <option value="" selected disabled>Choose Country</option>
                                        @foreach ($countries as $id => $name)
                                            <option value="{{$id}}"  {{$id == $user->country_id ? "selected" : ""}}>{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary rounded-0">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        {{-- end user edit log in form modal --}}
        {{-- start change password modal --}}
        <div id="usre_password_edit" class="modal fade">
            <div class="modal-dialog modal-sm modal-dialog-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6>Edit Password</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        @include('profile.partials.update-password-form')
                        {{-- <form method="POST" action="{{ route('password.update') }}" class="">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-12 mb-2 form-group">
                                    <label for="update_password_current_password">Current Password</label>

                                    <input type="password" name="current_password" id="update_password_current_password" class="form-control rounded-1 outline-none shadow-none border">
                                </div>
                                <div class="col-sm-12 mb-2 form-group">
                                    <label for="update_password_password">New Password</label>
                                    <input type="password" name="password" id="update_password_password" class="form-control rounded-1 outline-none shadow-none border">
                                </div>
                                <div class="col-sm-12 mb-2 form-group">
                                    <label for="update_password_password_confirmation">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="update_password_password_confirmation" class="form-control rounded-1 outline-none shadow-none border" >
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary rounded-0 shadow-none outline-none">Submit</button>
                                </div>

                            </div>
                        </form> --}}

                    </div>
                </div>
            </div>
        </div>
        {{-- end change password modal --}}
        <div class="col-lg-8 col-md-6 col-sm-12">
            <div class="mb-5">
                @if (count($leaves) > 0)
                    
                    <div class="mb-3 border p-2 leave_container">
                        <h5 style="font-size: 16px">Leave Record</h5>
                        <span class="d-block text-end" style="font-size: 12px;">Total Leave - {{count($leaves)}}</span>
                        <div class="leave_table_container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Stage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaves as $leave)
                                        <tr>
                                            <td>
                                                {{date("d M Y",strToTime($leave->startdate))}}
                                            </td>
                                            <td>
                                                {{date("d M Y",strToTime($leave->enddate))}}
                                            </td>
                                            <td>{{$leave->stage->name}}</td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>

                        </div>
                        
                        
                    </div>
                
                @endif
                {{-- start leave button --}}
                @if ($user->role_id == 1 || $user->role_id == 2)
                            
                    <div class="mb-3 d-grid">
                        <button type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#leave_model"
                        class="btn btn-primary rounded-0 shadow-none border-none outline-none">Leave</button>
                    </div>


                @endif
                {{-- end leave button --}}
                
                <hr>
                <h6 class="mt-2">Enrolls</h6>
                <div class="row">
                    @foreach ($enrolls as $enroll)
                        <div class="col-md-4 col-sm-6 mb-2">
                            <div class="p-2 border d-flex flex-column gap-2 enroll_container">
                                <span><a href="{{route('posts.show',$enroll->post->slug)}}" wire:navigate>{{$enroll->post->name}}</a></span>
                                <span>{{$enroll->stage->name}}</span>
                                <span>{{$enroll->updated_at->diffForHumans()}}</span>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
{{-- <script src="https://cdn.tailwindcss.com"></script> --}}
@endsection