@extends('index')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/image/image-builder.css')}}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="mt-5"></div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light custom-navbar-up">
            <ul class="nav justify-content-center mr-auto">
                <li class="nav-item">
                    <div id="change-size" class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle mr-2"
                            type="button"
                            data-toggle="dropdown"
                            aria-expanded="false"
                            data-tooltip="true"
                            data-placement="top"
                            title="Change size"
                        >
                            <i class="fa fa-crop" aria-hidden="true"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" data-width="512" data-height="512">512x512</a>
                            <a class="dropdown-item" href="#" data-width="640" data-height="360">640x360</a>
                            <a class="dropdown-item" href="#" data-width="840" data-height="560">840x560</a>
                            <a class="dropdown-item" href="#" data-type="Custom">Default...</a>
                            <a class="dropdown-item" href="#" data-type="Custom">Custom...</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div id="add-element" class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle"
                            type="button"
                            data-toggle="dropdown"
                            aria-expanded="false"
                            data-tooltip="true"
                            data-placement="top"
                            title="Add element"
                        >
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" data-type="rect">Rect</a>
                            <a class="dropdown-item" href="#" data-type="circle">Circle</a>
                            <a class="dropdown-item" href="#" data-type="triangle">Triangle</a>
                            <a class="dropdown-item" href="#" data-type="text">Text</a>
                            <a class="dropdown-item" href="#" data-type="image">Image</a>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <button class="btn btn-primary btn-sm mr-2" id="preview-image"
                        data-tooltip="true"
                        data-placement="top"
                        title="Preview"
                    >
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-secondary btn-sm" style="width: 100%" id="generate"
                        data-tooltip="true"
                        data-placement="top"
                        title="Download"
                    >
                        <i class="fa fa-download" aria-hidden="true"></i>
                    </button>
                </li>
            </ul>
        </nav>
        <div class="mt-3"></div>
        <div class="d-flex justify-content-between">
            <div class="custom-navbar">
                <ul class="list-group list-group-flush d-none" id="list-object-clone">
                    <li class="list-group-item list-group-item-action d-flex justify-content-between">
                        <span class="title">Clone</span>
                        <div class="action">
                            <i class="fa fa-eye" data-action="visibility" aria-hidden="true"></i>
                            <i class="fa fa-unlock" data-action="block" aria-hidden="true"></i>
                            <i class="fa fa-trash-o" data-action="remove" aria-hidden="true"></i>
                        </div>
                    </li>
                </ul>
                <ul class="list-group list-group-flush" id="list-object"></ul>
            </div>
            <div class="area-canvas">
                <div class="area-canvas-container">
                    <canvas id="create-image"></canvas>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-center" >
                            <img id="preview" style="background-image: url('/images/bg.png'); background-repeat: repeat; border: 1px solid #000000"/>
                        </div>
                    </div>
                </div>
            </div>
            @include('components.image.inludes.builder.settings-navbar')
        </div>
        <div class="mt-5"></div>
    </div>
@endsection

@section('modals')
    <div class="modal fade" id="upload-image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Example file input</label>
                            <input type="file" class="form-control-file" id="image-file">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" data-action="add-image">
                        <span>Add Image</span>
                        <div class="spinner-border text-light spinner-border-sm d-none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('js/image/builder.js')}}"></script>
@endpush