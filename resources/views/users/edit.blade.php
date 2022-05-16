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
                    @error('email')
                        <p class="alert-danger p-2 mt-2">{{ $message }}</p>
                    @enderror
                    @error('phone_number')
                        <p class="alert-danger p-2 mt-2">{{ $message }}</p>
                    @enderror
                    @error('apartment_id')
                        <p class="alert-danger p-2 mt-2">{{ $message }}</p>
                    @enderror
                    @error('dob')
                        <p class="alert-danger p-2 mt-2">{{ $message }}</p>
                    @enderror
                    @error('name')
                        <p class="alert-danger p-2 mt-2">{{ $message }}</p>
                    @enderror
                    @error('number_card')
                        <p class="alert-danger p-2 mt-2">{{ $message }}</p>
                    @enderror
                    @error('dob')
                        <p class="alert-danger p-2 mt-2">{{ $message }}</p>
                    @enderror
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('user.index') }}" class="btn btn-success">Quay lại</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body">
            <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Thêm cư dân mới</h6>
                <hr />
                <form class="row g-3" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-6">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                        @error('name')
                            <p class="alert-danger p-2 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone_number"
                            value="{{ old('name', $user->phone_number) }}">
                        @error('phone_number')
                            <p class="alert-danger p-2 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Ngày sinh</label>
                        <input type="date" class="form-control" name="dob" value="{{ old('name', $user->dob) }}">
                        @error('dob')
                            <p class="alert-danger p-2 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Số CMND/CCCD</label>
                        <input type="text" class="form-control" name="number_card"
                            value="{{ old('name', $user->number_card) }}">
                        @error('number_card')
                            <p class="alert-danger p-2 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Số CMND/CCCD</label>
                        <input type="text" class="form-control" name="number_card"
                            value="{{ old('email', $user->email) }}">
                        @error('email')
                            <p class="alert-danger p-2 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Căn hộ</label>
                        <select name="apartment_id" class="form-select">
                            @foreach ($apartments as $apartment)
                                <option class="form-control" @if ($apartment->id == $user->apartment_id) selected @endif
                                    value="{{ $apartment->id }}">{{ $apartment->apartment_id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Ảnh đại diện</label>
                        <input type="file" class="form-control" name="avatar">
                        @error('avatar')
                            <p class="alert-danger p-2 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-4 m-auto mt-3">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
