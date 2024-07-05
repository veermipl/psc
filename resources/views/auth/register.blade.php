@extends('layout.master')

@section('title', config('app.name') . ' || Register')
@section('content')
    <section class="log-sect">
        <div class="container">
            <div class="row">
                <div class="col-md-12 loginn">
                    <div class="login-box">
                        <h1>Register</h1>

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            @method('post')

                            <div class="textbox">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name" placeholder="Enter your name" required>

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="textbox">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" class="form-control" name="email" placeholder="Enter your email" required>

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn">Create Account</button>
                            <a href="{{ route('login') }}" class="forgot">Already Registered?</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
