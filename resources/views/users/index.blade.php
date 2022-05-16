@extends('layouts.app')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Cư dân</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Quản trị cư dân</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a  href="{{route('user.register')}}" class="btn btn-success">Thêm cư dân mới</a>
                &nbsp  &nbsp  &nbsp
                <a  href="#"  class="btn btn-primary">Thêm từ file excel</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0">Danh sách cư dân</h5>
                <form method="GET"  action="{{\Illuminate\Support\Facades\URL::current()}}" class="ms-auto position-relative d-flex">
                    <input class="form-control ps-5" type="text" name="keyword"  placeholder="search"> &nbsp;
                    <input type="submit" class="btn btn-primary"> &nbsp;
                </form>
            </div>
            <div class="table-responsive mt-3">
                <table class="table align-middle">
                    <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ email</th>
                        <th>Ngày sinh</th>
                        <th>Căn hộ</th>
                        <th>Tùy chỉnh</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key =>$user)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    <img src="https://via.placeholder.com/110X110" class="rounded-circle" width="44" height="44" alt="">
                                    <div class="">
                                        <p class="mb-0">{{$user->name}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{$user->phone_number}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->dob}}</td>
                            <td>{{$array_building[$user->apartment_id]}}</td>
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Views"><i class="bi bi-eye-fill"></i></a>
                                    <a href="{{route('user.edit', ['id' => $user->id])}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="paginate">
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
