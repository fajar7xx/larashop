<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Larashop @yield('title')</title>

    <link rel="stylesheet" href="{{asset('public/polished/polished.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/polished/iconic/css/open-iconic-bootstrap.min.css')}}">

    @yield('header-script')
    
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

        <input type="text" class="border-dark bg-primary-darkest form-control d-none d-md-block w-50 ml-3 mr-2" placeholder="Search" aria-label="Search"/>
        <div class="dropdown d-none d-md-block">
            @if(\Auth::user())
                <button class="btn btn-link btn-link-primary dropdown-toggle" id="navbar-dropdown" data-toggle="dropdown">
                    {{Auth::user()->name}}
                </button>
            @endif
            <div class="dropdown-menu dropdown-menu-right" id="navbar-dropdown">
                <a href="#" class="dropdown-item">Profile</a>
                <a href="#" class="dropdown-item">Setting</a>
                <li>
                    <form action="{{route("logout")}}" method="POST">
                        @csrf
                        <button class="dropdown-item" style="cursor: pointer">Sign Out</button>
                    </form>
                </li>
            </div>
        </div>
    </nav>

    <div class="container-fluid h-100 p-0">
        <div class="flex-row d-flex align-items-stretch m-0" style="min-height: 100%;">
            <div class="polished-sidebar bg-light col-12 col-md-3 col-lg-2 p-0 collapse d-md-inline" id="sidebar-nav">
                <ul class="polished-sidebar-menu ml-0 pt-4 p-0 d-md-block">
                    {{-- <input type="text" class="border-dark form-control d-block d-md-none mb-4" placeholder="Search" aria-label="Search"> --}}
                    <li><a href="{{route('home')}}"><span class="oi oi-home"></span> Home</a></li>
                    <li><a href="{{route('users.index')}}"><span class="oi oi-people"></span> Manage Users</a></li>
                    <li><a href="{{route('categories.index')}}"><span class="oi oi-tag"></span> Manage Categories</a></li>
                    <li>
                        <a href="{{route('books.index')}}"><span class="oi oi-book"></span> Manage Books</a>
                    </li>
                    <li>
                        <a href="{{route('orders.index')}}"><span class="oi oi-briefcase"></span> Manage Orders</a>
                    </li>
                    <div class="d-block d-md-none">
                        <div class="dropdown-divider"></div>
                        <li><a href="">Profile</a></li>
                        <li><a href="">Setting</a></li>
                        <li>
                            <form action="{{route("logout")}}" method="post">
                                @csrf
                                <button class="dropdown-item" style="curson: pointer">Sign Out</button>
                            </form>
                        </li>
                    </div>
                </ul>
                {{-- <div class="pl-3 d-none d-md-block position-fixed" style="buttom: 0px">
                    <span class="oi oi-cog"></span> Setting
                </div> --}}
            </div>
            <div class="col-lg-10 col-md-9 p-4">
                <div class="row">
                    <div class="col-md-12 pl-3 pt-2">
                        <div class="pl-3">
                            <h3>@yield('title')</h3>
                            <br>
                        </div>
                    </div>
                </div>

                @yield('content')

            </div>
        </div>
    </div>

    <script src="{{asset('node_modules/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('node_modules/popper.js/dist/popper.min.js')}}"></script>
    <script src="{{asset('node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    
    @yield('footer-script')
</body>
</html>