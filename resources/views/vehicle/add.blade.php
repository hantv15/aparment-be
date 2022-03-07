<form action="" method="POST">
    @csrf
    <div>
        <label for="">Biển số xe</label>
        <input type="text" name="plate_number">
    </div>
    <div>
        <label for="">Chọn loại phương tiện</label>
        <select name="vehicle_type_id" id="">
            @foreach ($vehicle_types as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="">Chọn thẻ</label>
        <select name="card_id" id="">
            @foreach ($cards as $item)
                <option value="{{$item->id}}">{{$item->number}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <button type="submit">Thêm</button>
    </div>
</form>
