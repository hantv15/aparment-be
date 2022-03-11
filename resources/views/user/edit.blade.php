<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="">Email</label>
        <input type="email" name="email" id="" value="{{$user->email}}">
    </div>
    <div>
        <label for="">Phone</label>
        <input type="text" name="phone_number" id="" value="{{$user->phone_number}}">
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
        <img src="{{asset($user->avatar)}}" width="50px;">
    </div>
    <div>
        <label for="">Tên</label>
        <input type="text" name="name" value="{{$user->name}}">
    </div>
    <div>
        <label for="">Ngày sinh</label>
        <input type="date" name="dob">
    </div>
    <div>
        <button type="submit">Sửa</button>
    </div>
</form>
