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
                    <div class="p-2 d-flex justify-content-between align-items-center" style="background-color: var(--bg-color); position: sticky; top:0;">
                        <form action="">
                            <div class="ms-5 ms-lg-0 input-group">
                                <input type="text" name="" id="" class="form-control rounded-0 border-1 outline-none shadow-none" placeholder="Search ...">
                                <button type="submit" class="btn btn-primary rounded-0"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                        <div class="d-flex align-items-center gap-4 user_info_group">
                            <div class="noti_group">
                                <a href="javascript:void(0)" class="nav-link show_noti" onclick="showlist()"><i class="fas fa-bell"></i></a>
                                <ul class="list-unstyled show_noti_list">
                                    <li class="p-2">
                                        <a href="#" class="nav-link d-flex justify-content-between">
                                            <small>
                                                <span class="d-block">Title</span>
                                                <span>Content</span>
                                            </small>
                                            <small>12d</small>
                                        </a>
                                    </li>
                                    <li class="p-2">
                                        <a href="#" class="nav-link d-flex justify-content-between">
                                            <small>
                                                <span class="d-block">Title</span>
                                                <span>Content</span>
                                            </small>
                                            <small>12d</small>
                                        </a>
                                    </li>
                                    <li class="p-2">
                                        <a href="#" class="nav-link d-flex justify-content-between">
                                            <small>
                                                <span class="d-block">Title</span>
                                                <span>Content</span>
                                            </small>
                                            <small>12d</small>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="profile_group">
                                <div class="">
                                    <a href="javascript:void(0)" class="nav-link profile_list" onclick="showProfileSet()">
                                        <img src="./assets/imgs/profiles/about.jpg.webp" class="rounded-circle" width="30px" height="30px" alt="">
                                    </a>
                                    <ul class="list-unstyled show_profile_setting">
                                        <li class="p-2">
                                            <a href="{{route('profile.edit')}}" class="nav-link d-flex justify-content-between">
                                                Profile
                                            </a>
                                        </li>
                                        <li class="p-2">
                                            <form method="POST" class="logout_form" action="{{ route('logout') }}">
                                                @csrf
                                                @method("POST")
                                                <a href="{{route('logout')}}" class="nav-link logoutbtn">Log Out</a>
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