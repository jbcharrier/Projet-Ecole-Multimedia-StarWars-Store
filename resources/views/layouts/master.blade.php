<!doctype html>
<html class="no-js" lang="fr">
<head>
    <meta charset="UTF-8">
    <title>J'aime Schnaps.it</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('assets/css/knacss.min.css')}}" media="all">
    <link rel="stylesheet" href="{{url('assets/css/app.min.css')}}" media="all">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
<header id="header" role="banner" class="line pam txtcenter">
    @include('partials.nav')
</header>
<div id="main" role="main" class="line pam">
    @yield('content')
</div>
<footer id="footer" role="contentinfo" class="line pam">
    <ul class="pam footer">
        <li class="pam inbl"><a href="/">Accueil</a></li>
        <li class="pam inbl"><a href="/mentions">Mentions</a></li>
        <li class="pam inbl"><a href="/contact">Contact</a></li>
        <li class="pam inbl"><a href="/product">Dashboard</a></li>
    </ul>
</footer>
</body>
</html>
