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
        <div class="card-body">
            <div class="d-flex align-items-center">
                @if (Session::has('message'))
                    <p class="text-danger">{{Session::get('message')}}</p>
                @endif
                <h5 class="mb-0">User Details</h5>
                <form method="GET"  action="{{\Illuminate\Support\Facades\URL::current()}}" class="ms-auto position-relative d-flex">
                    <input class="form-control ps-5" type="text" name="keyword" placeholder="search"> &nbsp;
                    <select name="building_id">
                        <option value="">Chọn tòa</option>
                        @foreach($buildings as $building)
                            <option value="{{$building->id}}">{{$building->name}}</option>
                        @endforeach
                    </select>
                    <input type="submit" class="btn btn-primary"> &nbsp;
                </form>
            </div>
            <div class="table-responsive mt-3">
                <table class="table align-middle">
                    <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Date of birth</th>
                        <th>Apartment</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($apartments as $key =>$apartment)
                        <tr>
                            <td>{{$key++}}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    <img src="https://via.placeholder.com/110X110" class="rounded-circle" width="44" height="44" alt="">
                                    <div class="">
                                        <p class="mb-0">{{$apartment->apartment_id}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{$apartment->building_id}}</td>
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
