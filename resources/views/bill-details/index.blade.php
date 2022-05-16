@extends('layouts.app')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Hóa Đơn chi tiết</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('bill-detail.add')}}" class="btn btn-success">Thêm hóa đơn chi tiết</a>
                &nbsp  &nbsp  &nbsp
                {{-- <a href="#" class="btn btn-primary">Cài đặt</a> --}}
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            @if (Session::has('message'))
            <p class="text-success">{{Session::get('message')}}</p>
        @endif
            <div class="d-flex align-items-center">
               
                <h5 class="mb-0">Danh sách hóa đơn</h5>
                <form method="GET"  action="{{\Illuminate\Support\Facades\URL::current()}}" class="ms-auto position-relative d-flex">
                    <input class="form-control ps-5" type="text" name="keyword" placeholder="search"> &nbsp
                    <input type="submit" class="btn btn-primary"> &nbsp;
                </form>
            </div>
            <div class="table-responsive mt-3">
                <table class="table align-middle">
                    <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>Dịch vụ</th>
                        <th>Hóa đơn</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                       
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bill_details as $key =>$bill)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    <div class="">
                                        <p class="mb-0">{{$bill->service->name}}</p>
                                    </div>
                                </div>
                            </td>
                            
                            
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    <div class="">
                                        <p class="mb-0">{{$bill->bill->name}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    <div class="">
                                        <p class="mb-0">{{$bill->quantity}}</p>
                                    </div>
                                </div>
                            </td>
                           
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    <div class="">
                                        <p class="mb-0">{{number_format($bill->total_price)}} VND</p>
                                    </div>
                                </div>
                            </td>
                            
                            
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    
                                    <a href="{{route('bill-detail.edit', ['id' => $bill->id])}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                    {{-- <a href="{{route('bill-detail', ['id' => $bill->id])}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
              
            </div>
        </div>
    </div>
@endsection
