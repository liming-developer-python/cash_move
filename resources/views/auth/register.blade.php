@extends('layout.app')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('css/auth_form.css') }}">
@endsection

@section('content')
<div class="container" style="margin-top: 10vh; color: #00aced; font-size: 1.1rem;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border-color: #0b0b0b;">
                <div class="card-header" style="border-color: #0b0b0b; background-color: rgba(246, 56, 84, 0.8) !important; color: white;">Register</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nickname</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>This nickname is already used.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Email address is already used.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Please use more strong password.</strong>
                                    </span>
                                @enderror
                                <p style="font-size: 0.8rem; color: black;">＊ Password must contain at least 8 characters.</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <span class="invalid-feedback" id="wrong_confirm" style="display: none;">
                                    <strong>Please confirm the same password.</strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="submit_btn" style="font-size: 1rem;">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var password = document.getElementById('password');
    var confirm = document.getElementById('password-confirm');
    var wrong_confirm = document.getElementById('wrong_confirm');

    confirm.addEventListener('input', function(event) {
        if (password.value === event.target.value)
        {
            wrong_confirm.style.display = "none";
            document.getElementById("submit_btn").disabled = false;
        }
        else {
            wrong_confirm.style.display = "block";
            document.getElementById("submit_btn").disabled = true;
        }
    });
</script>
@endsection
