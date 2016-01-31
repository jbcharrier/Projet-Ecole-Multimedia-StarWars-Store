<!doctype html>
<html class="no-js" lang="fr">
<head>
    <meta charset="UTF-8">
    <title>J'aime Schnaps.it</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('assets/css/knacss.min.css')}}" media="all">
    <link rel="stylesheet" href="{{url('assets/css/app.min.css')}}" media="all">
</head>
<body>
<header id="header" role="banner" class="line pam txtcenter">
    <nav id="navigation" role="navigation">
        <ul class="pam">
            <li><a href="{{url('/')}}">{{trans('app.backHome')}}</a></li>
            <li><a href="{{url('product')}}">{{trans('app.backDashboard')}}</a></li>
            <li id="historic"><a href="{{url('product', ['historic'])}}">{{trans('app.historic')}}</a></li>
            <li id="command_unf_historic"><a
                        href="{{url('product', ['historic', 'command_unf'])}}">{{trans('app.command_unf')}}</a></li>
            <li><a href="{{url('/logout')}}">{{trans('app.logout')}}</a></li>
        </ul>
    </nav>
</header>
<div id="main" role="main" class="line pam">
    @yield('content')
</div>
<footer id="footer" role="contentinfo" class="line pam txtcenter">
    <ul class="pam footer">
        <li class="pam inbl"><a href="/">Accueil</a></li>
        <li class="pam inbl"><a href="/mentions">Mentions</a></li>
        <li class="pam inbl"><a href="/contact">Contact</a></li>
    </ul>
</footer>
</body>
</html>