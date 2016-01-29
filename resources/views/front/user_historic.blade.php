@extends('layouts.master')

@section('content')
    <div class="container">
        @if(!$histories->isEmpty())
        <h2>Historique des commandes passées par {{$histories->first()->customer->user->name}}: </h2>

        <table>
            <tr id="entete_historic">
                <th>{{trans('app.date_command')}}</th>
                <th>Product Name</th>
                <th>Product Quantity</th>
                <th>Price per product</th>
                <th>Total Price</th>
            </tr>
            @foreach($histories as $history)
                <tr>
                    <th>{{$history->command_at}}</th>
                    <th class="name">@foreach($history->history_details as $history_detail)<p><a href="{{url('prod', [$history_detail->product->id, $history_detail->product->slug])}}">{{$history_detail->product->name}}</a></p>@endforeach</th>
                    <th class="quantity">@foreach($history->history_details as $history_detail)<p>{{$history_detail->quantity}}</p>@endforeach</th>
                    <th class="price-per-product">@foreach($history->history_details as $history_detail)<p>{{$history_detail->product->price}}</p>@endforeach</th>
                    <th class="historic_price">{{$history->total_price}}{{trans('app.currency')}}</th>
                </tr>
            @endforeach
        </table>
        @else
            <th class="no-user-commmand"><h2>Vous n'avez pas encore passé de commandes.</h2></th>
        @endif
        {{--{!! $histories->links()!!}--}}
        {{--création de la pagination (//on utilise !! !! pour ne pas avoir d'html entities.--}}
    </div>
@stop
