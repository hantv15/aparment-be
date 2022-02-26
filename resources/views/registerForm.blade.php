<form action="" method="POST">
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
        <label for="">Mật khẩu</label>
        <input type="password" name="password" id="">
    </div>
    <div>
        <label for="">Nhập lại mật khẩu</label>
        <input type="password" name="password_confirmation" id="">
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
        <label for="">CMND/CCCD</label>
        <input type="number" name="number_card">
    </div>
    <div>
        <button type="submit">Đăng ký</button>
    </div>
</form>