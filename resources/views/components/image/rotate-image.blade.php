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
            opacity: 0;
        }
        .image-container .card:hover .action {
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
            <input type="file" multiple id="upload_input" name="upload" style="" />
        </div>
        <div class="wrap-container d-none">
            <div class="image-container">
                <div class="row" id="image-list"></div>
            </div>
            <div class="navbar-left">
                <div class="content">
                    <button type="button" class="btn btn-primary">Повернуть на 90</button>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="number" class="form-control" placeholder="Угол" value="0" required>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">Повернуть</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary">Скачать изображение</button>
            </div>
        </div>
    </div>
    <div class="col mb-3 d-none" id="clone-card">
        <div class="card" style="width: 18rem;">
            <img src="">
            <div class="card-body">
                <p>2022-08-21-15-04-53_f51621a3-21a5-4ad1-81cb-2df77be2236f.png</p>
                <div class="input-group d-none">
                    <input type="text" class="form-control" placeholder="Название файла" required value="2022-08-21-15-04-53_f51621a3-21a5-4ad1-81cb-2df77be2236f.png">
                </div>
            </div>
            <div class="action">
                <button type="button" class="btn btn-outline-secondary btn-sm rotate-right">
                    <i class="fa fa-undo" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary btn-sm rotate-left">
                    <i class="fa fa-repeat" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-outline-danger btn-sm delete-card">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/image/rotate.js?v='.time()) }}"></script>
@endpush