<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/global.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Scripts pour VueJs -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>@yield('titre')</title>
</head>
<body>
    <div>    
        @if(empty(trim($__env->yieldContent('MasquerHeaderFooter'))))
        <header class="header-image">
            <nav>
                <div class="nav-bar">
                    <div class="nav-bar-logo">
                        <h1 class="nav-logo">
                            The <br />
                            Vine
                        </h1>
                    </div>
                </div>
            </nav>
        </header>
        @endif
        
        
        @yield('content')

        @if(empty(trim($__env->yieldContent('MasquerHeaderFooter'))))    
        <footer>
            <div class="footer-items">
                <div class="footer-item">
                    <a href="/index">
                        <img src="{{asset('assets/profile.png')}}" alt="profile">
                    </a>
                    <p>Profile</p>
                </div>
                <div class="footer-item">
                    <a href="/index">
                        <img src="{{asset('assets/bouteilles.png')}}" alt="bouteilles">
                    </a>
                    <p>Catalogue</p>
                </div>
                <div class="footer-item">
                    <a href="/mes-celliers">
                        <img src="{{asset('assets/cellier.png')}}" alt="cellier">
                    </a>
                    <p>Mes Celliers</p>
                </div>
                <div class="footer-item">
                    <a href="/logout">
                        <img src="{{asset('assets/logout.png')}}" alt="logout">
                    </a>
                    <p>Sortir</p>
                </div>
            </div>
        </footer>
        @endif
    </div>
</body>
</html>