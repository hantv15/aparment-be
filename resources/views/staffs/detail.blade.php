@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$staff->name}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <p>Email: {{$staff->email}}</p>
                        <p>Số điện thoại: {{$staff->phone_number}}</p>
                        <p>Ngày sinh: {{$staff->dob}}</p>
                        <p>Phòng ban: {{$staff->department->name}}</p>
                        <p>Lương cơ bản: {{number_format($staff->department->salary, 0, ',', '.')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
