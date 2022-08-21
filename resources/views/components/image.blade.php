@extends('index')

@section('content')

    <style>
        .area-canvas {
            width: 100%;
            padding: 0 10px;
        }
        .area-canvas .area-canvas-container .canvas-container  {
            margin: 0 auto;
        }
        .area-canvas canvas {
            box-shadow: 0 0 2px 1px #c3c3c3;
        }
        .custom-navbar {
            border: 1px solid #000000;
            min-height: 800px;
            width: 300px;
        }
        #list-object li, #list-object-clone li {
            cursor: pointer;
        }
        #list-object li .action, #list-object-clone li .action {
            display: none;
        }
        #list-object li:hover .action, #list-object-clone li:hover .action {
            display: block;
        }
        #list-object li:hover .action i, #list-object-clone li:hover .action i {
            width: 15px;
            text-align: center;
        }
        #list-object li.active, #list-object-clone li.active {
            color: #000000;
            background-color: #007bff4a;
            border-color: #9acbff;
        }
    </style>

    <div class="container-fluid">
        <div class="mt-5"></div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="nav justify-content-center mr-auto">
                <li class="nav-item">
                    <div id="change-size" class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            Change size area
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
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            Add Element
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
                    <button class="btn btn-primary btn-sm" id="preview-image">Preview Image</button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-secondary btn-sm" style="width: 100%" id="generate">Generate Image</button>
                </li>
            </ul>
        </nav>
        <div class="mt-3"></div>
        <div class="d-flex">
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
                            <img id="preview" style="border: 1px solid #000000"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-navbar">
                <div class="pt-1">
                    <div id="info-data-element">
                        <div class="row mx-0 mt-1">
                            <div class="col">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="width">width</label>
                                        <input type="number" id="width" class="form-control" >
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="height" >height</label>
                                        <input type="number" id="height" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-0 mt-1">
                            <div class="col">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="x">x</label>
                                        <input type="number" id="x" class="form-control" >
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="y">y</label>
                                        <input type="number" id="y" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-0 mt-1">
                            <div class="col">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="angle">angle</label>
                                        <input type="number" id="angle" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-0 mt-1">
                            <div class="col">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="background">background</label>
                                        <input type="color" opacity rgba id="background" class="form-control" >
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="fill">fill</label>
                                        <input type="color" opacity rgba id="fill" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-0 mt-1" data-type="text">
                            <div class="col">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="line-height">line height</label>
                                        <input type="number" id="line-height" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="text-align">text align</label>
                                        <select id="text-align" class="form-control">
                                            <option value="left" selected>Left</option>
                                            <option value="center">Center</option>
                                            <option value="right">Right</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-row">
                                    <div class="form-group" style="width: 100%">
                                        <label for="font-family">font family</label>
                                        <select id="font-family" class="form-control">
                                            <option value="Roboto" selected>Roboto</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="{{asset('js/image.js')}}"></script>
@endpush