<link rel="icon" href="{{asset('assets/images/favicon-32x32.png')}}" type="image/png" />
<!--plugins-->
<link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
<!-- Bootstrap CSS -->
<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet" />
<link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<!-- loader-->
<link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />
<!--Theme Styles-->
<link href="{{asset('assets/css/dark-theme.css')}}" rel="stylesheet" />
<link href="{{asset('assets/css/light-theme.css')}}" rel="stylesheet" />
<link href="{{asset('assets/css/semi-dark.css')}}" rel="stylesheet" />
<link href="{{asset('assets/css/header-colors.css')}}" rel="stylesheet" />

<div class="wrapper">

  <!--start content-->
  <main class="page-content ">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center">
      <div class="breadcrumb-title pe-3 text-white">
        <a href="{{route('home')}}">Trang chủ</a>
      </div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt text-white"></i></a>
            </li>
            <li class="breadcrumb-item active text-white" aria-current="page">Hồ sơ cá nhân</li>
          </ol>
        </nav>
      </div>

    </div>
    <!--end breadcrumb-->

    <div class="profile-cover bg-dark"></div>

    <div class="row">
      <div class="col-12 col-lg-8">
        <div class="card shadow-sm border-0">

          <div class="card">
            <div class="card-body">
              <ul class="nav nav-tabs nav-danger" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" data-bs-toggle="tab" href="#dangerhome" role="tab" aria-selected="true">
                    <div class="d-flex align-items-center">
                      <div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
                      </div>
                      <div class="tab-title">Hóa đơn chi tiết</div>
                    </div>
                  </a>
                </li>
       
              </ul>
              <div class="tab-content py-3">
                <div class="tab-pane fade show active" id="dangerhome" role="tabpanel">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap5">
                          <div class="row">
                            <div class="col-sm-12 col-md-6">
                              <div class="dt-buttons btn-group"> <button
                                  class="btn btn-outline-secondary buttons-copy buttons-html5" tabindex="0"
                                  aria-controls="example2" type="button"><span>Copy</span></button> <button
                                  class="btn btn-outline-secondary buttons-excel buttons-html5" tabindex="0"
                                  aria-controls="example2" type="button"><span>Excel</span></button> <button
                                  class="btn btn-outline-secondary buttons-pdf buttons-html5" tabindex="0"
                                  aria-controls="example2" type="button"><span>PDF</span></button> <button
                                  class="btn btn-outline-secondary buttons-print" tabindex="0" aria-controls="example2"
                                  type="button"><span>Print</span></button> </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                              <div id="example2_filter" class="dataTables_filte float-end"><input type="search"
                                  class="form-control form-control-sm" placeholder="search" aria-controls="example2">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <table id="example2" class="table table-striped table-bordered dataTable" role="grid"
                                aria-describedby="example2_info">
                                <thead>
                                  <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                      colspan="1" style="width: 104.683px;" aria-sort="ascending"
                                      aria-label="Name: activate to sort column descending">Số thứ tự</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                      colspan="1" style="width: 264.683px;" aria-sort="ascending"
                                      aria-label="Name: activate to sort column descending">Hóa đơn</th>
                           
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                      colspan="1" style="width: 264.683px;" aria-sort="ascending"
                                      aria-label="Name: activate to sort column descending">Dịch vụ</th>
                           
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                      style="width: 101.167px;" aria-label="Age: activate to sort column ascending">
                                      Số lượng
                                    </th>
                                  
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                      style="width: 193.05px;"
                                      aria-label="Start date: activate to sort column ascending">Tổng tiền</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($bill_details as $key =>$bill)
                                  <tr role="row" class="odd">
                                    <td class="sorting_1">{{++$key}}</td>
                                    <td>{{$bill->bill_name}}</td>
                                    <td>{{$bill->service_name}}</td>
                                    <td>{{$bill->quantity}}</td>
                                    <td>{{$bill->total_price}}</td>
                                  
                                  </tr>
                                  @endforeach

                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12 col-md-5">
                              <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1
                                to 10 of 57 entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                              <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                <ul class="pagination">
                                  <li class="paginate_button page-item previous disabled" id="example2_previous"><a
                                      href="#" aria-controls="example2" data-dt-idx="0" tabindex="0"
                                      class="page-link">Prev</a></li>
                                  <li class="paginate_button page-item active"><a href="#" aria-controls="example2"
                                      data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                  <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                      data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                  <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                      data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                  <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                      data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                  <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                      data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                  <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                      data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                  <li class="paginate_button page-item next" id="example2_next"><a href="#"
                                      aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="dangerprofile" role="tabpanel">
                  <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.
                    Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko
                    farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip
                    jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna
                    delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan
                    fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry
                    richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus
                    tattooed echo park.</p>
                </div>
                <div class="tab-pane fade" id="dangercontact" role="tabpanel">
                  <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo
                    retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft
                    beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy
                    irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free,
                    carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't
                    heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-4">
        <div class="card shadow-sm border-0 overflow-hidden">
          <div class="card-body">
            <div class="profile-avatar text-center">
              <img src="https://via.placeholder.com/110X110" class="rounded-circle shadow" width="120" height="120"
                alt="">
            </div>

            <div class="text-center mt-4">
              <h4 class="mb-1">{{Auth::user()->name}}</h4>
              <div class="mt-4"></div>
              <h6 class="mb-1">HR Manager - Codervent Technology</h6>
              <p class="mb-0 text-secondary">University of Information Technology</p>
            </div>
            <hr>
            <div class="text-start">
              <h5 class="">About</h5>
              <p class="mb-0">It is a long established fact that a reader will be distracted by the readable content of
                a page when looking at its layout. The point of using Lorem.
            </div>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-top">
              Followers
              <span class="badge bg-primary rounded-pill">95</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
              Following
              <span class="badge bg-primary rounded-pill">75</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
              Templates
              <span class="badge bg-primary rounded-pill">14</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!--end row-->

  </main>
  <!--end page main-->


  <!--start overlay-->
  <div class="overlay nav-toggle-icon"></div>
  <!--end overlay-->

  <!--Start Back To Top Button-->
  <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

</div>

<script src="{{asset('assets/js/jquery.min.js')}} "></script>
<script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}} "></script>
<script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/js/pace.min.js')}}"></script>
<script src="{{asset('assets/plugins/chartjs/js/Chart.min.js')}}"></script>
<script src="{{asset('assets/plugins/chartjs/js/Chart.extension.js')}}"></script>
<script src="{{asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
<!--app-->
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('assets/js/index.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>