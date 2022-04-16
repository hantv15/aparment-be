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
                    <label for="validationCustom02" class="form-label">Số lượng</label>
                    <input type="text" class="form-control" name="amount" required="">
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Số Fax</label>
                    <input type="text" class="form-control" name="fax" required="">
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Ảnh</label>
                    <input type="file" class="form-control" name="image" required="">
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