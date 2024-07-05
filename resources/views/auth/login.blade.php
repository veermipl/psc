@extends('layout.master')

@section('title', config('app.name') . ' || Login')
@section('content')
    <section class="log-sect">
        <div class="container">
            <div class="row">
                <div class="col-md-12 loginn">
                    <div class="login-box">
                        <h1>Login</h1>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            @method('post')

                            <div class="textbox">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" class="form-control" name="email" placeholder="Enter your email" required>

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="textbox">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password" required>

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn">Login</button>
                            <a href="{{ route('password.request') }}" class="forgot">Forgot Password?</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
