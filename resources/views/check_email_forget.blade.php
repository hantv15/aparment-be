<form action="">
    @csrf
    <div>
        <label for="">Vui Long click vao day de lay lai mat khau</label>
    </div>
    <a href="{{route('getPass',['customer'=>$customer->id,'token'=>$customer->token])}}">Dat lai mat khau</a>
</form>