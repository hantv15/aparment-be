<script type="text/javascript">
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sửa thông tin nhân viên</h3>
                    @if (Session::has('message'))
                        <p class="text-danger">{{Session::get('message')}}</p>
                    @endif
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Tên nhân viên</label>
                                    <input type="text" name="name" class="form-control" value="{{$staff->name}}">
                                    @error('name')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Ảnh</label>
                                    <input type="file" accept="image/*" id="file" onchange="loadFile(event)" name="avatar" class="form-control">
                                    @if (isset($staff->avatar))
                                        <img src="{{asset($staff->avatar)}}" id="output" class="mt-2 rounded-circle form-control" />
                                    @else
                                        <img id="output" class="mt-2 rounded-circle" width="100%" />
                                    @endif
                                    @error('image')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{$staff->email}}">
                                    @error('email')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" name="phone_number" class="form-control" value="{{$staff->phone_number}}">
                                    @error('phone_number')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Ngày sinh</label>
                                    <input type="date" name="dob" class="form-control" value="{{$year}}-{{$month}}-{{$day}}">
                                    @error('dob')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Phòng ban</label>
                                    <select name="department_id" class="form-control">
                                        @foreach($departments as $item)
                                            <option value="{{$item->id}}" @if ($item->id == $staff->department_id) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">Sửa</button>
                                <a href="{{route('staff.index')}}" class="btn btn-primary">Quay lại</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection