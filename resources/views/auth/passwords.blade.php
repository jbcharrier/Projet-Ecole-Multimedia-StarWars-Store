@extends('layouts.master')

@section('content')
    <div class="container txtcenter" id="login">
        @if(Session::has('errorstorepassword'))
            @include('front.partials.flash')
        @endif
        @if(Session::has('emailfailstorepassword'))
            @include('front.partials.flash')
        @endif
        <h2>Merci de compléter les champs suivants pour créer un nouveau mot de passe :</h2>
        <form method="POST" action="{{url('password', ['register'])}}">
            {!!csrf_field()!!}
            <div class="border">
                <div class="form-text ">
                    <label class="label" for="email">{{trans('app.emailAddress')}}</label>
                    <input class="input-text input" id="email" name="email" type="email" value="{{old('email')}}"
                           required>
                    @if($errors->has('email')) <span class="error">{{$errors->first('email')}}</span> @endif
                </div>
                <div class="form-text">
                    <label class="label" for="password">Entrez votre nouveau mot de passe : </label>
                    <input class="input-text input" id="password" name="password" type="password" required>
                    @if($errors->has("password")) <span class="error">{{$errors->first("password")}}</span> @endif
                </div>
                <div class="form-text">
                    <label class="label" for="npassword">Confirmez votre nouveau mot de passe : </label>
                    <input class="input-text input" id="npassword" name="npassword" type="password" required>
                    @if($errors->has("npassword")) <span class="error">{{$errors->first("npassword")}}</span> @endif
                </div>
                <div class="form-submit" id="submit-password">
                    <input class="btn" type="submit" value="Enregistrer">
                </div>
            </div>
        </form>
    </div>
@stop