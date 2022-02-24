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
        <select name="department_id" id="">
        @foreach ($departments as $item)
            <option value="{{$item->id}}">{{$item->department_id}}</option>
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
        <button type="submit">Đăng ký</button>
    </div>
</form>