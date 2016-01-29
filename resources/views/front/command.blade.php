@extends('layouts.master')

@section('content')
    <div class="container" id="command">
        <h2 class="txtcenter">COMMANDE</h2>
        <div class="grid-3">
        @foreach($carts as $cart)
            <div class="product bfc">
                @if($pict=$cart->product->picture)
                    <img src="{{url('uploads', $pict->uri)}}" class="fl">
                @endif
                <h3 class="name"><a
                            href="{{url('prod', [$cart->product->id, $cart->product->slug])}}">{{$cart->product->name}}</a>
                </h3>
                <p class="price">{{trans('app.price')}}{{$cart->product->price}}{{trans('app.currency')}}</p>
                <p class="quantity">{{trans('app.quantity')}}{{$cart->quantity}}</p>
                    {{--<form method="POST" action="{{url('cart', $cart->id)}}">--}}
                        {{--{!!csrf_field()!!}--}}
                        {{--<input type="hidden" name="_method" value="delete">--}}
                        {{--<input type="submit" value="delete" class="bouton">--}}
                    {{--</form>--}}
            </div>
        @endforeach
        </div>
        <div class="total grid-2">
            <div>
            <p class="total_cart txtcenter">{{trans('app.total')}}{{$total}}{{trans('app.currency')}}</p></div>
            <div>
            <a href="{{url('command', ['valid'])}}"><button>Valider ma commande</button></a>
            <a href="{{url('cart')}}"><button>Retour à ma page panier</button></a>
            </div>
        </div>
    </div>
@stop