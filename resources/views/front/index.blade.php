@extends('layouts.master')

@section('content')
    <div class="container">
        @forelse($products as $product)
            <div class="product bfc">
                @if($pict=$product->picture)
                    <img src="{{url('uploads', $pict->uri)}}" class="fl">
                @endif
                <h3 class="name"><a href="{{url('prod', [$product->id, $product->slug])}}">{{$product->name}}</a></h3>
                <p class="abstract">{{$product->abstract}}</p>
                <p class="tags">
                    {{trans('app.tag')}}
                    @forelse ($product->tags as $tag)
                        <a href="{{url('tag', [$tag->id])}}">{{$tag->name}}</a>
                    @empty
                        {{trans('app.noTag')}}
                    @endforelse
                </p>
                <p class="categories">
                    @if($cat=$product->category)
                        Catégorie : <a
                                href="{{url('cat', [$product->category->id, str_slug($product->category->title)])}}">{{$product->category->title}}</a>
                    @endif
                </p>
                <p class="pub_date">{{trans('app.pub_date')}}{{$product->published_at->format('d-m-Y à H:i:s')}}</p>
            </div>
        @empty
            <p>No product</p>
        @endforelse

        {!! $products->links()!!}
        {{--création de la pagination (//on utilise !! !! pour ne pas avoir d'html entities.--}}
    </div>
@stop

