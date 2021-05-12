@extends('layout.app')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('css/auth_form.css') }}">
@endsection

@section('content')
<div class="container" style="margin-top: 10vh; color: #00aced; font-size: 1.1vw;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border-color: #0b0b0b;">
                <div class="card-header" style="border-color: #0b0b0b; background-color: rgba(246, 56, 84, 0.8) !important; color: white;">ログイン</div>

                <div class="card-body">
                    @if ($admin_check == 0)
                        <p style="text-align: center; color: red; font-size: 1.2vw; margin: auto; padding-bottom: 2vh;">
                            <strong>管理者が承認するまでお待ちください。</strong>
                        </p>
                    @endif
                    <form method="POST" action="{{ url('/login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>メールアドレスとパスワードを正確に入力してください。</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>メールアドレスとパスワードを正確に入力してください。</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        ログイン情報を保管します。
                                    </label>
                                </div>
                            </div>
                        </div>
                        @if ($admin_check == 2)
                            <p style="text-align: center; color: red; font-size: 1.2vw; margin: auto; padding-bottom: 2vh;">
                                <strong>メールアドレスとパスワードを正確に入力してください。</strong>
                            </p>
                        @endif
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="font-size: 1vw;">
                                    ログイン
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        パスワードを忘れましたか?
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
