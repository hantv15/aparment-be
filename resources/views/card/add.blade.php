<form action="" method="POST">
    @csrf
    <div>
        <label for="">Number</label>
        <input type="number" name="number">
    </div>
    <div>
        <label for="">Trạng thái</label>
        <select name="status" id="">
            <option value="">Chọn trạng thái</option>
            <option value="0">Chưa kich</option>
            <option value="1">Đã kích hoạt</option>
        </select>
    </div>
    <div>
        <label for="">Ngày hết hạn</label>
        <input type="datetime-local" name="expire_time">
    </div>

    <div>
        <label for="">Căn hộ</label>
        <select name="apartment_id" id="">
            @foreach ($apartments as $item)
                <option value="{{$item->id}}">{{$item->apartment_id}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <button type="submit">Thêm</button>
    </div>
</form>