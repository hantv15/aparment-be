<form action="" method="POST">
    @csrf
    <div>
        <label for="">Email</label>
        <input type="email" name="email">
    </div>
    <div>
        <label for="">Pass</label>
        <input type="password" name="password">
    </div>
    <button type="submit">ok</button>
</form>