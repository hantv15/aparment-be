<form action="" method="POST">
    @csrf
    <div>
        <label for="">Chọn dịch vụ</label>
        <select name="service_id" id="">
            @foreach ($services as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="">Chọn hóa đơn</label>
        <select name="bill_id" id="" disabled>
            <option value="{{$bill->id}}">{{$bill->name}}</option>
        </select>
    </div>
    <div>
        <label for="">Số lượng</label>
        <input type="number" name="quantity">
    </div>
    <div>
        <button type="submit">Thêm</button>
    </div>
</form>
