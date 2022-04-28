@extends('layouts.app')
@section('content')
<form action="" method="POST">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Dịch vụ</label>
                <select name="service_id" id="" class="form-control">
                    <option value="">Chọn dịch vụ</option>
                    @foreach ($services as $item)
                        <option value="{{$item->id}}">{{$item->name}} - {{$item->price}}</option>
                    @endforeach
                </select>
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif
                @error('service_id')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Hóa đơn</label>
                <select name="bill_id" id="" class="form-control" disabled>
                    <option value="">Chọn hóa đơn</option>
                    @foreach ($bills as $item)
                        <option value="{{$item->id}}"
                            @if ($item->id == $bill->id)
                                selected
                            @endif
                        >{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Số lượng</label>
                <input type="number" name="quantity" class="form-control">
                @error('quantity')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for=""></label>
                <div class="row">
                    <div class="col-4">
                        <button type="submit" class="btn btn-success form-control">Thêm</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</form>
@endsection