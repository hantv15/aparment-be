@extends('layouts.app')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Cư dân</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Quản lý cư dân</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('user.index') }}" class="btn btn-success">Danh sách cư dân</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body">
            <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Thêm cư dân mới</h6>
                <hr />
                <form class="row g-3" action="{{ \Illuminate\Support\Facades\URL::current() }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-6">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" name="name" placeholder="Nhập tên">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone_number" placeholder="Nhập số điện thoại">
                        @error('phone_number')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Ngày sinh</label>
                        <input type="date" class="form-control" name="dob">
                        @error('dob')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Số CMND/CCCD</label>
                        <input type="text" class="form-control" name="number_card" placeholder="Nhập số CMND/CCCD">
                        @error('number_card')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Nhập Email">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Căn hộ</label>
                        <select name="apartment_id" class="form-select">
                            <option value="">Chọn căn hộ</option>
                            @foreach ($apartments as $apartment)
                                <option class="form-control" value="{{ $apartment->id }}">
                                    {{ $apartment->apartment_id }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Ảnh đại diện</label>
                        <input type="file" class="form-control" name="avatar">
                        @error('avatar')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Xác nhận</button>
                        <a href="{{ route('user.index') }}" class="btn btn-primary">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
