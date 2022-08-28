@extends('index')

@push('style')
    <style>
        body {
            background: #f3f0ec;
            color: #666666;
        }
        .container-box {
            height: 100vh;
            padding-top: 100px;
        }
        .select-file {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }
    </style>
@endpush

@section('content')
    <div class="container-box">
        <div class="select-file">
            <div class="header-content">
                <h1>Сжать изображение</h1>
                <h2>Форматы изображений которыйе можно сжать: <b>PNG</b>, <b>JPG</b>, <b>GIF</b></h2>
            </div>
            <button type="button" class="btn btn-primary btn-lg">Выбрать изображение</button>
        </div>
    </div>
@endsection