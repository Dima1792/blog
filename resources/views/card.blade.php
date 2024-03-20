@extends('basa')
@section('contents1')
    <h2>Давайте узнаем какой курс валют сегоданя?</h2>
    <p>Я выведу курсы самых популярных валют:</p>
        <div>{{$articles}}</div>
    <form action='/article' method='post'>
        @csrf
        <p>Введите свое имя:</p>
        <input type="text" name="Author">
        <p>Введите название статью:</p>
        <input type="text" name="nameArticle">
        <p>Введите статью:</p>
        <input type="text" name="Article">
        <input type="submit" name="save">
    </form>
@endsection

