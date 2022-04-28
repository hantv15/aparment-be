@extends('layouts.app')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Tòa nhà</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết hóa đơn</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{route('bill.add')}}" class="btn btn-success">Thêm hóa đơn</a>
            &nbsp  &nbsp  &nbsp
            <a href="#" class="btn btn-primary">Cài đặt</a>
        </div>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Thông tin hóa đơn {{$bill->name}}</h3>
        <p>Tổng tiền: {{number_format($bill->amount, 0, ',', '.')}} VNĐ</p>
        <p>Trạng thái: {{$bill->status == 1 ? "Đã thanh toán" : "Chưa thanh toán"}}</p>
    </div>
    <div class="card-body">
        <div class="d-flex align-items-center">
            @if (Session::has('message'))
                <p class="text-danger">{{Session::get('message')}}</p>
            @endif
            <form method="GET"  action="{{\Illuminate\Support\Facades\URL::current()}}" class="ms-auto position-relative d-flex">
                <input class="form-control ps-5" type="text" name="keyword" placeholder="search"> &nbsp
                <input type="submit" class="btn btn-primary"> &nbsp;
            </form>
        </div>
        <div class="table-responsive mt-3">
            <table class="table align-middle">
                <thead class="table-secondary">
                <tr>
                    <th>STT</th>
                    <th>Mã HĐCT</th>
                    <th>Số lượng</th>
                    <th>Dịch vụ</th>
                    <th>Đơn giá</th>
                    <th>Tiền dịch vụ</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bill_detail_by_bill_id as $key =>$item)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                <div class="">
                                    <p class="mb-0">{{$item->bill_detail_id}}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                <div class="">
                                    <p class="mb-0">{{$item->quantity}}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                <div class="">
                                    <p class="mb-0">{{$item->ten_dich_vu}}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                <div class="">
                                    <p class="mb-0">{{number_format($item->price, 0, ',', '.')}} VNĐ</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                <div class="">
                                    <p class="mb-0">{{number_format($item->total_price, 0, ',', '.')}} VNĐ</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                <a href="" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Views"><i class="bi bi-eye-fill"></i></a>
                                <a href="" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
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
