@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Historique des commandes non-finalisées : </h2>

        <table>
            <tr id="entete_historic">
                <th>{{trans('app.date_select')}}</th>
                <th>Customer Name</th>
                <th>Product Name</th>
                <th>Product Quantity</th>
                <th>Price per product</th>
            </tr>
        @foreach($command_unfs as $command_unf)
            <tr>
                <th>{{$command_unf->command_at}}</th>
                @if($user_id=$command_unf->user_id)
                <th class="user">{{$command_unf->user->name}}</th>
                    @else
                    <th class="user">No user identification</th>
                @endif
                <th class="name"><a href="{{url('prod', [$command_unf->product->id, $command_unf->product->slug])}}">{{$command_unf->product->name}}</a></th>
                <th class="quantity">{{$command_unf->quantity}}</th>
                <th class="command_unf_price">{{$command_unf->price}}{{trans('app.currency')}}</th>
            </tr>
            @endforeach
        </table>

        {{--{!! $histories->links()!!}--}}
        {{--création de la pagination (//on utilise !! !! pour ne pas avoir d'html entities.--}}
    </div>
@stop
