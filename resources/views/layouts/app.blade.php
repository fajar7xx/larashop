<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Larashop @yield('title')</title>

    <link rel="stylesheet" href="{{asset('public/polished/polished.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/polished/iconic/css/open-iconic-bootstrap.min.css')}}">
    
    <style>
        .grid-highlight{
            padding-top: 1rem;
            padding-bottom: 1rem;
            background-color: #5c6ac4;
            border: 1px solid #202e78;
            color: #fff;
        }
        hr{
            margin: 6rem 0;
        }
        hr+.display-3,
        hr+.display-2+.display-3{
            margin-bottom: 2rem;
        }
    </style>
    <script type="text/javascript">
        document.documentElement.className = document.documentElement.className.replace('no-js', 'js') + (document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1") ? ' svg' : ' no-svg');
      </script>
</head>
<body>
    <nav class="navbar navbar-expand p-0">
        <a href="index.html" class="navbar-brand text-center col-xs-12 col-md-3 col-lg-2 mr-0">Larashop</a>
        <button class="btn btn-link d-block d-md-none" data-toggle="collapse" data-target="#slider-nav" role="button">
            <span class="oi oi-menu"></span>
        </button>
    </nav>

    <div class="container-fluid h-100 p-0">
        <div class="flex-row d-flex align-items-stretch m-0" style="min-height: 100%;">
            <div class="col-lg-12 col-md-12 p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{asset('node_modules/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('node_modules/popper.js/dist/popper.min.js')}}"></script>
    <script src="{{asset('node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
</body>
</html>