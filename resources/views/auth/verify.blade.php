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
                    <p style="font-size: 1.3rem; text-align: center; padding-top: 3vh; padding-bottom: 3vh; margin: auto;">
                        Welcome to GNcoin<br>
                        To use, you should verify your email account.<br>
                        Please check your email box.<br>
                    </p>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
