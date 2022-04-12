@extends('layouts.app')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tòa nhà</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách tòa nhà</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('bill.add')}}" class="btn btn-success">Thêm tòa nhà</a>
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
                <h5 class="mb-0">User Details</h5>
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
                        <th>Tên tòa nhà</th>
                        <th>Số lượng căn hộ</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bills as $key =>$bill)
                        <tr>
                            <td>{{$key++}}</td>
                            <td>{{$bill->id}}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    <img src="https://via.placeholder.com/110X110" class="rounded-circle" width="44" height="44" alt="">
                                    <div class="">
                                        <p class="mb-0">{{$bill->name}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{count($bill->apartments)}}</td>
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <a href="{{route('building.detail', ['id' => $bill->id])}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Views"><i class="bi bi-eye-fill"></i></a>
                                    <a href="{{route('building.edit', ['id' => $bill->id])}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
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
