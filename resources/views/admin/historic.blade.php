@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Historique des commandes finalisées : </h2>
        <table>
            <tr id="entete">
                <th>Date de commande</th>
                <th>Nom du client</th>
                <th>Nom du Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Prix total</th>
            </tr>
            @foreach($histories as $history)
                <tr id="tableau">
                    <th>{{$history->command_at}}</th>
                    <th class="customer">{{$history->customer->user->name}}</th>
                    <th class="name">@foreach($history->history_details as $history_detail)<p><a
                                    href="{{url('prod', [$history_detail->product->id, $history_detail->product->slug])}}">{{$history_detail->product->name}}</a>
                        </p>@endforeach</th>
                    <th class="quantity">@foreach($history->history_details as $history_detail)
                            <p>{{$history_detail->quantity}}</p>@endforeach</th>
                    <th class="price-per-product">@foreach($history->history_details as $history_detail)
                            <p>{{$history_detail->product->price}}</p>@endforeach</th>
                    <th class="historic_price">{{$history->total_price}}{{trans('app.currency')}}</th>
                </tr>
            @endforeach
        </table>
    </div>
@stop