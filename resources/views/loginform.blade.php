<form action="" method="POST">
    @csrf
    <div>
        <label for="">Phòng</label>
        <input type="text" name="department_id">
    </div>
    <div>
        <label for="">Pass</label>
        <input type="password" name="password">
    </div>
    <button type="submit">ok</button>
</form>