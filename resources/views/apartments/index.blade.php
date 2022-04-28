@extends('layouts.app')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Căn hộ</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách căn hộ</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('apartment.add')}}" class="btn btn-success">Thêm căn hộ</a>
                &nbsp  &nbsp  &nbsp
                <a href="#" class="btn btn-primary">Cài đặt</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-header">
            <form method="GET"  action="" class="ms-auto position-relative>
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Từ khóa</label>
                            <input type="text" class="form-control" name="keyword" value="{{$searchData['keyword']}}" placeholder="Tìm kiếm căn hộ theo tên">
                        </div>
                        <div class="form-group">
                            <label for="">Tòa nhà</label>
                            <select name="building_id" class="form-control">
                                <option value="">Tất cả</option>
                                @foreach ($buildings as $item)
                                    <option @if($item->id == $searchData['building_id']) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Tên cột</label>
                            <select name="column_names" class="form-control">
                                @foreach ($column_names as $key => $item)
                                    <option  @if($key == $searchData['column_names']) selected @endif value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Sắp xếp theo</label>
                            <select name="order_by" class="form-control">
                                @foreach ($order_by as $key => $item)
                                    <option @if($key == $searchData['order_by']) selected @endif value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Kích cỡ trang</label>
                            <select name="page_size" id="" class="form-control">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for=""></label>
                            <div class="row d-flex">
                                <div class="col-6">
                                    <button class="btn btn-primary form-control" type="submit">Tìm kiếm</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-success form-control" type="submit">
                                        <a href="{{route('apartment.index')}}" class="text-white">Chọn lại</a>
                                    </button>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>
        <div class="card-body">
            <div class="d-flex align-items-center">
                @if (Session::has('message'))
                    <p class="text-danger">{{Session::get('message')}}</p>
                @endif
                <h5 class="mb-0">User Details</h5>
                </div>
            <div class="table-responsive mt-3">
                <table class="table align-middle">
                    <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>Tên căn hộ</th>
                        <th>Tòa nhà</th>
                        <th>Tầng</th>
                        <th>Trạng thái</th>
                        <th>Diện tích</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($apartments as $key =>$apartment)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    <img src="https://via.placeholder.com/110X110" class="rounded-circle" width="44" height="44" alt="">
                                    <div class="">
                                        <p class="mb-0">{{$apartment->apartment_id}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{$apartment->building->name}}</td>
                            <td>{{$apartment->floor}}</td>
                            <td>{{$apartment->status}}</td>
                            <td>{{$apartment->square_meters}}</td>
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <a href="{{route('apartment.detail', ['id' => $apartment->id])}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Views"><i class="bi bi-eye-fill"></i></a>
                                    <a href="{{route('apartment.edit', ['id' => $apartment->id])}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="paginate">
                    {{$apartments->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
