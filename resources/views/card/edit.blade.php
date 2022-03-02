<form action="" method="POST">
    @csrf
    <div>
        <label for="">Number</label>
        <input type="number" name="number" value="{{$card->number}}">
    </div>
    <div>
        <label for="">Trạng thái</label>
        <select name="status" id="">
            <option value="0" @if($card->status == 0) selected @endif>Chưa kích hoạt</option>
            <option value="1" @if($card->status == 1) selected @endif>Đã kích hoạt</option>
        </select>
    </div>
    <div>
        <label for="">Ngày hết hạn</label>
        <input type="datetime-local" name="expire_time" value="{{$year}}-{{$month}}-{{$day}}T{{$hour}}:{{$minute}}">
    </div>

    <div>
        <label for="">Căn hộ</label>
        <select name="apartment_id" id="">
            @foreach ($apartments as $item)
                <option value="{{$item->id}}" @if($card->apartment_id == $item->id) selected @endif>{{$item->apartment_id}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <button type="submit">Sửa</button>
    </div>
</form>
