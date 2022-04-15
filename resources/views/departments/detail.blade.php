@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$department->name}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <p>Lương cơ bản: {{number_format($department->salary, 0, ',', '.')}} VNĐ</p>
                        <p>Số lượng nhân viên: </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
