<form action="" method="POST">
    @csrf
    <div>
        <label for="">Tên</label>
        <input type="text" name="name" value="{{$card->name}}">
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
        <button type="submit">Sửa</button>
    </div>
</form>
