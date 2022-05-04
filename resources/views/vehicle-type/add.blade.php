@extends('layouts.app')
@section('content')

<h6 class="mb-0 text-uppercase">Thêm Phương tiện</h6>
<hr>
<div class="card">
    <div class="card-body">
        <div class="p-4 border rounded">
            <form class="row g-3 needs-validation" novalidate="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Tên Phương tiện</label>
                    <input type="text" class="form-control" name="name" required="">
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Giá</label>
                    <input type="text" class="form-control" name="price" required="">
                    @error('price')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
               

                
               

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection