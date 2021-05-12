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
                            <h3 class="card-title">プロフィール</h3>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row mb-2">
                                    <div class="col">
                                        <h3 class="mb-1 ">George Mestayer</h3>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Bio</label>
                                    <input type="form-control" class="form-control" value="nickname"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email-Address</label>
                                    <input class="form-control" placeholder="your-email@domain.com"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">New Password</label>
                                    <input type="password" class="form-control" value="password"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" value="password"/>
                                </div>
                                <div class="form-footer">
                                    <button class="btn btn-primary btn-block">変更された情報を保管</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">グループと口座</h3>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="card-box tilebox-one">
                                    <i class="icon-layers float-right text-muted"><i class="fa fa-cubes text-success" aria-hidden="true"></i></i>
                                    <h6 class="text-drak text-uppercase mt-0">グループ</h6>
                                    <h2 class="m-b-20">678</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="card-box tilebox-one">
                                    <i class="icon-layers float-right text-muted"><i class="fa fa-bar-chart text-secondary" aria-hidden="true"></i></i>
                                    <h6 class="text-drak text-uppercase mt-0">口座</h6>
                                    <h2 class="m-b-20">7,908</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')

@endsection
