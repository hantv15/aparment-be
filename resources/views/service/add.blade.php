<form action="" method="POST">
    @csrf
    <div>
        <label for="">Tên dịch vụ</label>
        <input type="text" name="name">
    </div>
    <div>
        <label for="">Giá</label>
        <input type="number" name="price">
    </div>
    <div>
        <label for="">Mô tả</label>
        <textarea name="description" cols="30" rows="5"></textarea>
    </div>
    <div>
        <button type="submit">Thêm</button>
    </div>
</form>
