<form action="" method="POST">
    @csrf
    <div>
        <label for="">Tiêu đề</label>
        <input type="text" name="title">
    </div>
    <div>
        <label for="">Nội dung</label>
        <textarea name="content" cols="30" rows="5"></textarea>
    </div>
    <div>
        <button type="submit">Gửi</button>
    </div>
</form>
