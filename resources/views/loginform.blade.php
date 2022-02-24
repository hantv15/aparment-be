<form action="" method="POST">
    @csrf
    <div>
        <label for="">Nhập SĐT hoặc Email</label>
        <input type="text" name="username">
    </div>
    <div>
        <label for="">Password</label>
        <input type="password" name="password">
    </div>
    <button type="submit">ok</button>
</form>