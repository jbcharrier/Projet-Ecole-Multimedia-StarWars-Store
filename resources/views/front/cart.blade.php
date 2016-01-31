@extends('layouts.master')

@section('content')
    <div class="container" id="cart">
        @if(Session::has('cart-delete'))
            @include('front.partials.flash')
        @endif
        <h2 class="txtcenter">Récapitulatif de votre panier</h2>
        @foreach($carts as $cart)
            <div class="product bfc">
                @if($pict=$cart->product->picture)
                    <img src="{{url('uploads', $pict->uri)}}" class="fl">
                @endif
                <h3 class="name"><a
                            href="{{url('prod', [$cart->product->id, $cart->product->slug])}}">{{$cart->product->name}}</a>
                </h3>
                <p class="abstract">{{$cart->product->abstract}}</p>
                <p class="price">{{trans('app.price')}}{{$cart->product->price}}{{trans('app.currency')}}</p>
                <p class="quantity">{{trans('app.quantity')}}{{$cart->quantity}}</p>
                <form method="POST" action="{{url('cart', $cart->id)}}">
                    {!!csrf_field()!!}
                    <input type="hidden" name="_method" value="delete">
                    <input type="submit" value="delete" class="bouton">
                </form>
            </div>
        @endforeach
        <div class="total grid-2">
            <div>
                <p class="total_command txtcenter">{{trans('app.total')}}{{$total}}{{trans('app.currency')}}</p></div>
            <div>
                <a href="{{url('command')}}">
                    <button class="btn">Finaliser ma commande</button>
                </a>
            </div>
        </div>
    </div>
@stop