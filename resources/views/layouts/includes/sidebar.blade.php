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
                <div class="parent-icon"><i class="bi bi-"></i>
                </div>
                <div class="menu-title">Quản lý quản trị</div>
            </a>
            <ul>
                <li> <a href="ecommerce-add-new-product-2.html"><i class="bi bi-circle"></i>Danh sách quản trị viên</a>
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
                <li> <a href="{{route('building')}}"><i class="bi bi-circle"></i>Danh sách căn hộ</a>
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
               <li> <a href="{{route('apartment')}}"><i class="bi bi-circle"></i>Danh sách căn hộ</a>
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
                <li> <a href="{{route('service.index')}}" target="_blank"><i class="bi bi-circle"></i>Danh sách dịch vụ</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div class="menu-title">Hóa đơn</div>
            </a>
            <ul>
                <li> <a href="pages-errors-coming-soon.html" target="_blank"><i class="bi bi-circle"></i>Danh sách hóa đơn</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Mục khác</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-bar-chart-line-fill"></i>
                </div>
                <div class="menu-title">Quản lý thông báo</div>
            </a>
            <ul>
                <li> <a href="charts-apex-chart.html"><i class="bi bi-circle"></i>Tạo thông báo</a>
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
        <li class="menu-label"><a style="background-color: #3461ff; color: white; text-decoration: none" href="{{route('signout')}}">Đăng xuất</a></li>
    </ul>
    <!--end navigation-->
</aside>
