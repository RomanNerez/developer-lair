<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @stack('style')
</head>
<body>
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light px-0">
                <a class="navbar-brand" href="{{ route('home') }}">DEVELOP LAIR</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <div class="open-dropdown-hover">
                                <a class="nav-link" href="{{route('image')}}">Изображения</a>
                                <div class="dropdown-menu dropdown-hover">
                                    <a class="dropdown-item" href="{{ route('image-builder') }}">Конструктор изображений</a>
                                    <a class="dropdown-item" href="{{ route('image-compress') }}">Сжать изображение</a>
                                    <a class="dropdown-item" href="{{ route('image-resize') }}">Изменить размер изображения</a>
                                    <a class="dropdown-item" href="{{ route('image-crop') }}">Обрезать изображения</a>
                                    <a class="dropdown-item" href="{{ route('image-rotate') }}">Повернуть изображение</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="form-inline my-2 my-lg-0">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary my-2 my-sm-0">Вход</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-info my-2 ml-2 my-sm-0">Регистрация</a>
                </div>
            </nav>
        </div>
    </header>

    @yield('content')

    <footer>
        <div class="content container">
            <div class="top">
                <div class="logo-details">
                    <span class="logo_name">DEVELOP LAIR</span>
                </div>
{{--                <div class="media-icons">--}}
{{--                    <a href="#"><i class="fab fa-facebook-f"></i></a>--}}
{{--                    <a href="#"><i class="fab fa-twitter"></i></a>--}}
{{--                    <a href="#"><i class="fab fa-instagram"></i></a>--}}
{{--                    <a href="#"><i class="fab fa-linkedin-in"></i></a>--}}
{{--                    <a href="#"><i class="fab fa-youtube"></i></a>--}}
{{--                </div>--}}
            </div>
            <div class="row link-boxes">
                <div class="col-md-6 col-12">
                    <ul class="box">
                        <li class="link_name">Изображения</li>
                        <li><a href="{{ route('image-builder') }}">Конструктор изображений</a></li>
                        <li><a href="{{ route('image-compress') }}">Сжать изображение</a></li>
                        <li><a href="{{ route('image-resize') }}">Изменить размер изображения</a></li>
                        <li><a href="{{ route('image-crop') }}">Обрезать изображения</a></li>
                        <li><a href="{{ route('image-rotate') }}">Повернуть изображение</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-12">
                    <ul class="box input-box">
                        <li class="link_name">Подпишитесь на обновления</li>
                        <li><input type="text" placeholder="Введите свой Email"></li>
                        <li><input type="button" value="Подписаться"></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom-details">
            <div class="bottom_text container">
                <span class="copyright_text">Copyright © 2022 <a href="{{ route('home') }}">Develop lair - Онлайн инструменты</a>Все права защещины</span>
                <span class="policy_terms">
                    <a href="#">Privacy policy</a>
                    <a href="#">Terms & condition</a>
                </span>
            </div>
        </div>
    </footer>

    @yield('modals')

    <script src="{{asset('js/common.js')}}"></script>
    @stack('scripts')
</body>
</html>