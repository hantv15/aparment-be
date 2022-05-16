@extends('layouts.app')
@section('content')

<h6 class="mb-0 text-uppercase">Xửa Phương tiện</h6>
<hr>
<div class="card">
    <div class="card-body">
        <div class="p-4 border rounded">
            <form class="row g-3 needs-validation" novalidate="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Tên Phương tiện</label>
                    <input type="text" class="form-control" value="{{$model->name}}" name="name" required="">
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Giá</label>
                    <input type="number" class="form-control" value="{{$model->price}}" name="price" required="">
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Số lượng tối đa</label>
                    <input type="number" class="form-control" value="{{$model->sl}}" name="sl" required="">
                </div>

                
               

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection