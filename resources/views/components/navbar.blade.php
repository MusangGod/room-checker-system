

<nav class="{{auth()->user()->role == \App\Enums\Role::STAFF ? 'lg:flex hidden' : ''}} navbar-expand-xl navbar-detached shadow-none py-1 border-b border-b-[#1414141F] sticky-top align-items-center bg-white opacity-100"
id="layout-navbar">
    <div class="navbar-nav-right items-center flex container justify-between" id="navbar-collapse">
        @if(auth()->user()->role == App\Enums\Role::ADMIN)
            <h1 class="text-2xl opacity-100 text-second m-0">@yield('title')</h1>
        @endif
        @if(auth()->user()->role == App\Enums\Role::STAFF)
                <img src="{{@asset('assets/img/logo.svg')}}" alt="logo">
                <ul class="flex gap-3 mb-0">
                <li>
                    <a class="side-link p-0 {{Request::is('dashboard') ? 'active' : ''}}" href="{{route('dashboard')}}">Beranda</a>
                </li>
                <li>
                    <a class="side-link p-0 {{Request::is('dashboard/roomCheckers*') ? 'active' : ''}}" href="{{route('roomCheckers.index')}}">Pengecekan Ruangan</a>
                </li>
                <li>
                    <a class="side-link p-0 {{Request::is('dashboard/reports*') ? 'active' : ''}}" href="{{route('reports.index')}}">Riwayat</a>
                </li>
            </ul>
        @endif
            <div class="flex items-center">
                <ul class="navbar-nav flex-row align-items-center gap-3">
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
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.index') }}">
                                    @csrf
                                    <i class="bx bx-user-circle me-2"></i>
                                    <button type="submit">
                                        Profile
                                    </button>
                                </a>
                            </li>
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
    </div>
</nav>

@if(auth()->user()->role == \App\Enums\Role::STAFF)
    <nav class="flex lg:hidden justify-between items-center px-5 py-3 w-full rounded py-1 border-b border-b-[#1414141F] sticky-top align-items-center bg-white opacity-100">
        <img src="{{@asset('assets/img/logo.svg')}}" alt="logo">
        <div class="flex gap-2">
            <ul class="navbar-nav flex-row align-items-center gap-3">
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
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.index') }}">
                                @csrf
                                <i class="bx bx-user-circle me-2"></i>
                                <button type="submit">
                                    Profile
                                </button>
                            </a>
                        </li>
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
            <button class="hamburger-wrapper">
                <svg width="28" height="28" viewBox="0 0 320 320" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_496_2)">
                        <path
                            d="M159.55 88.3597C114.54 88.3597 69.5299 88.3898 24.5199 88.3498C9.78987 88.3398 -0.790126 77.5597 -0.290126 63.2797C0.139874 51.1097 10.0499 41.0997 22.2699 40.4897C23.2699 40.4397 24.2699 40.4498 25.2699 40.4498C114.91 40.4498 204.55 40.4398 294.2 40.4498C306.15 40.4498 315.34 46.7998 318.58 57.1998C323.4 72.6498 312.09 88.1897 295.7 88.3097C275.45 88.4597 255.19 88.3498 234.94 88.3498C209.81 88.3598 184.68 88.3597 159.55 88.3597Z"
                            fill="white" />
                        <path
                            d="M159.28 184.19C114.4 184.19 69.5099 184.21 24.6299 184.18C12.4699 184.17 3.17987 177.12 0.329873 165.88C-3.31013 151.54 7.33986 137.12 22.1799 136.32C23.1799 136.27 24.1799 136.27 25.1799 136.27C114.82 136.27 204.46 136.26 294.11 136.27C306.12 136.27 315.28 142.54 318.57 152.93C323.41 168.21 312.3 183.89 296.19 184.12C280.32 184.35 264.43 184.18 248.56 184.18C218.79 184.19 189.03 184.19 159.28 184.19Z"
                            fill="white" />
                        <path
                            d="M160.03 232.109C204.91 232.109 249.8 232.089 294.68 232.119C306.74 232.129 315.92 239.009 318.86 250.069C322.71 264.589 312.12 279.149 297.09 279.979C296.09 280.029 295.09 280.029 294.09 280.029C204.45 280.029 114.81 280.039 25.16 280.029C13.22 280.029 3.98999 273.699 0.709989 263.339C-4.17001 247.929 7.12998 232.299 23.5 232.159C42.88 231.999 62.26 232.119 81.64 232.119C107.77 232.099 133.9 232.109 160.03 232.109Z"
                            fill="white" />
                    </g>
                    <defs>
                        <clipPath id="clip0_496_2">
                            <rect width="320" height="320" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </button>
        </div>
    </nav>
    <div class="topbar hide">
        <div class="flex justify-center items-center h-full">
            <div class="topbar-link flex flex-col gap-y-8 text-start">
                <a class="nav-link p-0 {{Request::is('dashboard') ? 'active' : ''}}" href="{{route('dashboard')}}">Beranda</a>
                <a class="nav-link p-0 {{Request::is('dashboard/rooms*') ? 'active' : ''}}" href="{{route('rooms.index')}}">Ruangan</a>
                <a class="nav-link p-0 {{Request::is('dashboard/roomCheckers*') ? 'active' : ''}}" href="{{route('roomCheckers.index')}}">Pengecekan Ruangan</a>
                <a class="nav-link p-0 {{Request::is('dashboard/reports*') ? 'active' : ''}}" href="{{route('reports.index')}}">Riwayat</a>
            </div>
        </div>
    </div>
@endif

<script>
    const linkCategories = document.getElementById('link_categories');
    const cardCategories = document.querySelector('.card-categories');
    const hamburger = document.querySelectorAll('.hamburger-wrapper');
    const topbar = document.querySelector('.topbar');
    const topbarLink = document.querySelectorAll('.topbar-link .nav-link');
    const body = document.querySelector('#home');
    const scrollTop = document.querySelector('.scroll-top');
    hamburger.forEach( item => {
        item.addEventListener('click', function() {
            topbar.classList.toggle('hide');
            body.classList.toggle('active');
        });
    })
    topbarLink.forEach(link => {
        link.addEventListener('click', function() {
            topbar.classList.toggle('hide');
            body.classList.toggle('active');
        })
    });

</script>
