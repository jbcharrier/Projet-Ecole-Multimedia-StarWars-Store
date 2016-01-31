@extends('layouts.master')

@section('content')
    <div class="container txtcenter" id="login">
        @if(Session::has('noauth'))
            @include('front.partials.flash')
        @endif
        @if(Session::has('storeuser'))
            @include('front.partials.flash')
        @endif
        @if(Session::has('storepassword'))
            @include('front.partials.flash')
        @endif
        <h2>Merci de vous identifier pour afficher la page souhaitée :</h2>
        <form method="POST" action="{{url('login')}}">
            {!!csrf_field()!!}
            <div class="border">
                <h5>Je m'identifie :</h5>
                <div class="form-text ">
                    <label class="label" for="email">{{trans('app.emailAddress')}}</label>
                    <input class="input-text" id="email" name="email" type="email" value="{{old('email')}}" required>
                    @if($errors->has('email')) <span class="error">{{$errors->first('email')}}</span> @endif
                </div>
                <div class="form-text">
                    <label class="label" for="password">{{trans('app.password')}}</label>
                    <input class="input-text" id="password" name="password" type="password" required>
                    @if($errors->has("password")) <span class="error">{{$errors->first("password")}}</span> @endif
                </div>
                <div class="password-reset">
                    <a href="password/reset">
                        <p>Mot de passe oublié</p>
                    </a>
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