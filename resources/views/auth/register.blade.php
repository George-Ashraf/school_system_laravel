@extends('layouts.app')

@section('content')
    <div class="login">
        <header class="col-lg-5">
            <h1>Register to school system</h1>
        </header>
        <form method="POST" class="col-lg-5" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">password confirm</label>
                <input id="password-confirm" type="password" class="form-control"name="password_confirmation" required autocomplete="new-password">


            </div>



            <button type="submit">Register</button>

        </form>
        <div class="dont col-lg-5">
            <p>already have an account? <a href="{{ route('login') }}">login</a></p>
        </div>
    </div>


@endsection
