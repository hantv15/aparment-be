<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Apartment</h4>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="/">
                <div class="menu-title">Tổng quan</div>
            </a>
        </li>
        <li class="menu-label">Quản lý người dùng</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-droplet-fill"></i>
                </div>
                <div class="menu-title">Nhân viên</div>
            </a>
            <ul>
                <li> <a href="{{route('staff.index')}}"><i class="bi bi-circle"></i>Danh sách nhân viên</a>
                </li>
                <li> <a href="{{route('department.index')}}"><i class="bi bi-circle"></i>Danh sách phòng ban</a>
                </li>
                <li> <a href="widgets-data-widgets.html"><i class="bi bi-circle"></i>Bảng chấm công</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-" ></i>
                </div>
                <div class="menu-title">Quản lý quản trị viên</div>
            </a>
            <ul>
                <li> <a href="{{route('admin-technicians.index')}}"><i class="bi bi-circle"></i>Danh sách quản trị viên</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-persons"></i>
                </div>
                <div class="menu-title">Cư dân</div>
            </a>
            <ul>
                <li> <a href="{{route('user.index')}}"><i class="bi bi-circle"></i>Danh sách cư dân</a>
                <li> <a href="{{route('card.index')}}"><i class="bi bi-circle"></i>Danh sách thẻ</a>
                </li>
            </ul>
        </li>

        <li class="menu-label">Quản lý tòa nhà</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-file-earmark-break-fill"></i>
                </div>
                <div class="menu-title">Tòa nhà</div>
            </a>
            <ul>
                <li> <a href="{{route('building.index')}}"><i class="bi bi-circle"></i>Danh sách tòa nhà</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-file-earmark-spreadsheet-fill"></i>
                </div>
                <div class="menu-title">Căn hộ</div>
            </a>
            <ul>
               <li> <a href="{{route('apartment.index')}}"><i class="bi bi-circle"></i>Danh sách căn hộ</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Quản lý dịch vụ</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-lock-fill"></i>
                </div>
                <div class="menu-title">Dịch vụ</div>
            </a>
            <ul>
                <li> <a href="{{route('service.index')}}" ><i class="bi bi-circle"></i>Danh sách dịch vụ</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="">
                <div class="parent-icon"><i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div class="menu-title">Hóa đơn</div>
            </a>
            <ul>
                <li> <a href="{{route('bill.index')}}" ><i class="bi bi-circle"></i>Danh sách hóa đơn</a>
                </li>
                <li> <a href="{{route('bill-detail.index')}}" ><i class="bi bi-circle"></i>Hóa đơn chi tiết</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-" ></i>
                </div>
                <div class="menu-title">Quản lý thẻ xe</div>
            </a>
            <ul>
                <li> <a href="{{route('vehicle-type.index')}}"><i class="bi bi-circle"></i>Danh sách loại xe</a>
                </li>
                <li> <a href="{{route('vehicle.index')}}"><i class="bi bi-circle"></i>Danh sách Thẻ xe</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Mục khác</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-bar-chart-line-fill"></i>
                </div>
                <div class="menu-title">Quản lý bảo trì</div>
            </a>
            <ul>
                <li> <a href="{{route('maintenance.index')}}"><i class="bi bi-circle"></i>Danh sách bảo trì</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-pin-map-fill"></i>
                </div>
                <div class="menu-title">Phản hồi</div>
            </a>
            <ul>
                <li> <a href="{{route('feedback.list')}}"><i class="bi bi-circle"></i>Danh sách phản hồi</a>
                </li>
            </ul>
        </li>
        @if (Auth::check())
        <li class="menu-label"><a style="background-color: #3461ff; color: white; text-decoration: none" href="{{route('logout')}}">Đăng xuất</a></li>
        @endif
        
    </ul>
    <!--end navigation-->
</aside>
