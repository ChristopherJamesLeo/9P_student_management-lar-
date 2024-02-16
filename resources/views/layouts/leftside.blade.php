                <!-- start left side -->
                <div id="left_side_container" class="left_side_container ">
                    <!-- start aside -->
                    <aside class="">
                        <div class="aside_header">
                        </div>
                        <div class=" aside_body">
                            <ul class="d-flex flex-column align-items-start list-unstyled">
                                <li class="">
                                    <a href="{{route('dashboard')}}" wire:navigate class="nav-link ">Home</a>
                                </li>

                                <li class="" data-bs-toggle="collapse" data-bs-target="#post">
                                    <a href="javascript:void(0)" class="nav-link">Post</a>
                                </li>

                                <ul id="post" class="collapse list-unstyled">
                                    <li class="border-0">
                                        <a href="{{route('posts.index')}}" wire:navigate class="nav-link ">Post</a>
                                    </li>
                                    <li class="border-0">
                                        <a href="{{route('enrolls.index')}}" wire:navigate class="nav-link ">Enrolls</a>
                                    </li>
                                </ul>
                                <li class="">
                                    <a href="{{route('attendances.index')}}" wire:navigate class="nav-link ">Attendance</a>
                                </li>
                                <li class="">
                                    <a href="{{route('users.index')}}" wire:navigate class="nav-link ">User</a>
                                </li>

                                <li class="" data-bs-toggle="collapse" data-bs-target="#addon">
                                    <a href="javascript:void(0)" class="nav-link">Add On</a>
                                </li>

                                    <ul id="addon" class="collapse list-unstyled">
                                        <li class="border-0">
                                            <a href="{{route('cities.index')}}" 
                                            wire:navigate
                                            class="nav-link">Cities</a>
                                        </li>
                                        <li class="border-0">
                                            <a href="{{route('countries.index')}}" 
                                            wire:navigate
                                            class="nav-link">Countries</a>
                                        </li>
                                    </ul>

                                <li class="" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#fixed">
                                    <a href="javascript:void(0)" class="nav-link">Fix Analysis</a>
                                </li>
                                    <ul id="fixed" class="collapse list-unstyled">
                                        <li class="border-0">
                                            <a href="{{route('statuses.index')}}" 
                                            wire:navigate
                                            class="nav-link">Status</a>
                                        </li>
                                        <li class="border-0">
                                            <a href="{{route('stages.index')}}"
                                            wire:navigate 
                                            class="nav-link">Stage</a>
                                        </li>
                                        <li class="border-0">
                                            <a href="{{route('tags.index')}}" 
                                            wire:navigate 
                                            class="nav-link">Tags</a>
                                        </li>
                                        <li class="border-0">
                                            <a href="{{route('types.index')}}" 
                                            wire:navigate 
                                            class="nav-link">Types</a>
                                        </li>
                                        <li class="border-0">
                                            <a href="{{route('days.index')}}" 
                                            wire:navigate 
                                            class="nav-link">Days</a>
                                        </li>
                                        <li class="border-0">
                                            <a href="{{route('roles.index')}}" 
                                            wire:navigate 
                                            class="nav-link">Roles</a>
                                        </li>
                                        <li class="border-0">
                                            <a href="{{route('genders.index')}}" 
                                            wire:navigate 
                                            class="nav-link">Gender</a>
                                        </li>
                                    </ul>



                        </div>
                        <div class="aside_footer">

                        </div>
                    </aside>
                    <!-- end aside -->
                </div>
                <!-- end left side -->