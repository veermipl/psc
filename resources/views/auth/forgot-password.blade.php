@extends('layout.master')

@section('title', 'Forgot Password')
@section('content')
    <section class="log-sect">
        <div class="container">
            <div class="row">
                <div class="col-md-12 loginn">
                    <div class="login-box">
                        <h1>Forgot Password</h1>

                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            @method('post')

                            <div class="textbox">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" class="form-control" name="email" placeholder="Enter your email" required>

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn">Email Password Reset Link</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
