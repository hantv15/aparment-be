{{-- @extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Thêm mới tòa nhà</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Tên tòa nhà</label>
                                    <input type="text" name="name" class="form-control" value="{{$bill->name}}">
                                    @error('name')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-danger">Sửa</button>
                                <a href="{{route('bill.index')}}" class="btn btn-primary">Quay lại</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
@extends('layouts.app')
@section('content')

<h6 class="mb-0 text-uppercase">Thêm hóa đơn</h6>
<hr>
<div class="card">
    <div class="card-body">
        <div class="p-4 border rounded">
            <form class="row g-3 needs-validation" novalidate="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Tên hóa đơn</label>
                    <input type="text" class="form-control" name="name" value="{{$bill->name}}">
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Số lượng</label>
                    <input type="text" class="form-control" name="name" value="{{$bill->amount}}">
              
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Số Fax</label>
                    <input type="text" class="form-control" name="name" value="{{$bill->fax}}">
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Ảnh</label>
                    <input type="file" class="form-control" name="name" value="{{$bill->image}}">
                    @error('image')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Trạng thái</label>
                    <select class="form-select discription" id="validationCustom04" required="">
                        <option >0</option>
                        <option >1</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Loại thanh toán</label>
                    <select class="form-select discription" id="validationCustom04" required="">
                        <option >0</option>
                        <option >1</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Phương thức thanh toán</label>
                    <select class="form-select discription" id="validationCustom04" required="">
                        <option >0</option>
                        <option >1</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Người nhận</label>
                    <input type="file" class="form-control" name="name" value="{{$bill->receiver_id}}">
                    @error('receiver_id')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="validationTextarea" class="form-label">Mô tả</label>
                    <textarea class="form-control is-invalid" name="note"
                        placeholder="Required example textarea" required="" style="height: 97px;"></textarea>
                </div>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Thêm</button>
                    <a href="{{route('bill.index')}}" class="btn btn-primary">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection