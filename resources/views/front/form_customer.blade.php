@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Pour valider votre commande, vous devez vous enregistrer en complétant les champs suivant : </h2>
        <div class="grid-2">
            <form method="POST" action="{{url('customer')}}">
                {!!csrf_field()!!}
                <div class="form-text">
                    <label class="label" for="address">{{trans('app.address')}}</label>
                    <input class="input-text input" id="address" name="address" type="address" value="{{old('v')}}"
                           required>
                    @if($errors->has('address')) <span class="error">{{$errors->first('address')}}</span> @endif
                </div>
                <div class="form-text">
                    <label class="label" for="cardnb">{{trans('app.cardnb')}}</label>
                    <input class="input-text input " id="cardnb" name="cardnb" type="cardnb" required>
                    @if($errors->has("cardnb")) <span class="error">{{$errors->first("cardnb")}}</span> @endif
                </div>
                <div class="form-submit">
                    <input class="btn input" type="submit" value="Enregistrer mes informations">
                </div>
            </form>
        </div>
    </div>
@stop