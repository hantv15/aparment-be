@extends('layouts.app')
@section('content')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Quản trị viên</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Xửa quản trị viên</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a  href="{{route('admin-technicians.index')}}" class="btn btn-success">Thông tin </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body">
            <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Xửa</h6>
                <hr/>
                <form class="row g-3" action="{{\Illuminate\Support\Facades\URL::current()}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-6">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" name="name" value="{{$model->name}}" placeholder="Nguyễn Anh Tuấn">
                        @error('name')
                        <p class="alert-danger p-2 mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" value="{{$model->phone_number}}" name="phone_number" placeholder="0987654321">
                        @error('phone_number')
                        <p class="alert-danger p-2 mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Ngày sinh</label>
                        <input type="date" class="form-control" value="{{$model->dob}}" name="dob">
                        @error('dob')
                        <p class="alert-danger p-2 mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Số CMND/CCCD</label>
                        <input type="text" id="number_card" class="form-control" value="{{$model->number_card}}" name="number_card" placeholder="187756789">
                        @error('number_card')
                        <p class="alert-danger p-2 mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" value="{{$model->email}}" name="email" placeholder="josnguyentuan@gmail.com">
                        @error('email')
                        <p class="alert-danger p-2 mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Vai trò</label>
                        <select name="role_id" class="form-select">
                            @foreach($roles as $role)
                                <option class="form-control"  @if($role->id == $model->role_id) selected @endif value="{{$role->id}}" ">{{$role->name}}</option>
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
