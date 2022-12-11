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
        .crop-container {
            width: 100%;
            padding: 20px;
            overflow: auto;
        }

        .crop-container .image-container {
            max-width: 600px;
            height: 100%;
            margin: 0 auto;
        }

        .crop-container .image-container .image,
        .crop-container .image-container img {
            max-width: 100%;
            max-height: 100%;
            margin: 0 auto;
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
            <div class="w-100" style="overflow-y: auto">
                <div class="crop-container">
                    <div class="image-container">
                        <div class="image">
                            <img src="">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="splide" role="group" aria-label="Splide Basic HTML Example">
                                <div class="splide__track">
                                    <ul class="splide__list"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-left">
                <div id="control-navbar" class="content">
                    <div class="form-row">
                        <div class="col-12">
                            <label for="width">Width</label>
                            <input type="number" class="form-control" name="width" id="width" data-action="width">
                        </div>
                        <div class="col-12">
                            <label for="height">Height</label>
                            <input type="number" class="form-control" name="height" id="height" data-action="height">
                        </div>
                        <div class="col-12">
                            <label for="left">X</label>
                            <input type="number" class="form-control" name="left" id="left" data-action="left">
                        </div>
                        <div class="col-12">
                            <label for="top">Y</label>
                            <input type="number" class="form-control" name="top" id="top" data-action="top">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" id="download">Скачать изображение</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/image/crop.js?v='.time()) }}"></script>
@endpush