@extends('layouts.app')
@section('content')

<h6 class="mb-0 text-uppercase">Thêm hạng mục bảo trì</h6>
<hr>
<div class="card">
    <div class="card-body">
        <div class="p-4 border rounded">
            @if(Session::has('msg'))
            <p class="login-box-msg text-danger">{{Session::get('msg')}}</p>      
        @endif
            <form class="row g-3 needs-validation" novalidate="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Hạng mục</label>
                    <select class="form-select discription" id="validationCustom04" required="" name="maintenance_id">
                        @foreach ($categories as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Tòa</label>
                    <select class="form-select discription" id="validationCustom04" required="" name="building_id">
                        @foreach ($buildings as $bui)
                            <option value="{{$bui->id}}">{{$bui->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Tiến độ</label>
                    <input type="number" class="form-control" id="progress" name="progress" required="" placeholder="0">
                </div>
                <div class="mb-3">
                    <label for="customRange1" class="form-label">Example range</label>
                    <input type="range" class="form-range" id="customRange1" min="0" max="100"
                    onchange="myFunction()"
                    >
                </div>
                
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function myFunction() {
        var ele = document.getElementById('customRange1').value;
        document.getElementById('progress').value =  ele;

       
}
</script>
@endsection