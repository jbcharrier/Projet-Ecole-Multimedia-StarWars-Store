<div class="alert {{Session::get('alert')}}">
    <p>{{Session::get('message')}}<a href="{{url('/')}}">{{trans('app.home')}}</a></p>
</div>