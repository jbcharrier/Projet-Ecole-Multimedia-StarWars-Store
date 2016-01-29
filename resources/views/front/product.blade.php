@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="product bfc" id="main_product">
            @if($pict=$product->picture)
                <img src="{{url('uploads', $pict->uri)}}">
            @endif
            <h3 class="name"><a href="{{url('prod', [$product->id, $product->slug])}}">{{$product->name}}</a></h3>
            <p class="content"><span>{{trans('app.content')}}</span>{{$product->content}}</p>
            <p class="price">{{trans('app.price')}}{{$product->price}}{{trans('app.currency')}}</p>
            <p class="tags">
                {{trans('app.tag')}}
                @forelse ($product->tags as $tag)
                    <a href="{{url('tag', [$tag->id])}}">{{$tag->name}}</a>
                @empty
                    {{trans('app.noTag')}}
                @endforelse
            </p>
            <div class="center" id="product">
                <form method="POST" action="{{url('cart')}}">
                    {!!csrf_field()!!}
                    <h3>Pour commander ce produit : </h3>
                    <p><label for="quantity">{{trans('app.quantity')}}</label>
                        <select name="quantity" id="quantity" required>
                            <option value="" disabled></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </p>
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input id='select_product' type="submit" value="Je sélectionne ce produit">
                </form>
            </div>
        </div>
    </div>
@stop