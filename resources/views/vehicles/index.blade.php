@extends('layouts.app')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Quản lý thẻ xe</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách Thẻ xe</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('vehicle.add')}}" class="btn btn-success">Thêm </a>
                &nbsp  &nbsp  &nbsp
                
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
                        
                        <th>Biển số xe</th>
                        <th>Loại xe</th>
                       <th>Căn hộ</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vehicles as $key =>$vehicle)
                        <tr>
                            <td>{{++$key}}</td>
                           
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                   
                                    <div class="">
                                        <p class="mb-0">{{$vehicle->plate_number}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{$vehicle->category->name}}
                            </td>
                            <td>
                                {{$vehicle->apartment->apartment_id}}
                            </td>
                            <td>
                                @if ($vehicle->status==0)
                                <p class="mb-0">Chưa kíc  hoạt</p>
                                @endif
                                @if ($vehicle->status==1)
                                <p class="mb-0">Đã kíc hoạt</p>
                                @endif
                            </td>
                            {{-- <td>{{count($department->staffs)}}</td> --}}
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <a href="{{route('vehicle.edit', ['id' => $vehicle->id])}}" class="text-warning" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                        <a href="{{route('vehicle.remove',['id'=>$vehicle->id  ])}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                                    {{-- <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="paginate">
                    {{-- {{$departments->links()}} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
