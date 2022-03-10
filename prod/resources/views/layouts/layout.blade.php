<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Продукты</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('js/alert/walert.css') }}">
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/alert/walert.js') }}"></script>

</head>
<body>
<div class="container" style="padding-top: 40px">
    <div id="soo"></div>
    <a title="" style="font-size: 14px;
                            line-height: 13px;color: #3c3c3c;" href="{{ route('home') }}">Главная</a>&nbsp;
    <div class="row">
        <div class="col-md-12">
            <div class="row row-flex row-flex-wrap">
                <div class="col-md-2 " style="background: #374050;">
                    <table>
                        <tr>
                            <td><p><img style="" src="/img/logo.png" alt="" class="img-fluid float-left"></p></td>
                            <td style="width: 50px;
height: 33px;font-size: 11px;padding-left: 15px;padding-top: 10px;
line-height: 11px;color: #FFFFFF;"> Enterprise Resource Planning
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-10 " style="background: #FFFFFF; ">
                    @if (session()->has('success'))
                        <script>soob("{{ session('success') }}", '', -5, 1000, 8000);</script>
                    @endif
                    @if (session()->has('error'))
                        <script>mainwin("{{ session('error') }}");</script>
                    @endif

                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 vert pull-left">
                                <table>
                                    <tr>
                                        <td style="padding: .9em 0px"><p style="color: #ED1C24;font-size: 11px;">
                                                Продукты</p></td>
                                    </tr>
                                    <tr>
                                        <td><p><img style="width: 51px;height: 3px" src="/img/lin.png" alt=""
                                                    class="img-fluid float-left"></p></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-2  vert pull-right">
                                @guest
                                    <a title="" href="{{ route('register.create') }}">Регистрация</a>&nbsp;
                                    <a title="" href="{{ route('login.create') }}">Войти</a>
                                @endguest
                                @auth
                                    <a title="" href="{{ route('logout') }}">Выйти</a>&nbsp;
                                    <a href="{{ url('/admin') }}"> Привет! {{ auth()->user()->name }}</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>



