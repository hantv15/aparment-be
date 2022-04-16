@extends('layouts.app')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Nhân viên</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách nhân viên</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('staff.add')}}" class="btn btn-success">Thêm nhân viên</a>
                &nbsp  &nbsp  &nbsp
                <a href="#" class="btn btn-primary">Cài đặt</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
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
                        <th>#</th>
                        <th>ID</th>
                        <th>Tên nhân viên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Ngày sinh</th>
                        <th>Phòng ban</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($staffs as $key =>$staff)
                        <tr>
                            <td>{{$key++}}</td>
                            <td>{{$staff->id}}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    @if (isset($staff->avatar))
                                        <img src="{{asset($staff->avatar)}}" class="rounded-circle" width="44" height="44" alt="">
                                    @else
                                        <img src="staffs/no_avatar.png" class="rounded-circle" width="44" height="44" alt="">
                                    @endif
                                    <div class="">
                                        <a href="{{route('staff.detail', ['id' => $staff->id])}}">{{$staff->name}}</a>
                                    </div>
                                </div>
                            </td>
                            <td>{{$staff->email}}</td>
                            <td>{{substr($staff->phone_number, 0, 4)}}.{{substr($staff->phone_number, 4, 3)}}.{{substr($staff->phone_number, 7, 3)}}</td>
                            <td>{{str_replace("-", "/", date("d-m-Y", strtotime($staff->dob)))}}</td>
                            <td><a href="{{route('department.detail', ['id' => $staff->department_id])}}">{{$staff->department->name}}</a></td>
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <a href="{{route('staff.detail', ['id' => $staff->id])}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Views"><i class="bi bi-eye-fill"></i></a>
                                    <a href="{{route('staff.edit', ['id' => $staff->id])}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="{{route('staff.remove', ['id' => $staff->id])}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="paginate">
                    {{$staffs->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection