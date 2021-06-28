@extends('layout.user')

@section('page-css')

@endsection

@section('content')
    <div class="app-content my-3 my-md-5">
        <div class="side-app">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Profile</h3>
                        </div>
                        <div class="card-body" style="color: #00aced;">
                            <div class="row mb-2">
                                <div class="col">
                                    <h3 class="mb-1 ">{{$info->name}}</h3>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nickname</label>
                                <input id="name" type="form-control" class="form-control" value="{{$info->name}}"/>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input id="email" class="form-control" placeholder="your-email@domain.com" value="{{$info->email}}"/>
                            </div>
                            <div class="row mb-2" id="info_error" style="display: none; color: red; text-align: center;">
                                <div class="col">
                                    <p class="mb-1 " style="font-size: 0.95rem;">Please input correct email and password。</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">New Password</label>
                                <input id="password" type="password" class="form-control" value="password"/>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Confirm New Password</label>
                                <input id="password_confirm" type="password" class="form-control" value="password"/>
                            </div>
                            <div class="row mb-2" id="password_error" style="display: none; color: red; text-align: center;">
                                <div class="col">
                                    <p class="mb-1 " style="font-size: 1rem;">Please confirm new password correctly。</p>
                                </div>
                            </div>
                            <div class="form-footer">
                                <input type="button" id="save_change" class="btn btn-primary btn-block" value="Save Changes">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Transfer History</h3>
                        </div>
                        @foreach( $history as $detail )
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-box tilebox-one">
                                        <i class="icon-layers float-right text-muted"><i class="fa fa-bar-chart text-secondary" aria-hidden="true"></i></i>
                                        <h6 class="text-drak text-uppercase mt-0" style="color: #007bff;">Account ID : {{$detail->receiver}}</h6>
                                        <h2 class="m-b-20">{{$detail->amount}}</h2>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script>
        $('document').ready(function () {
            $('#save_change').click(function () {
                var name = $('#name').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var password_confirm = $('#password_confirm').val();
                if (password !== password_confirm)
                {
                    $('#password_error').css('display', 'block');
                }
                else if (name.length === 0 || email.length === 0 || !email.includes('@'))
                {
                    $('#info_error').css('display', 'block');
                }
                else
                {
                    $.ajax({
                        type: 'POST',
                        url: "{{url('/user/edit_profile')}}",
                        data:{
                            'name': name,
                            'email' : email,
                            'password': password,
                        },
                        success: function () {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>

@endsection
