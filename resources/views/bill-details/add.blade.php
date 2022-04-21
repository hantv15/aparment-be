@extends('layouts.app')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Card</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Hóa đơn chi tiết</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            {{-- <a href="#" class="btn btn-primary">Settings</a> --}}
        </div>
    </div>
</div>
<!--end breadcrumb-->

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header py-3 bg-transparent">
                <h5 class="mb-0">Thêm mới</h5>
            </div>
            <div class="card-body">
                <div class="border p-3 rounded">
                    <form class="row g-3" action="" method="POST">
                         @csrf
                        <div class="col-12 col-md-6">
                        <label class="form-label">Dịch vụ</label>
                        <select class="form-select" name="service_id">
                            @foreach ($services as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        {{-- @error('service_id')
                            <span class="text-danger">{{$message}}</span>
                          @enderror --}}
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <label class="form-label">Căn hộ</label>
                            <select class="form-select" name="bill_id">
                                @foreach ($bills as $item)
                                <option value="{{$item->id}}">{{$item->name}}a</option>
                                @endforeach
                            </select>
                            {{-- @error('bill_id')
                                <span class="text-danger">{{$message}}</span>
                              @enderror --}}
                        </div>
                       
                        <div class="mb-3 col-6">
                            <label class="form-label">Số lượng</label>
                            <input type="number" name="quantity" class="form-control datepicker" value="{{old('quantity')}}"/>
                            {{-- @error('quantity')
                                <span class="text-danger">{{$message}}</span>
                              @enderror --}}
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary px-4" type="submit">Thêm mới </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end row-->
@endsection