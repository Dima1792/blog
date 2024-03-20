@extends('basa')
@section('contents1')
<h2>Давайте узнаем какой курс валют сегодня</h2>
<p>Я выведу курсы самых популярных валют:</p>
@foreach($result as $current=>$value)
<div> {{$current . ' = ' . $value}}</div>
@endforeach
<form action='/test' method='post'>
    @csrf
    <input type="text" name="currency">
    <input type="submit" name="save" VALUE="Узнать курс" >
</form>
<p>Здесь вы можите ввести название валюты курс которой хотите узнать</p>
@endsection
@section('contents2')
<h2>Может уже опублекуем статью</h2>
<form action='/article'  method='post'>
    @csrf
    <input type="submit" name="save" VALUE="Перейти на форму написания статьи" >
</form>
@endsection
