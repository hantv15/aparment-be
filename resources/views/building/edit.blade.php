<form action="" method="POST">
    @csrf
    <div>
        <label for="">Tên</label>
        <input type="text" name="name" value="{{$building->name}}">
    </div>
    <div>
        <button type="submit">Sửa</button>
    </div>
</form>
