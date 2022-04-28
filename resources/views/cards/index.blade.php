@extends('layouts.app')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Card</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Card management</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a  href="{{route('card.add')}}" class="btn btn-success">Add card</a>
                &nbsp  &nbsp  &nbsp
                <a  href="#"  class="btn btn-primary">Settings</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0">User Card</h5>
                <form method="GET"  action="{{\Illuminate\Support\Facades\URL::current()}}" class="ms-auto position-relative d-flex">
                    <input class="form-control ps-5" type="text" name="keyword"  placeholder="search"> &nbsp;
                    <input type="submit" class="btn btn-primary"> &nbsp;
                </form>
            </div>
            <div class="table-responsive mt-3">
                <table class="table align-middle">
                    <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>Số thẻ</th>
                        <th>Tên chủ thẻ</th>
                        <th>trạng thái</th>
                        <th>Ngày hết hạn</th>
                        <th>Căn hộ</th>
                        <th></th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cards as $key =>$card)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    
                                    <div class="">
                                        <p class="mb-0">{{$card->number}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{$card->name}}</td>
                            <td>{{$card->status}}</td>
                            <td>{{$card->expire_time}}</td>
                            <td>{{$card->apartment->apartment_id}}</td>
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <!-- <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Views"><i class="bi bi-eye-fill"></i></a> -->
                                    <a href="{{route('card.edit',['id' => $card->id])}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i>Edit</a>
                                    <!-- <a href="{{route('card.remove',['id' => $card->id])}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i>Xóa</a> -->
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="paginate">
                  
                </div>
            </div>
        </div>
    </div>
@endsection
