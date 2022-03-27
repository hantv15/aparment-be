@extends('layouts.app')
@section('content')

<h6 class="mb-0 text-uppercase">Thêm dịch vụ</h6>
<hr>
<div class="card">
    <div class="card-body">
        <div class="p-4 border rounded">
            <form class="row g-3 needs-validation" novalidate="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Tên dịch vụ</label>
                    <input type="text" class="form-control" name="name" required="">
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Giá</label>
                    <input type="text" class="form-control" name="price" required="">
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Icon</label>
                    <input type="file" class="form-control" name="icon" required="">
                </div>

                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Trạng thái</label>
                    <select class="form-select discription" id="validationCustom04" required="">
                        <option >0</option>
                        <option >1</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea" class="form-label">Mô tả</label>
                    <textarea class="form-control is-invalid" name="description"
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