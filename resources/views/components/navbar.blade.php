<nav class="layout-navbarnavbar navbar-expand-xl navbar-detached shadow-none py-1 border-b border-b-[#1414141F] sticky-top align-items-center bg-white opacity-100"
id="layout-navbar">


    <div class="navbar-nav-right items-center flex container" id="navbar-collapse">
				<h1 class="text-2xl opacity-100 text-second m-0">@yield('title')</h1>

        <ul class="navbar-nav flex-row align-items-center ms-auto gap-3">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle d-flex items-center gap-3 hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                    @if (auth()->user()->image_path)
                	    <img src="{{ asset(auth()->user()->image_path) }}" alt class="w-px-40 h-auto rounded-[50%] aspect-square object-cover object-center" />
                    @else   
                	    <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                    @endif
                </div>
                <span class="d-xl-flex d-none">
                    <span class="font-medium text-second block">{{ auth()->user()->username }}</span>
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#">
                        <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                                @if (auth()->user()->image_path)
                                    <img src="{{ asset(auth()->user()->image_path) }}" alt class="w-px-40 h-auto rounded-[50%] aspect-square object-cover object-center" />
                                @else
                                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-[50%] aspect-square object-cover object-center" />
                                @endif
                            </div>
                        </div>
                        <div class="flex-grow-1">
                                <span class="font-medium text-second block">{{ auth()->user()->username }}</span>
                                <small class="text-sm text-desc">{{ auth()->user()->role->label() }}</small>
                            </div>
                        </div>
                    </a>
                </li>
                {{-- <li>
                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                        @csrf
                        <i class="bx bx-user-circle me-2"></i>
                        <button type="submit">
                            Profile
                        </button>
                    </a>
                </li> --}}
                <li>
                    <form class="dropdown-item" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">
                            <i class="bx bx-log-out me-2"></i>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
            </li>
        </ul>
			<div class="layout-menu-toggle navbar-nav align-items-xl-center ml-3 me-xl-0 d-xl-none">
					<a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
						<i class="bx bx-menu bx-sm"></i>
					</a>
			</div>
    </div>
</nav>
