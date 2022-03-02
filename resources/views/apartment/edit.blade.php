<form action="" method="POST">
    @csrf
    <div>
        <label for="">Tên phòng</label>
        <input type="text" name="apartment_id" value="{{$apartment->apartment_id}}">
    </div>
    <div>
        <label for="">Tầng</label>
        <input type="number" name="floor" value="{{$apartment->floor}}">
    </div>
    <div>
        <label for="">Trạng thái</label>
        <select name="status" id="">
            <option value="0" @if($apartment->status == 0) selected @endif>Chưa cho thuê</option>
            <option value="1" @if($apartment->status == 1) selected @endif>Đã cho thuê</option>
        </select>
    </div>
    <div>
        <label for="">Mô tả</label>
        <textarea name="description" id="" cols="30" rows="10">{{$apartment->description}}</textarea>
    </div>
    <div>
        <label for="">Diện tích</label>
        <input type="number" name="square_meters" value="{{$apartment->square_meters}}">
    </div>
    <div>
        <label for="">Loại phòng</label>
        <select name="type_apartment" id="">
            <option value="0" @if($apartment->type_apartment == 0) selected @endif>Không có ban công</option>
            <option value="1" @if($apartment->type_apartment == 1) selected @endif>Có ban công</option>
        </select>
    </div>
    <div>
        <label for="">Tòa</label>
        <select name="building_id" id="">
            @foreach ($buildings as $item)
                <option value="{{$item->id}}" @if($apartment->building_id == $item->id) selected @endif>{{$item->name}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <button type="submit">Sửa</button>
    </div>
</form>
