@extends('layouts.app')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">User</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Dịch vụ</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{route('maintenance.add')}}" class="btn btn-success">Thêm hạng mục bảo trì</a>
            &nbsp &nbsp &nbsp
            <a href="#" class="btn btn-primary">Settings</a>
        </div>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <h5 class="mb-0">Dịch vụ</h5>
            <form method="GET" action="{{\Illuminate\Support\Facades\URL::current()}}"
                class="ms-auto position-relative d-flex">
                <input class="form-control ps-5" type="text" name="keyword" placeholder="search"> &nbsp;
                <input type="submit" class="btn btn-primary"> &nbsp;
            </form>
        </div>
        <div class="table-responsive mt-3">
            <table class="table align-middle">
                <thead class="table-secondary">
                    <tr>
                        <th>STT</th>
                        <th>Hạng mục</th>
                        <th>Tiến độ</th>

                      
                    </tr>
                </thead>
                <tbody>
                    @foreach($model as $key =>$item)
                    
                    <tr class="tr_color">
                        <td>{{$key++}}</td>
                        
                        <td <?php $style?>>{{$item->category->name}}</td>
                        
                        <td >
                        {{$item->progress}} %</td>
                        <td>
                            <div class="table-actions d-flex align-items-center gap-3 fs-6">
                        
                                {{-- <a href="{{route('service.edit', ['id' => $service->id])}}" class="text-warning" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                 --}}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="paginate">
                {{-- {{$services->links()}} --}}
            </div>
        </div>
    </div>
</div>

@endsection