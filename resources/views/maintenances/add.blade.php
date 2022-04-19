@extends('layouts.app')
@section('content')

<h6 class="mb-0 text-uppercase">Thêm hạng mục bảo trì</h6>
<hr>
<div class="card">
    <div class="card-body">
        <div class="p-4 border rounded">
            <form class="row g-3 needs-validation" novalidate="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">hạng mục</label>
                    <select class="form-select discription" id="validationCustom04" required="" name="maintenance_id">
                        @foreach ($categories as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Tiến độ</label>
                    <input type="number" class="form-control" name="progress" required="" placeholder="0">
                </div>




                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection