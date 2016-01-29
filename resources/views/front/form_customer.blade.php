@extends('layouts.master')

@section('content')
    <h2>Pour valider votre commande, vous devez vous enregistrer en complétant les champs suivant : </h2>
    <form method="POST" action="{{url('customer')}}">
        {!!csrf_field()!!}
        {{--c'est un token de la session qu'on passe via le head (évite qu'on nous attaque via un formulaire) // durée de 5 min--}}
        <div class="form-text">
            <label class="label" for="address">{{trans('app.address')}}</label>
            <input class="input-text" id="address" name="address" type="address" value="{{old('v')}}">
            @if($errors->has('address')) <span class="error">{{$errors->first('address')}}</span> @endif
        </div>

        <div class="form-text">
            <label class="label" for="cardnb">{{trans('app.cardnb')}}</label>
            <input class="input-text" id="cardnb" name="cardnb" type="cardnb">
            @if($errors->has("cardnb")) <span class="error">{{$errors->first("cardnb")}}</span> @endif
        </div>

        <div class="form-submit">
            <input type="submit" value="Enregistrer mes informations">
        </div>

    </form>
@stop