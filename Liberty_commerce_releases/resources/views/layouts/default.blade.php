<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        
        <title>Index</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Henny+Penny&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
        
        

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/burgersStyle.css') }}">
        <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
        <link rel="stylesheet" href="{{ asset('css/cookiesManagement.css') }}">
        <body>
            <div class="container">
                <div class="header">
                    <div class="logo_container">
                        <img src="{{asset('images/KatchMyPastimesLogo3.png')}}" alt="logo">
                    </div>
                    <div>
                        <h1>KatchMyPastimes</h1>
                    </div>
                    <div>
                        <div class="nav">
                        <ul>
                            @if(Route::has('login'))
                            @auth
                                <li>{{ Auth::user()->name }} {{ Auth::user()->surname }}</li>
                                            {{-- affiche nom; prénom utilisateurs --}}
                                            @if (Auth::user()->role=='admin')
                                            <li><a href="{{ url('/admin') }}">Admin</a><hr></li>
                                            @endif
                                <li><a href="{{ url('/products') }}">Accueil</a></li>
                                
                                <li><a href="{{ url('/cart') }}" id="cartTotalItems">Panier</a></li>
                                <form  id="logout" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <input type="hidden" value="{{ Auth::user()->online = 0 }}" name="online">
                                    <li><a :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</a>
                                </li></form>

                            @endif 
                            @endauth
                            
                        </ul>
                        </div>
                        
                    </div>
                </div>
                @if(Route::has('login'))
                    @auth
                        <div class="header_responsiv">
                            <div>
                                <input type="checkbox" class="buttonToggle" id="btnLogin">
                                <label for="btnLogin" class="buttonIcon">
                                        <div class="sidebar">
                                            {{ Auth::user()->name }} {{ Auth::user()->surname }}<hr>
                                            {{-- affiche nom; prénom utilisateurs --}}
                                            @if (Auth::user()->role=='admin')
                                            <a href="{{ url('/admin') }}">Admin</a><hr>
                                            @else
                                            <p>test</p>
                                            @endif
                                            <a href="{{ url('/products') }}">Accueil</a><hr>
                                            <a href="{{ url('/cart') }}" id="cartTotalItems2">Panier</a><hr> 
                                            <form  id="logout" method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</a>
                                            </form><hr>
                                        </div> 
                                    <div class="buttonItem buttonItem--element1 "></div>
                                    <div class="buttonItem buttonItem--element2 "></div>
                                    <div class="buttonItem buttonItem--element3 "></div>
                                    <div class="buttonItem buttonItem--element3 "></div>
                                </label>
                            </div>
                        </div>
                    @endauth
                @endif 
                <div class="div_default">
                    @yield('miq')
                </div>
                <div class="cookieConsent">
                    <div class="cookieContent">
                        <h1 class="cookieContentTitle">Information about cookies</h1>
                        <p>We use essential cookies to make this site work. You may disable these by changing your browser settings but this may effect how the website functions
                            We use your data for the following purposes:
                            store somes informations about you .
                        </p>
                        <div class="buttonsSection">
                            <button class="btn agree">I Agree</button>
                            <button class="btn decline">I Decline</button>
                        </div>
                    </div>
                </div>
                <div class="revokeCookie"><button class="btn revoke">revoke cookies</button></div>
                <footer class="footer">
                    <a href="https://fr-fr.facebook.com/?nocaa=1%22%3E">  
                        <img class="down"  src="{{asset('images/facebook.png')}}" alt="logofacebook">
                    </a>
                    <a href="https://twitter.com/%22%3E">
                        <img class="down" src="{{asset('images/twitter.png')}}" alt="twitter"> 
                    </a>
                </footer>
            </div>
                <script src="{{ asset('js/cookiesManagement.js') }}"></script>
                <script src="{{ asset('js/cart.js') }}"></script>
        </body>
        </html>