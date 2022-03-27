@extends('layouts.app')
@section('content')
<div class="email-read-box p-3 ps ps--active-y">
    <h4>{{$feedback->subject}}</h4>
    <hr>
    <h5>Nội dung phản hồi:</h5>
    <div class="email-read-content px-md-5 py-5">
      <p>{{$feedback->content}}</p>
      
      <hr>
      
  <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 530px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 408px;"></div></div></div>
  <p style="text-align: right">Việt nam: {{$feedback->created_at}}</p>
  @endsection