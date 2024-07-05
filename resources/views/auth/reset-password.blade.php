@extends('layout.master')

@section('title', config('app.name') . ' || Password Reset')
@section('content')
    <section class="log-sect">
        <div class="container">
            <div class="row">
                <div class="col-md-12 loginn">
                    <div class="login-box">
                        <h1>Reset Your Password</h1>

                        <form action="{{ route('password.store') }}" method="POST">
                            @csrf
                            @method('post')

                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="textbox">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" class="form-control" name="email" placeholder="Enter your email" value="{{ old('email', $request->email) }}" readonly required>

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password"  class="form-control" required>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
