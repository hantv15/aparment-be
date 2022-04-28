@extends('layouts.app')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Quản trị viên</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm mới quản trị viên</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a  href="{{route('admin-technicians.index')}}" class="btn btn-success">Danh sách quản trị viên</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body">
            <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Thêm cư dân mới</h6>
                <hr/>
                <form class="row g-3" action="{{\Illuminate\Support\Facades\URL::current()}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-6">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" name="name" placeholder="Nguyễn Anh Tuấn">
                        @error('name')
                        <p class="alert-danger p-2 mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone_number" placeholder="0987654321">
                        @error('phone_number')
                        <p class="alert-danger p-2 mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Ngày sinh</label>
                        <input type="date" class="form-control" name="dob">
                        @error('dob')
                        <p class="alert-danger p-2 mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Số CMND/CCCD</label>
                        <input type="number" class="form-control" name="number_card" placeholder="187756789">
                        @error('number_card')
                        <p class="alert-danger p-2 mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="josnguyentuan@gmail.com">
                        @error('email')
                        <p class="alert-danger p-2 mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Vai trò</label>
                        <select name="role_id" class="form-select">
                            @foreach($roles as $role)
                                <option class="form-control" value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Ảnh đại diện</label>
                        <input type="file" class="form-control" name="avatar">
                        @error('avatar')
                        <p class="alert-danger p-2 mt-2">{{$message}}</p>
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
