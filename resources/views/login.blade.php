@extends('layout.layout-common')

@section('space-work')

<h1>Login</h1>

@if($errors->any())
@foreach($errors->all() as $error)
<p style="color:red;">{{ $error }}</p>
@endforeach
@endif

@if(Session::has('error'))
<p style="color:red;">{{Session::get('error')}}</p>
@endif

<!-- <form action="{{ route('userLogin') }}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Enter Email">
    <br><br>
    <input type="password" name="password" placeholder="Enter Password">
    <br><br>
    <input type="submit" value="Login">
</form> -->

<form action="{{ route('userLogin') }}" method="POST">
    @csrf
    <div class="form-group">
        <input type="email"  name="email" class="form-control" placeholder="Your Email" />
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Enter Password"  />
    </div>
    <div class="form-group">
        <input type="submit" class="btnSubmit" value="Login" />
    </div>
    <div class="form-group">
        <a href="/forget-password" class="ForgetPwd">Forget Password?</a>
    </div>
</form>


@endsection