@extends('layout.dashboard')

@section('page-css')

@endsection

@section('content')

    <div class="app-content my-3 my-md-5">
        <div class="side-app">
            <div class="page-header">
                <h4 class="page-title">ユーザーリスト</h4>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">新しく登録されたユーザーをチェックして認証してください。</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th class="wd-10p">ニックネーム</th>
                                        <th class="wd-15p">メールアドレス</th>
                                        <th class="wd-20p">登録日付</th>
                                        <th class="wd-15p">承認の可否</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)
                                        <tr id="{{$user->name}}">
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->created_at}}</td>
                                            <td>
                                                @if ($user->admin_check == 0)
                                                    新しく登録されたユーザー
                                                    <input id="{{$user->id}}" type="button" class="btn btn-primary" style="float: right;" value="認証">
                                                @else
                                                    認証されたユーザー
                                                    <input type="button" class="btn btn-primary" style="float: right;" value="認証" disabled>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- table-wrapper -->
                    </div>
                    <!-- section-wrapper -->

                </div>
            </div>
        </div>

@endsection

@section('page-js')
    <script>
        $('document').ready(function () {
            $("input").click(function(e){
                var idClicked = e.target.id;
                $.ajax({
                    type: 'POST',
                    url: "{{url('admin/user_check')}}",
                    data:{
                        'user_id': idClicked,
                    },
                    success: function () {
                        location.reload();
                    }
                });
            });
        });
    </script>

@endsection

