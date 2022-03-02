<form action="" method="POST">
    @csrf
    <div>
        <label for="">Tên dịch vụ</label>
        <input type="text" name="name" value="{{$service->name}}">
    </div>
    <div>
        <label for="">Giá</label>
        <input type="number" name="price" value="{{$service->price}}">
    </div>
    <div>
        <label for="">Mô tả</label>
        <textarea name="description" cols="30" rows="5">{{$service->description}}</textarea>
    </div>
    <div>
        <button type="submit">Sửa</button>
    </div>
</form>
