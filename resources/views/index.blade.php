<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @stack('style')
</head>
<body>
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light px-0">
                <a class="navbar-brand" href="#">DEVELOP LAIR</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link open-dropdown-hover" href="{{route('image')}}">
                                IMAGE
                            </a>
                            <div class="dropdown-menu dropdown-hover">
                                <a class="dropdown-item" href="#">Image Builder</a>
                                <a class="dropdown-item" href="#">Compress Image</a>
                                <a class="dropdown-item" href="#">Resize Image</a>
                                <a class="dropdown-item" href="#">Crop Image</a>
                                <a class="dropdown-item" href="#">Rotate Image</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>


    @yield('content')

    @yield('modals')

    @stack('scripts')
</body>
</html>