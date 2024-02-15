@extends('layouts.auth')

@section('title', 'Login')

@section('main')
    <div class="card card-primary mt-4">
        <div class="card-header">
            <h4>Login</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="credentials">Username/E-Mail</label>
                    <input id="credentials" type="credentials" class="form-control @error('credentials') is-invalid @enderror"
                        name="credentials" value="{{ old('credentials') }}" tabindex="1" required autofocus>

                    @error('credentials')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" tabindex="2" required>

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg float-right" tabindex="4">
                        <i class="fas fa-sign-in"></i> Login
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
