<div class="alert-box {{Session::get('alert')}}">
    <p>{{Session::get('cart-store')}}</p>
    <p>{{Session::get('cart-delete')}}</p>
    <p>{{Session::get('validcommand')}}</p>
    <p>{{Session::get('createcustomer')}}</p>
    <p>{{Session::get('sendemail')}}</p>
    <p>{{Session::get('noauth')}}</p>
    <p>{{Session::get('storeuser')}}</p>
    <p>{{Session::get('storeproduct')}}</p>
    <p>{{Session::get('updateproduct')}}</p>
    <p>{{Session::get('productdestroy')}}</p>
    <p>{{Session::get('storepassword')}}</p>
    <p>{{Session::get('errorstorepassword')}}</p>
    <p>{{Session::get('emailfailstorepassword')}}</p>
</div>