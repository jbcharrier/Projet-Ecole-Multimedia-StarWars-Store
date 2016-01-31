@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Historique des commandes non-finalisées : </h2>
        <table>
            <tr id="entete">
                <th>Date de commande</th>
                <th>Nom du client</th>
                <th>Nom du Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
            </tr>
            @foreach($command_unfs as $command_unf)
                <tr id="tableau">
                    <th>{{$command_unf->command_at}}</th>
                    @if($user_id=$command_unf->user_id)
                        <th class="user">{{$command_unf->user->name}}</th>
                    @else
                        <th class="user">No user identification</th>
                    @endif
                    <th class="name"><a
                                href="{{url('prod', [$command_unf->product->id, $command_unf->product->slug])}}">{{$command_unf->product->name}}</a>
                    </th>
                    <th class="quantity">{{$command_unf->quantity}}</th>
                    <th class="command_unf_price">{{$command_unf->price}}{{trans('app.currency')}}</th>
                </tr>
            @endforeach
        </table>
    </div>
@stop
