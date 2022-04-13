@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sửa thông tin phòng ban</h3>
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
                                    <label>Tên phòng ban</label>
                                    <input type="text" name="name" class="form-control" value="{{$department->name}}">
                                    @error('name')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Lương cơ bản</label>
                                    <input type="number" name="salary" class="form-control" value="{{$department->salary}}">
                                    @error('salary')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">Sửa</button>
                                <a href="{{route('department.index')}}" class="btn btn-primary">Quay lại</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
