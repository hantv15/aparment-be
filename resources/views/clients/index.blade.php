@extends('layouts.home')
@section('content')

<section class="section main-banner" id="top" data-section="section1">
  <div id="bg-video">
    <img src="{{asset('assets/images/clients/banner_home.jpg')}}" />
  </div>

  <div class="video-overlay header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="caption">
            <h2 style="font-family:'Times New Roman', Times, serif">Chào mừng đến với hệ thống <br /> quản lý chung cư
            </h2>
            <p>Hệ thống quản lý cư dân chung cư hàng đầu Việt Nam</p>
            <div class="main-button-red">
              <div class="scroll-to-section"><a href="#contact">Join Us Now!</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ***** Main Banner Area End ***** -->

<section class="services">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="owl-service-item owl-carousel">

          <div class="item">
            <div class="icon">
              <img src="{{asset('assets/images/clients/service-icon-01.png')}}" alt="">
            </div>
            <div class="down-content">
              <h4>Dịch vụ quản lý xe</h4>
              <p>Quản lý thẻ xe của cư dân trong tòa nhà</p>
            </div>
          </div>

          <div class="item">
            <div class="icon">
              <img src="{{asset('assets/images/clients/service-icon-02.png')}}" alt="">
            </div>
            <div class="down-content">
              <h4>Dịch vụ quản lí hóa đơn</h4>
              <p>Xuất hóa đơn các dịch vụ cho cư dân </p>
            </div>
          </div>

          <div class="item">
            <div class="icon">
              <img src="{{asset('assets/images/clients/service-icon-02.png')}}" alt="">
            </div>
            <div class="down-content">
              <h4>Dịch vụ quản lí hóa đơn</h4>
              <p>Xuất hóa đơn các dịch vụ cho cư dân </p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<section class="upcoming-meetings" id="meetings">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-heading">
          <h2>Các dịch vụ</h2>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="categories">
          <h4>Dịch vụ của tòa nhà</h4>
          <ul>
            <li>Gửi hóa đơn dịch vụ</li>
            <li>Lễ tân</li>
            <li>Bảo vệ an ninh tòa nhà</li>
            <li>Thông báo qua điện thoại</li>
            <li>Bảo trì tòa nhà</li>
          </ul>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="row">
          <div class="col-lg-6">
            <div class="meeting-item">
              <div class="thumb">

                <a href="#"><img src="https://psa.vn/wp-content/uploads/2021/04/IMG_8192.jpg"
                    alt="New Lecturer Meeting"></a>
              </div>
              <div class="down-content">
                <div class="date">
                  <h6>Nov <span>10</span></h6>
                </div>
                <a href="meeting-details.html">
                  <h4>Bảo trì tòa nhà</h4>
                </a>
                <p>Bảo trì tòa nhà là chuỗi những hoạt động nằm trong hoạt động quản lý tòa nhà.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="meeting-item">
              <div class="thumb">
                <a href="#"><img src="https://psa.vn/wp-content/uploads/2021/04/3.jpg" alt="Online Teaching"></a>
              </div>
              <div class="down-content">
                <div class="date">
                  <h6>Nov <span>24</span></h6>
                </div>
                <a href="meeting-details.html">
                  <h4>Bảo vệ an ninh - An toàn PCCC</h4>
                </a>
                <p>Công tác giữ gìn trật tự, an ninh an toàn cho tòa nhà là một trong những yếu tố vô cùng quan trọng
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="meeting-item">
              <div class="thumb">

                <a href="meeting-details.html"><img src="https://psa.vn/wp-content/uploads/2021/04/4.jpg"
                    alt="Higher Education"></a>
              </div>
              <div class="down-content">
                <div class="date">
                  <h6>Nov <span>26</span></h6>
                </div>
                <a href="meeting-details.html">
                  <h4>Lễ tân</h4>
                </a>
                <p>Nhân viên lễ tân là vị trí được tiếp xúc đầu tiên với tất cả các khách hàng đến liên hệ công tác tại
                  mỗi tòa nhà,</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="meeting-item">
              <div class="thumb">

                <a href="meeting-details.html"><img src="https://psa.vn/wp-content/uploads/2021/04/IMG_8242.jpg"
                    alt="Student Training"></a>


              </div>
              <div class="down-content">
                <div class="date">
                  <h6>Nov <span>30</span></h6>
                </div>
                <a href="meeting-details.html">
                  <h4>Thông báo qua điện thoại</h4>
                </a>
                <p>Thông báo các dịch vụ, hóa đơn ... qua tin nhắn điện thoại</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="apply-now" id="apply">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 align-self-center">
        <div class="row">
          <div class="col-lg-12">
            <div class="item">
              <h3>Chung cư thiếu nhà sinh hoạt cộng đồng, vườn hoa bị lấn chiếm</h3>
              <p>Tình trạng chung cư thiếu nhà sinh hoạt cộng đồng, vườn hoa bị lấn chiếm, công viên 20 năm chưa được
                thực hiện vì vướng giải phóng mặt bằng…</p>
              <div class="main-button-red">
                <div class="scroll-to-section"><a href="#contact">28/04/2022</a></div>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="item">
              <h3>Bộ Công Thương lưu ý về phí quản lý vận hành nhà chung cư</h3>
              <p>Trong điều khoản về việc thay đổi mức phí quản lý vận hành tại hợp đồng mua bán căn hộ chung cư, cần
                phải có quy định về việc thỏa thuận trước với người tiêu dùng trước khi áp dụng mức phí mới..</p>
              <div class="main-button-yellow">
                <div class="scroll-to-section"><a href="#contact">19/04/2022
                  </a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="accordions is-first-expanded">
          <article class="accordion">
            <div class="accordion-head">
              <span>Các tin tức nổi bật</span>

            </div>

          </article>
          <article class="accordion">
            <div class="accordion-head">
              <span>Hà Nội xử lý loạt cao ốc chưa nghiệm thu phòng cháy đã đưa vào sử dụng</span>

            </div>
            <div class="accordion-body">
              <div class="content">
                <p>UBND TP Hà Nội yêu cầu chủ đầu tư cam kết lộ trình, tiến độ, thời gian thực hiện, hoàn thành khắc
                  phục với từng tồn tại vi phạm về phòng cháy chữa cháy (PCCC).

                  UBND TP Hà Nội vừa có công văn gửi Công an TP Hà Nội và UBND các quận, huyện, thị xã về việc thực hiện
                  chỉ tiêu khắc phục tồn tại, xử lý vi phạm các công trình chưa được nghiệm thu về PCCC đã đưa vào hoạt
                  động năm 2022.</p>
              </div>
            </div>
          </article>
          <article class="accordion">
            <div class="accordion-head">
              <span>Sắp thanh tra hàng loạt chung cư, chủ đầu tư hết cửa ‘om’ quỹ bảo trì</span>
              <span class="icon">
              </span>
            </div>
            <div class="accordion-body">
              <div class="content">
                <p>Trong năm 2022, Bộ Xây dựng sẽ thanh tra chuyên đề diện rộng về công tác quản lý, sử dụng kinh phí
                  bảo trì phần sở hữu chung nhà chung cư tại 11 tỉnh, thành phố nhằm phát hiện, xử lý nghiêm các sai
                  phạm.
                </p>
              </div>
            </div>
          </article>
    
        </div>
      </div>
    </div>
  </div>
