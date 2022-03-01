<form action="" method="POST">
    @csrf
    <div>
        <label for="">Tên hóa đơn</label>
        <input type="text" name="name">
    </div>
    <div>
        <label for="">Chọn căn hộ</label>
        <select name="apartment_id" id="">
            @foreach ($apartments as $item)
                <option value="{{$item->id}}">{{$item->apartment_id}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="">Ghi chú</label>
        <textarea name="notes" cols="30" rows="5"></textarea>
    </div>
    <div>
        <button type="submit">Thêm</button>
    </div>
</form>
