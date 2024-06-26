                <!-- start right side container -->
                <div class="ms-auto  right_side_container">
                    <!-- start aside show hide button -->
                    <button type="button" id="" class="d-block d-lg-none d-flex flex-column align-items-center rounded-0 border-0 aside_show_btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <!-- end aside show hide buttons -->

                    <!-- start aside right header -->
                    <div class="p-2 d-flex justify-content-between align-items-center" style="background-color: var(--bg-color); position: sticky; top:0; z-index:100;">
                        <div class="d-none d-md-block">
                            <ol class="m-0 p-0 breadcrumb" style="font-size: 14px">
                                <li class="breadcrumb-item"><a href="{{\Request::root()}}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item">
                                    <a href="{{url()->previous()}}">{{Str::title(preg_replace('/[[:punct:]]+[[:alnum:]]+/','',str_replace(\Request::root()."/","",url()->previous())))}}</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    {{ucfirst(\Request::path())}}
                                </li>
                            </ol>

                        </div>
                        <div>
                            <h5 class="m-0 p-0 d-none d-md-block">{{ucfirst(\Request::path())}}</h5>
                        </div>
                        <div class="d-flex align-items-center gap-4">
                            {{-- <div class="noti_group dropdown"> --}}
                            <div class=" dropdown">
                                {{-- <a href="javascript:void(0)" class="nav-link show_noti dropdown-toggle" onclick="showlist()"> --}}
                                <a href="javascript:void(0)" class="nav-link show_noti dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fas fa-bell"></i>
                                    <span class="badge bg-primary rounded-circle">{{count(Auth::user()->unreadNotifications)}}</span>
                                </a>
                                <ul class="list-unstyled p-0 dropdown-menu">
                                    @foreach (Auth::user()->notifications as $notification)
                                        <li class="border p-2">
                                            <a href="{{route("announcements.index")}}"
                                            wire:navigate
                                             class="nav-link dropdown-item d-flex justify-content-between">
                                                <small>
                                                    <span class="d-block">{{$notification->data["title"]}}</span>
                                                    <span>{{Str::limit($notification->data["message"],20)}}</span>
                                                </small>
                                                <small>{{$notification->created_at->format("d m y")}}</small>
                                            </a>
                                        </li>
                                    @endforeach
                                    <li class="border p-2">
                                        <a href="{{route("announcement.markread")}}"
                                        wire:navigate
                                         class="dropdown-item nav-link d-flex justify-content-between text-capitalize">
                                            Make all readed
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <div class="d-flex align-items-center profile_group">
                                <span>{{auth()->user()->name}}</span>
                                <div class="ms-2 dropdown">
                                   
                                    <a href="javascript:void(0)" class="nav-link profile_list dropdown-toggle" data-bs-toggle="dropdown">
                                        <img src="{{asset('./assets/imgs/profiles/about.jpg.webp')}}" class="rounded-circle" width="30px" height="30px" alt="">
                                    </a>
                                    <ul class="list-unstyled p-1 dropdown-menu show_profile_setting">
                                        {{-- <li class="p-2">
                                            <a href="{{route('profile.edit')}}" class="nav-link d-flex justify-content-between">
                                                Profile
                                            </a>
                                        </li> --}}
                                        <li class="p-2">
                                            <form method="POST" class="logout_form" action="{{ route('logout') }}">
                                                @csrf
                                                @method("POST")
                                                <a href="{{route('logout')}}" class="dropdown-item nav-link logoutbtn">Log Out</a>
                                            </form>
                                            <script>
                                                document.querySelector(".logoutbtn").addEventListener("click",function logout(e){
                                                    e.preventDefault();
                                                    if(window.confirm("Are You Sure To Log Out")){
                                                        this.closest("form").submit();
                                                    }
                                                    
                                                })
                                                
                                            </script>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end aside right header -->

                    <!-- start content area -->
                    <div class="p-3 content_area_container">
                        @yield('content_area')
                    </div>
                    <!-- end content area -->
                </div>
                <!-- end right side container -->