<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile" style="background: url(../assets/images/background/user-info.jpg) no-repeat;">
            <!-- User profile image -->
            <div class="profile-img"> <img src="{{asset('assets/images/users/profile.png')}}" alt="user" /> </div>
            <!-- User profile text-->
            <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown"
                    role="button" aria-haspopup="true" aria-expanded="true">{{ Auth::user()->name }}</a>
                <div class="dropdown-menu animated flipInY"> <a href="{{route('profileuser')}}" class="dropdown-item"><i class="ti-user"></i>
                        My Profile</a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>

                    </form>
                </div>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->

        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                @if (session('user_menu'))
                @foreach (session('user_menu')->where('is_active', 1) as $module)
                @if ($module->level == 'module') <!-- Level 1: Modul -->
                <li>
                    <a class="waves-effect waves-dark {{ $module->children->isNotEmpty() ? 'has-arrow' : '' }}"
                        href="#" aria-expanded="false">
                        <i class="mdi mdi-book-open-variant"></i>
                        <span class="hide-menu">{{ $module->name }}</span>
                    </a>

                    @if ($module->children->isNotEmpty()) <!-- Level 2: Submodul -->
                    <ul aria-expanded="false" class="collapse">
                        @foreach ($module->children as $subModule)
                        <li>
                            <a class="{{ $subModule->children->isNotEmpty() ? 'has-arrow' : '' }}"
                                href="{{ url($subModule->url) }}">
                                {{ $subModule->name }}
                            </a>

                            @if ($subModule->children->isNotEmpty()) <!-- Level 3: Menu -->
                            <ul aria-expanded="false" class="collapse">
                                @foreach ($subModule->children as $menu)


                                <li>
                                    <a href="{{ url($menu->url) }}">
                                        {{ $menu->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endif
                @endforeach
                @else
                <script>
                    window.location.href = "{{ route('login') }}";
                </script>
                @endif
            </ul>
        </nav>

        <!-- End Sidebar navigation -->
    </div>

</aside>