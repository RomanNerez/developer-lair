@extends('index')

@push('style')
    <style>
        body {
            background: #f3f0ec;
            color: #666666;
        }
        .container-box {
            height: 100vh;
            padding-top: 56px;
        }
        .select-file {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }
        .select-file button {
            padding: 24px 47px;
            font-size: 1.7em;
        }
        input[type="file"] {
            opacity: 0;
        }

        .wrap-container,
        .navbar-left,
        .image-container {
            height: 100%;
        }

        .wrap-container {
            display: flex;
        }
        .image-container {
            width: 100%;
            padding: 20px;
            overflow: auto;
        }
        .navbar-left {
            width: 350px;
            padding: 20px;
            background: #ffffff;
            display: flex;
            flex-direction: column;
        }
        .navbar-left .content {
            height: 100%;
        }
        .navbar-left .content button {
            width: 100%;
        }
        .navbar-left .content .input-group {
            margin-top: 40px;
        }
        .navbar-left .content .input-group input {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border-right-width: 0;
        }
        .image-container .card img {
            width: 286px;
            height: 286px;
            object-fit: contain;
        }
        .image-container .card .card-body p {
            font-size: 12px;
            cursor: pointer;
        }
        .image-container .card .action {
            position: absolute;
            top: 0;
            right: -30px;
            padding: 5px;
            display: flex;
            flex-direction: column;
            opacity: 1;
        }
        .image-container .card .action button {
            border-radius: 50%;
            padding: 0.25rem 0.35rem;
            font-size: 0.5rem;
            line-height: 1;
            margin-top: 3px;
        }
    </style>
@endpush

@section('content')
    <div class="container-box">
        <div class="select-file">
            <div class="header-content">
                <h1>Повернуть изображение</h1>
                <h2>Форматы изображений которые можно поворачивать: <b>PNG</b>, <b>JPG</b>, <b>GIF</b></h2>
            </div>
            <button id="upload" type="button" class="btn btn-primary btn-lg">Выбрать изображение</button>
            <input type="file" multiple id="upload_input" name="upload" accept="image/*" style="" />
        </div>
        <div class="wrap-container d-none">
            <div class="image-container">
                <div class="row" id="image-list"></div>
            </div>
            <div class="navbar-left">
                <div class="content">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-outline-secondary py-2" style="font-size: 25px" data-action="rotate-left">
                                <i class="fa fa-undo" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-outline-secondary py-2" style="font-size: 25px" data-action="rotate-right">
                                <i class="fa fa-repeat" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-outline-secondary py-2" style="font-size: 25px" data-action="portrait">
                                <svg width="24px" height="32px" viewBox="0 0 24 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-1208.000000, -509.000000)" fill="#161616" fill-rule="nonzero">
                                            <path d="M1211,512 L1211,538 L1229,538 L1229,512 L1211,512 Z M1210,509 L1230,509 C1231.10457,509 1232,509.895431 1232,511 L1232,539 C1232,540.104569 1231.10457,541 1230,541 L1210,541 C1208.89543,541 1208,540.104569 1208,539 L1208,511 C1208,509.895431 1208.89543,509 1210,509 Z" id="portrait"></path>
                                        </g>
                                    </g>
                                </svg>
                            </button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-outline-secondary py-2" style="font-size: 25px" data-action="album">
                                <svg width="32px" height="24px" viewBox="0 0 32 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-1335.000000, -513.000000)" fill="#969696" fill-rule="nonzero">
                                            <path d="M1338,534 L1364,534 L1364,516 L1338,516 L1338,534 Z M1335,535 L1335,515 C1335,513.895431 1335.89543,513 1337,513 L1365,513 C1366.10457,513 1367,513.895431 1367,515 L1367,535 C1367,536.104569 1366.10457,537 1365,537 L1337,537 C1335.89543,537 1335,536.104569 1335,535 Z" id="landscape"></path>
                                        </g>
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-outline-secondary py-2" data-action="reset">
                                Сбросить всё
                            </button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" id="download">Скачать изображение</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/image/rotate.js?v='.time()) }}"></script>
@endpush