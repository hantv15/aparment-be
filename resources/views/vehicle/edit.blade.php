<form action="" method="POST">
    @csrf
    <div>
        <label for="">Biển số xe</label>
        <input type="text" name="plate_number" value="{{$vehicle->plate_number}}">
    </div>

    <div>
        <label for="">Trạng thái</label>
        <input type="number" name="status" value="{{$vehicle->status}}">
    </div>
    <div>
        <button type="submit">Thêm</button>
    </div>
</form>
