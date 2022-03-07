<form action="" method="POST">
    @csrf
    <div>
        <label for="">Tên loại phương tiện</label>
        <input type="text" name="name">
    </div>
    <div>
        <label for="">Giá</label>
        <input type="number" name="price">
    </div>
    <div>
        <button type="submit">Thêm</button>
    </div>
</form>
