@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sửa thông tin căn hộ</h3>
                    @if (Session::has('message'))
                        <p class="text-danger">{{Session::get('message')}}</p>
                    @endif
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tên căn hộ</label>
                                    <input type="text" name="apartment_id" class="form-control" value="{{$apartment->apartment_id}}">
                                    @error('apartment_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tầng</label>
                                    <input type="number" name="floor" class="form-control" min="0" value="{{$apartment->floor}}">
                                    @error('floor')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select name="status" class="form-control">
                                        <option value="0" @if($apartment->status == 0) selected @endif>Phòng trống</option>
                                        <option value="1" @if($apartment->status == 1) selected @endif>Đã có người ở</option>
                                    </select>
                                    @error('status')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Diện tích</label>
                                    <input type="number" name="square_meters" class="form-control" min="0" value="{{$apartment->square_meters}}">
                                    @error('square_meters')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Loại phòng</label>
                                    <select name="type_apartment" class="form-control">
                                        <option value="0" @if($apartment->type_apartment == 0) selected @endif>Không có ban công</option>
                                        <option value="1" @if($apartment->type_apartment == 1) selected @endif>Có ban công</option>
                                    </select>
                                    @error('type_apartment')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tòa</label>
                                    <select name="building_id" class="form-control">
                                        @foreach($buildings as $building)
                                            <option value="{{$building->id}}" @if($apartment->building_id == $building->id) selected @endif>{{$building->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea name="description" class="form-control" rows="10">{{$apartment->description}}</textarea>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">Sửa</button>
                                <a href="{{route('apartment')}}" class="btn btn-primary">Quay lại</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
