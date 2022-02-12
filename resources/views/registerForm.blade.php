<form action="" method="POST">
    @csrf
    <div>
        <label for="">Username</label>
        <input type="text" name="user_name" id="">
    </div>
    <div>
        <label for="">Email</label>
        <input type="email" name="email" id="">
    </div>
    <div>
        <label for="">Password</label>
        <input type="password" name="password">
    </div>
    <div>
        <label for="">Nhập lại Password</label>
        <input type="password" name="password_confirmation">
    </div>
    <button type="submit">Đăng ký</button>
</form>