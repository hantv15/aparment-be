@extends('layouts.app')
@section('content')

<h6 class="mb-0 text-uppercase">Thêm hóa đơn</h6>
<hr>
<div class="card">
    <div class="card-body">
        @if(Session::has('msg'))
        <p class="login-box-msg text-danger">{{Session::get('msg')}}</p>      
    @endif
        <div class="p-4 border rounded">
            
            <form class="row g-3 needs-validation" novalidate="" method="POST" enctype="multipart/form-data">

                @csrf
              
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Hóa đơn</label>
                    <select name="bill_id" class="form-select discription" id="">
                        <option value="">Chọn hóa đơn</option>
                        @foreach ($bills as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('bill_id')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                </div>
             
               
             
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Dịch vụ</label>
                    <select name="service_id" class="form-select discription" id="">
                        <option value="">Chọn dịch vụ</option>
                        @foreach ($services as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Số lượng</label>
                    <input type="text" class="form-control" name="quantity" required="">
                </div>
               
              

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection