                <!-- start left side -->
                <div id="left_side_container" class="left_side_container ">
                    <!-- start aside -->
                    <aside class="">
                        <div class="aside_header">
                        </div>
                        <div class=" aside_body">
                            <ul class="d-flex flex-column align-items-start list-unstyled">
                                <li class="">
                                    <a href="{{route('dashboard.index')}}" wire:navigate class="d-flex align-items-center nav-link "><i class="fas fa-home fa-sm me-2"></i> Home</a>
                                </li>

                                <li class="" data-bs-toggle="collapse" data-bs-target="">
                                    <a href="javascript:void(0)" class="nav-link d-flex align-items-center "> <i class="fas fa-file fa-sm me-2"></i> Post</a>
                                </li>

                                <ul id="post" class=" list-unstyled">
                                    <li class="border-0">
                                        <a href="{{route('posts.index')}}" wire:navigate class="nav-link d-flex align-items-center "> <i class="fas fa-file fa-sm me-2"></i>Post</a>
                                    </li>
                                    <li class="border-0">
                                        <a href="{{route('enrolls.index')}}" wire:navigate class="nav-link d-flex align-items-center "> <i class="fas  fa-paperclip fa-sm  me-2"></i>Enrolls</a>
                                    </li>
                                </ul>
                                <li class="">
                                    <a href="{{route('attendances.index')}}" wire:navigate class="nav-link d-flex align-items-center "> <i class="fas  fa-pencil-alt  fa-sm me-2"></i>Attendance</a>
                                </li>
                                <li class="">
                                    <a href="{{route('announcements.index')}}" wire:navigate class="nav-link d-flex align-items-center "> <i class="fas  fa-bullhorn fa-sm me-2"></i>Announcement</a>
                                </li>
                                <li class="">
                                    <a href="{{route('leaves.index')}}" wire:navigate class="nav-link d-flex align-items-center "> <i class="fas fa-running fa-sm  me-2"></i>Leaves</a>
                                </li>
                                <li class="">
                                    <a href="{{route('edulinks.index')}}" wire:navigate class="nav-link d-flex align-items-center "> <i class="fas  fa-underline fa-sm  me-2"></i>Edu Links</a>
                                </li>
                                <li class="">
                                    <a href="{{route('users.index')}}" wire:navigate class="nav-link d-flex align-items-center "> <i class="fas  fa-users fa-sm  me-2"></i>User</a>
                                </li>

                                <li class="" data-bs-toggle="collapse" data-bs-target="">
                                    <a href="javascript:void(0)" class="nav-link d-flex align-items-center "> <i class="fas fa-plus-square fa-sm  me-2"></i>Add On</a>
                                </li>

                                    <ul id="addon" class=" list-unstyled">
                                        <li class="border-0">
                                            <a href="{{route('cities.index')}}" 
                                            wire:navigate
                                            class="nav-link d-flex align-items-center "> <i class="fas fa-building fa-sm  me-2"></i>Cities</a>
                                        </li>
                                        <li class="border-0">
                                            <a href="{{route('countries.index')}}" 
                                            wire:navigate
                                            class="nav-link d-flex align-items-center "> <i class="fas  fa-flag fa-sm me-2"></i>Countries</a>
                                        </li>
                                    </ul>

                                <li class="" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#fixed">
                                    <a href="javascript:void(0)" class="nav-link d-flex align-items-center "> <i class="fas fa-skull-crossbones fa-flag me-2"></i>Fix Analysis</a>
                                </li>
                                    <ul id="fixed" class="collapse list-unstyled">
                                        <li class="border-0">
                                            <a href="{{route('statuses.index')}}" 
                                            wire:navigate
                                            class="nav-link d-flex align-items-center "> <i class="fas fa-radiation  fa-sm me-2 text-danger"></i>Status</a>
                                        </li>
                                        <li class="border-0">
                                            <a href="{{route('stages.index')}}"
                                            wire:navigate 
                                            class="nav-link d-flex align-items-center "> <i class="fas fa-radiation  fa-sm me-2 text-danger"></i>Stage</a>
                                        </li>
                                        <li class="border-0">
                                            <a href="{{route('tags.index')}}" 
                                            wire:navigate 
                                            class="nav-link d-flex align-items-center "> <i class="fas fa-radiation  fa-sm me-2 text-danger"></i>Tags</a>
                                        </li>
                                        <li class="border-0">
                                            <a href="{{route('types.index')}}" 
                                            wire:navigate 
                                            class="nav-link d-flex align-items-center "> <i class="fas fa-radiation  fa-sm me-2 text-danger"></i>Types</a>
                                        </li>
                                        <li class="border-0">
                                            <a href="{{route('days.index')}}" 
                                            wire:navigate 
                                            class="nav-link d-flex align-items-center "> <i class="fas fa-radiation  fa-sm me-2 text-danger"></i>Days</a>
                                        </li>
                                        <li class="border-0">
                                            <a href="{{route('roles.index')}}" 
                                            wire:navigate 
                                            class="nav-link d-flex align-items-center "> <i class="fas fa-radiation  fa-sm me-2 text-danger"></i>Roles</a>
                                        </li>
                                        <li class="border-0">
                                            <a href="{{route('genders.index')}}" 
                                            wire:navigate 
                                            class="nav-link d-flex align-items-center "> <i class="fas fa-radiation fa-sm  me-2 text-danger"></i>Gender</a>
                                        </li>
                                    </ul>
                        </div>
                        <div class="aside_footer">

                        </div>
                    </aside>
                    <!-- end aside -->
                </div>
                <!-- end left side -->