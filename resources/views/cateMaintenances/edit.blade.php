@extends('layouts.app')
@section('content')

<h6 class="mb-0 text-uppercase">Sửa danh mục bảo trì</h6>
<hr>
<div class="card">
    <div class="card-body">
        <div class="p-4 border rounded">
            @if(Session::has('msg'))
            <p class="login-box-msg text-danger">{{Session::get('msg')}}</p>      
        @endif
            <form class="row g-3 needs-validation" novalidate="" method="POST" enctype="multipart/form-data">
                @csrf
           
           
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Tên</label>
                    <input type="text" class="form-control" value="{{$model->name}}"  name="name" required="" >
                </div>
             
                
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection