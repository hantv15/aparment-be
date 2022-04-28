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
                    <input type="text" class="form-control" name="name" required="">
                </div>
                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Trạng thái thanh toán</label>
                    <select class="form-select discription" name="status" id="validationCustom04" required="">
                        <option value="0">Chưa thanh toán</option>
                        <option value="1">Đã thanh toán</option>
                    </select>
                </div>
                {{-- <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Loại thanh toán</label>
                    <select class="form-select discription" id="validationCustom04" required="">
                        <option value="0">0</option>
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Phương thức thanh toán</label>
                    <select class="form-select discription" id="validationCustom04" required="">
                        <option value="0">0</option>
                        <option value="1">1</option>
                    </select>
                </div> --}}
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Ảnh</label>
                    <input type="file" class="form-control" name="image" required="">
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Số Fax</label>
                    <input type="text" class="form-control" name="fax" required="">
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Căn hộ</label>
                    <select name="apartment_id" class="form-select discription" id="">
                        <option value="">Chọn căn hộ</option>
                        @foreach ($apartments as $item)
                            <option value="{{$item->id}}">{{$item->apartment_id}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Người nhận</label>
                    <input type="text" class="form-control" name="receiver_id" >
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
                </div>
            </form>
        </div>
    </div>
</div>
@endsection