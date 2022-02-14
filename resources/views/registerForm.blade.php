<form action="" method="POST">
    @csrf
    <div>
        <label for="">Department ID</label>
        <input type="text" name="department_id" id="">
    </div>
    <div>
        <label for="">Pass</label>
        <input type="password" name="password" id="">
    </div>
    <div>
        <label for="">Nhập lại</label>
        <input type="password" name="password_confirmation" id="">
    </div>
    <div>
        <button type="submit">ok</button>
    </div>
</form>