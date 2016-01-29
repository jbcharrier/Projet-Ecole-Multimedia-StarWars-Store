@extends('layouts.admin')

@section('content')
    <div class="container">
        <table>
            <a href="{{url('/product/create')}}" ><input type="submit" value="Ajouter un produit" class="bouton" id="add"></a>
            <tr id="entete">
                <th>status</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>date</th>
                <th>category</th>
                <th>tags</th>
                <th>action</th>
            </tr>


            @forelse($products as $product)
                <tr id="tableau">
                    <th><a class="btn btn-{{$product->status}}" href="{{url('product', ['status', $product->id])}}">{{$product->status}}</a></th>
                    <th><a href="{{url('product',[$product->id, 'edit'])}}">{{$product->name}}</a></th>
                    <th>{{$product->price}}</th>
                    <th>{{$product->quantity}}</th>
                    <th>{{$product->published_at->format('d/m/Y')}}</th>
                    <th>{{($cat = $product->category)? $cat->title: 'pas de catégorie'}}</th>
                    <th>@forelse ($product->tags as $tag){{$tag->name}}
                        @empty{{trans('app.noTag')}}@endforelse</th>
                    <th>
                        <form method="POST" action="{{url('product', $product->id)}}">
                            {!!csrf_field()!!}
                            <input type="hidden" name="_method" value="delete">
                            <input type="submit" value="delete" class="bouton">
                        </form>
                    </th>
                </tr>
            @empty
            @endforelse
        </table>
    </div>
@stop