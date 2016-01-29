<nav id="navigation" role="navigation">
    <h1 class="man"><img src="/assets/image/logo.png" alt="">store</h1>
    <ul class="pam">
        <li><a href="{{url('/')}}">Accueil</a></li>
        @forelse($categories as $category)
            <li><a href="{{url('cat', [$category->id, str_slug($category->title)])}}">{{$category->title}}</a></li>
        @empty
            <li><a href="#">{{trans('app.noCategory')}}</a></li>
        @endforelse
        <li><a href="{{url('contact/')}}">Contact</a></li>

        <li id="user_command"><a href="{{url('/command/historic')}}">Mes précédentes commandes</a></li>
        @if(null!==(DB::table('carts')->value('id')))
            <li><a href="{{url('cart')}}"><i class="fa fa-shopping-cart"></i><span> Mon panier</span></a></li>
        @else
        @endif
        @if(Auth::check())
            <li><a href="{{url('/logout')}}"><input type="submit" value="Log Out" class="login"></a></li>
        @else
            <li><a href="{{url('/login')}}"><input type="submit" value="Login" class="login"></a></li>
        @endif
    </ul>
</nav>