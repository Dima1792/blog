<!DOCTYPE html>
<html lang="ru">
<head>
    @section('head')
        <meta charset="utf-8">
        <title>Высшая школа програмирования Толика</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @show
</head>
<body>
<header class="site-header">
    @section('header')
    <div class="container">
        <h1>T()|_i|{ SCHOOL</h1>
        <p>Учим програмированию даже самых несмышлех</p>
    </div>
    @show
</header>

<section class="features">
    @section('contents1')

    @show
</section>

<section class="advantages">
    @section('contents2')
        <h2>Что выделяет нас среди конкурентов?</h2>
        <ul class="advantages-list">
            <li>Самый лучший в мире преподаватель</li>
            <li>Возможность дистанционного обучения</li>
            <li>Внимание и чуткость</li>
            <li>Бесплатная гарантийнтия течение 10 лет</li>
        </ul>
    @show
</section>

<footer class="site-footer">
    @section('footer')
        <div class="container">
            <p>© ТМ, 2024</p>
            <p>Школа програмирования для всех</p>
        </div>
    @show
</footer>
</body>
</html>

