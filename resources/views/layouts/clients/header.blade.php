
<header class="header-area header-sticky mt-20">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.html" class="logo">
                        {{-- <img src="{{asset('assets/images/clients/logo.png')}}" alt=""> --}}
                        Apartment
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="{{route('logout')}}home" class="active">Trang chủ</a></li>
                        <li><a href="meetings.html">Giới thiệu</a></li>
                        <li class="scroll-to-section"><a href="#apply">Quản lý tòa nhà</a></li>
                        {{-- <li class="has-sub">
                            <a href="javascript:void(0)">Pages</a>
                            <ul class="sub-menu">
                                <li><a href="meetings.html">Upcoming Meetings</a></li>
                                <li><a href="meeting-details.html">Meeting Details</a></li>
                            </ul>
                        </li> --}}
                        <li class="scroll-to-section"><a href="#courses">Khách hàng</a></li>
                        {{-- <span class="p-3">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                        <img src="{{asset('assets/images/logo-icon.png')}}" class="user-img" alt=""> --}}
                        {{-- <li class="scroll-to-section"><a href="{{route('staff.index')}}">Login</a></li> --}}

                        @if (Route::has('login'))
                        
                        @auth
                        <li class="has-sub">
                        <a href="" class="text-sm text-gray-700 dark:text-gray-500">{{Auth::user()->name}}</a>
                            <ul class="sub-menu btn-1">
                                <li class="menu-label" ><a style=" color: white; text-decoration: none"
                                    href="{{route('profile')}}">Tài khoản</a></li>
                                @if (Auth::check())
                                <li class="menu-label" ><a style="color: white; text-decoration: none"
                                        href="{{route('logout')}}">Đăng xuất</a></li>
                                @endif
                            </ul>
                        </li>
                        @else
                        <li class="">
                            <a href="{{ route('login-client')}}" class="text-sm text-gray-700 dark:text-gray-500 ">Đăng
                                nhập</a>
                        </li>
                        @endauth
                      
                        {{-- <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                            @auth
                            <span class="text-sm text-gray-700 dark:text-gray-500">Xin chào, <a href=""
                                    class="text-sm text-gray-700 dark:text-gray-500 underline">{{Auth::user()->name}}</a></span>
                            <a href="" class="text-sm text-gray-700 dark:text-gray-500 underline">Đăng xuất</a>
                            @else
                            <a href="{{ route('login') }}"
                                class="text-sm text-gray-700 dark:text-gray-500 underline">Đăng nhập</a>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Đăng ký</a>
                            @endif
                            @endauth
                        </div> --}}
                        @endif


                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>