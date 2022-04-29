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
                    <label for="validationCustom02" class="form-label">Hóa đơn</label>
                    <select name="bill_id" class="form-select discription" id="">
                        <option value="">Chọn hóa đơn</option>
                        @foreach ($bills as $item)
                            <option @if ($bill_detail->bill_id ==$item->id)
                                selected
                            @endif value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
             
               
             
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Dịch vụ</label>
                    <select name="service_id" class="form-select discription" id="">
                        <option value="">Chọn dịch vụ</option>
                        @foreach ($services as $item)
                            <option 
                              @if ($bill_detail->service_id ==$item->id)
                                selected
                            @endif
                            value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Số lượng</label>
                    <input type="text" class="form-control" value="{{$bill_detail->quantity}}" name="quantity" required="">
                </div>
               
              

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection