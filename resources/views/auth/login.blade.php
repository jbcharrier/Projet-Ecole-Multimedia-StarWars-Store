@extends('layouts.master')

@section('content')
    <form method="POST" action="{{url('login')}}">
        {!!csrf_field()!!}
        {{--c'est un token de la session qu'on passe via le head (évite qu'on nous attaque via un formulaire) // durée de 5 min--}}
        <div class="form-text">
            <label class="label" for="email">{{trans('app.emailAddress')}}</label>
            <input class="input-text" id="email" name="email" type="email" value="{{old('email')}}">
            @if($errors->has('email')) <span class="error">{{$errors->first('email')}}</span> @endif
        </div>

        <div class="form-text">
            <label class="label" for="password">{{trans('app.password')}}</label>
            <input class="input-text" id="password" name="password" type="password">
            @if($errors->has("password")) <span class="error">{{$errors->first("password")}}</span> @endif
        </div>

        <div class="form-text">
            <label class="label" for="remember">{{trans('app.remember')}}</label>
            <input type="radio" name="remember"  value="true" >
        </div>
        <div class="form-submit">
            <input type="submit" value="login">
        </div>
    </form>
    <div class="login-registration">
        <p>Je ne suis pas encore enregistré sur le site :</p>
        <a href="{{url('login', ['registration'])}}"><button>Je crée mon compte utilisateur</button></a>
    </div>
@stop