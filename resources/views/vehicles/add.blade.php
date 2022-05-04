@extends('layouts.app')
@section('content')

<h6 class="mb-0 text-uppercase">Thêm thẻ xe</h6>
<hr>
<div class="card">
    <div class="card-body">
        <div class="p-4 border rounded">
            <form class="row g-3 needs-validation" novalidate="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Biển số xe</label>
                    <input type="text" class="form-control" name="plate_number" required="">
                    @error('plate_number')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Loại phuong tiện</label>
                    <select name="vehicle_type_id" class="form-select discription" id="">
                        <option value="">Chọn phương tiện</option>
                        @foreach ($vehicle_types as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('vehicle_type_id')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Trang thái</label>
                    <select name="status" class="form-select discription" id="">
                        
                        <option value="0">Kích hoạt</option>
                        <option value="1">Không kích hoạt</option>
                    </select>
                    
                </div>
               

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection