<form action="" method="POST">
    @csrf
    <div>
        <label for="">Tên phòng</label>
        <input type="text" name="department_id" id="">
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