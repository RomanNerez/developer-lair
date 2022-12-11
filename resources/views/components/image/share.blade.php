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
            @if(isset($shareFile))
            <div class="header-content">
                <h1>Скачать изображение</h1>
            </div>
            <a id="upload" href="/{{$shareFile->file_name}}" type="button" class="btn btn-primary btn-lg">Скачать тутачки</a>
            @else
                <div class="header-content">
                    <h1>Упс! Ничего не найдено</h1>
                </div>
            @endif
        </div>
    </div>
@endsection