@extends('index')

@section('content')
    <style>
        .field-item input {
            display: inline-block;
            width: auto;
        }
    </style>
    <div class="container">
        <div class="my-3">
            <div class="alert alert-secondary" role="alert">
                Нужны фиктивные данные для тестирования вашего приложения? Данный раздел позволяет создавать до 1000 строк реалистичных тестовых данных в форматах CSV, JSON, SQL и Excel.
            </div>
        </div>
        <div class="my-3">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-2">
                    Field Name
                </div>
                <div class="col-2">
                    Type
                </div>
                <div class="col-3">
                    Options
                </div>
            </div>
            <div class="field-item">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                <input class="form-control" type="text">
                <input class="form-control" type="text">
                <label>blank:</label>
                <input class="form-control" type="text">
            </div>
        </div>
    </div>
@endsection