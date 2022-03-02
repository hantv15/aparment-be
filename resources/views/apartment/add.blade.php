<form action="" method="POST">
    @csrf
    <div>
        <label for="">Tên phòng</label>
        <input type="text" name="apartment_id">
    </div>
    <div>
        <label for="">Tầng</label>
        <input type="number" name="floor">
    </div>
    <div>
        <label for="">Trạng thái</label>
        <select name="status" id="">
            <option value="">Chọn trạng thái</option>
            <option value="0">Chưa cho thuê</option>
            <option value="1">Đã cho thuê</option>
        </select>
    </div>
    <div>
        <label for="">Mô tả</label>
        <textarea name="description" id="" cols="30" rows="10"></textarea>
    </div>
    <div>
        <label for="">Diện tích</label>
        <input type="number" name="square_meters">
    </div>
    <div>
        <label for="">Loại phòng</label>
        <select name="type_apartment" id="">
            <option value="">Chọn loại phòng</option>
            <option value="0">Không có ban công</option>
            <option value="1">Có ban công</option>
        </select>
    </div>
    <div>
        <label for="">Tòa</label>
        <select name="building_id" id="">
            @foreach ($buildings as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <button type="submit">Thêm</button>
    </div>
</form>
