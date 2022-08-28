@extends('index')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/image/image.css')}}">
@endpush

@section('content')
    <section class="section-header">
        <div class="container">
            <div class="content">
                <div>
                    <h1>Самые базовые инструменты для работы с изображениями</h1>
                    <p>Бесплатный онлайн редактор изображений где вы можете изменять изображения как вам угодно</p>
                    <a href="#offer" class="btn btn-light">Начать</a>
                </div>
            </div>
        </div>
    </section>
    <div class="mt-5"></div>
    <section class="section-offers" id="#offer">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col d-flex justify-content-center">
                    <div class="card">
                        <div class="circle">
                            <h2><i class="fa fa-picture-o" aria-hidden="true"></i></h2>
                        </div>
                        <div class="content">
                            <h4>Конструктор изображений</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                            <a href="{{ route('image-builder') }}">Перейти <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="card">
                        <div class="circle">
                            <h2><i class="fa fa-compress" aria-hidden="true"></i></h2>
                        </div>
                        <div class="content">
                            <h4>Сжать изображение</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                            <a href="{{ route('image-compress') }}">Перейти <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="card">
                        <div class="circle">
                            <h2><i class="fa fa-arrows-alt" aria-hidden="true"></i></h2>
                        </div>
                        <div class="content">
                            <h4>Изменить размер изображения</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                            <a href="{{ route('image-resize') }}">Перейти <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="card">
                        <div class="circle">
                            <h2><i class="fa fa-crop" aria-hidden="true"></i></h2>
                        </div>
                        <div class="content">
                            <h4>Обрезать изображение</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                            <a href="{{ route('image-crop') }}">Перейти <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="card">
                        <div class="circle">
                            <h2><i class="fa fa-repeat" aria-hidden="true"></i></h2>
                        </div>
                        <div class="content">
                            <h4>Повернуть изображение</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                            <a href="{{ route('image-rotate') }}">Перейти <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-footer">
        <div class="container">
            <div class="d-flex">
                <div>
                    <h2>Ваш надежный онлайн-редактор изображений, любимый пользователями по всему миру</h2>
                    <p>
                        Онлайн инструменты - это простое решение для редактирования изображений в Интернете. Получите доступ ко всем инструментам, которые вам нужны для улучшения ваших изображений, прямо из Интернета со 100% безопасностью
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection