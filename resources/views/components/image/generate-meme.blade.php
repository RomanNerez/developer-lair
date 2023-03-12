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
        .image-container .card {
            cursor: pointer;
        }
        .image-container .card.active {
            box-shadow: 0 0 10px 1px #b0ddff;
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
                <h1>Генерация мемов</h1>
            </div>
            <button id="upload" type="button" class="btn btn-primary btn-lg">Выбрать изображение</button>
            <input type="file" multiple id="upload_input" name="upload" accept="image/*" style="" />
            <button id="upload" type="button" class="btn btn-primary btn-lg">Выбрать шаблон</button>
        </div>
        <div class="wrap-container d-none">
            <div class="image-container">
                <div class="row" id="image-list"></div>
            </div>
            <div class="navbar-left">
                <div class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="width">Ширина</label>
                                <input type="number" class="form-control" name="width" id="width" data-action="width" value="0">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="height">Высота</label>
                                <input type="number" class="form-control" name="height" id="height" data-action="height" value="0">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" id="download">Скачать изображение</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/image/generate-meme.js?v='.time()) }}"></script>
@endpush