</section>



<section class="our-facts">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="row">
          <div class="col-lg-12">
            <h2>Giới thiệu</h2>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="col-12">
                <div class="count-area-content percentage">
                  <div class="count-digit">94</div>
                  <div class="count-title">Người dùng hài lòng</div>
                </div>
              </div>
              <div class="col-12">
                <div class="count-area-content">
                  <div class="count-digit">1226</div>
                  <div class="count-title">Tòa nhà sử dụng </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="col-12">
                <div class="count-area-content new-students">
                  <div class="count-digit">2345</div>
                  <div class="count-title">Cư dân sử dụng</div>
                </div>
              </div>
              <div class="col-12">
                <div class="count-area-content">
                  <div class="count-digit">32</div>
                  <div class="count-title">dịch vụ</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 align-self-center">
        <div class="video">
          <a href="https://www.youtube.com/watch?v=HndV87XpkWg" target="_blank"><img src="" alt=""></a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="contact-us" id="contact">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 align-self-center">
        <div class="row"> 
          <div class="col-lg-12">
            <form id="contact" action="{{route('feedbacks')}}" method="post">
              @csrf
              @if (Session::has('msg'))
                    <p class="text-danger">{{Session::get('msg')}}</p>
                @endif
              <div class="row">
                <div class="col-lg-12">
                  <h2>Phản hồi</h2>
                </div>
                <div class="col-lg-12">
                  <fieldset>
                    <input name="subject" type="text" id="subject" placeholder="Tiều đề" required="Nhập tiêu đề">
                  </fieldset>
                </div>
                <div class="col-lg-12">
                  <fieldset>
                    <textarea name="content" type="text" class="form-control" id="message" placeholder="Nội dung"
                      required="Nhập nội dung"></textarea>
                  </fieldset>
                </div>
                  <div class="col-lg-12">
                  <fieldset>
                    <button type="submit"  class="button">Gửi phản hồi</button>
                  </fieldset>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="right-info">
          <ul>
            <li>
              <h6>Số điện thoại</h6>
              <span>0871312313</span>
            </li>
            <li>
              <h6>Địa chỉ email</h6>
              <span>Apartment@gmail.com</span>
            </li>
            <li>
              <h6>Địa chỉ</h6>
              <span>123 Trần Duy Hưng - Hà Nội</span>
            </li>

          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    <p>Copyright © 2022 Apartment

    </p>
  </div>
</section>

@endsection