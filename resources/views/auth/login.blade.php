@if(Session::has('message'))
    @include('front.partials.flash')
@endif
@extends('layouts.master')

@section('content')
    <div class="container txtcenter" id="login">
        <h2>Merci de vous identifier pour afficher la page souhaitée :</h2>
        <form method="POST" action="{{url('login')}}">
            {!!csrf_field()!!}
            {{--c'est un token de la session qu'on passe via le head (évite qu'on nous attaque via un formulaire) // durée de 5 min--}}
            <div class="border">
                <h5>Je m'identifie :</h5>
                <div class="form-text ">
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
                    <input type="radio" name="remember" value="true">
                </div>
                <div class="form-submit" id="submit-login">
                    <input class="btn" type="submit" value="Login">
                </div>
            </div>
        </form>
        <div class="login-registration border" id="user-register">
            <h5>Je ne suis pas encore enregistré sur le site :</h5>
            <a href="{{url('login', ['registration'])}}">
                <button class="btn">Je crée mon compte utilisateur</button>
            </a>
        </div>
    </div>
@stop