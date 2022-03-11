<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="">Email</label>
        <input type="email" name="email" id="">
    </div>
    <div>
        <label for="">Phone</label>
        <input type="text" name="phone_number" id="">
    </div>
    <div>
        <label for="">Phòng</label>
        <select name="apartment_id" id="">
        @foreach ($apartments as $item)
            <option value="{{$item->id}}">{{$item->apartment_id}}</option>
        @endforeach
        </select>
    </div>
    <div>
        <label for="">Avatar</label>
        <input type="file" name="avatar">
    </div>
    <div>
        <label for="">Tên</label>
        <input type="text" name="name">
    </div>
    <div>
        <label for="">Ngày sinh</label>
        <input type="date" name="dob">
    </div>
    <div>
        <button type="submit">Đăng ký</button>
    </div>
</form>
