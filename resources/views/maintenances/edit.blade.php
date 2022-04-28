@extends('layouts.app')
@section('content')

<h6 class="mb-0 text-uppercase">Xửa hạng mục bảo trì</h6>
<hr>
<div class="card">
    <div class="card-body">
        <div class="p-4 border rounded">
            <form class="row g-3 needs-validation" novalidate="" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Tiến độ</label>
                    <input type="number" class="form-control" name="progress" required="" placeholder="0" value="{{$model->progress}}">
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Xửa</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection