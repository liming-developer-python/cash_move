@extends('layout.app')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('css/auth_form.css') }}">
@endsection

@section('content')
    <div class="container" style="margin-top: 10vh; color: #00aced; font-size: 1.1vw;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border-color: #0b0b0b;">
                    <div class="card-header" style="border-color: #0b0b0b; background-color: rgba(246, 56, 84, 0.8) !important; color: white;">登録</div>
                        <p style="font-size: 1.3vw; text-align: center; padding-top: 3vh; padding-bottom: 3vh; margin: auto;">
                            サイト訪問、歓迎します。<br>
                            あなたの情報が成果的に登録されました。<br>
                            管理者の承認があるまでお待ちください。<br>
                        </p>
                        <a href="{{url('/')}}" style="color: red; text-align: center;">ホームページに戻る</a>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
