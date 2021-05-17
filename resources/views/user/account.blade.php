@extends('layout.user')

@section('page-css')

@endsection

@section('content')
    <div class="app-content my-3 my-md-5">
        <div class="side-app">
            <div class="row row-cards">
                @foreach($info as $account)
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title" style="font-size: 1vw; color: #0c85d0;">
                                    口座 ID : {{$account->id}}
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <h5 style="color: #0c85d0;">ポイント在庫量</h5>
                                <h2 class="counter" id="{{'amount_' . $account->id}}"> {{$account->point}}</h2>
                                <div class="row" style="padding-top: 3vh;">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-label" style="color: #0c85d0;">ユーザーリスト</label>
                                            <select class="form-control custom-select" id="{{'user_' . $account->id}}" onchange="getAccountList(this)">
                                                <option value="0">-- ニックネーム --</option>
                                                @foreach($user_list as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-label" style="color: #0c85d0;">口座 ID</label>
                                            <select class="form-control custom-select" id="{{'account_' . $account->id}}">
                                                <option value="0">-- ID --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 3vh;">
                                    <div class="col-md-1"></div>
                                    <div class="col-sm-6 col-md-5">
                                        <div class="form-group">
                                            <label class="form-label" style="color: #0c85d0;">移送するポイント量</label>
                                            <input type="number" class="form-control" placeholder="ポイント" id="{{'point_' . $account->id}}" step=".01">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-5">
                                        <div class="form-group">
                                            <label class="form-label" style="color: #0c85d0;">ご確認の上、クリック</label>
                                            <input type="button" class="btn btn-primary" value="移送" id="{{'transfer_' . $account->id}}" onclick="sendInfo(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script>
        function getAccountList(s) {
            var id = s.value;
            var account_id = s.id.replace('user_', '');
            var send_account = '#account_' + account_id.toString();
            $.ajax({
                type: 'POST',
                url: "{{url('/user/get_account_list')}}",
                data:{
                    'id': id,
                },
                success: function (account_list) {
                    $(send_account).find('option').remove().end().append('<option value="0">-- ID --</option>').val(0);
                    $.map(account_list, function(val, key) {
                        $(send_account).append($("<option></option>").attr('value', val['id']).text(val['id']));
                    });
                }
            })
        }

        function sendInfo(s) {
            var id = s.id;
            var account_id = id.replace('transfer_', '');
            var send_user_id = $('#user_' + account_id.toString()).val();
            var check_send = 1;
            if (send_user_id == 0)
            {
                check_send = 0;
                alert('ポイントを移送するユーザーを選択してください。');
            }

            var send_account_id = $('#account_' + account_id.toString()).val();
            if (send_account_id == 0)
            {
                check_send = 0;
                alert('ポイントを移送する口座を選択してください。');
            }

            var send_point = $('#point_' + account_id.toString()).val();
            var amount_point = $('#amount_' + account_id.toString()).text();
            if (send_point == 0)
            {
                check_send = 0;
                alert('移送するポイント量を入力してください。');
            }
            if (send_point > parseFloat(amount_point))
            {
                check_send = 0;
                alert('在庫量が十分ではないため移送できません。');
            }
            if (send_account_id == account_id)
            {
                check_send = 0;
                alert('現在選択したアカウントへの移送です。 他のアカウントを選択してください。');
            }
            if (check_send == 1){
                $.ajax({
                    type: 'POST',
                    url: "{{url('/user/send_point')}}",
                    data:{
                        'id': account_id,
                        'send_user' : send_user_id,
                        'send_account': send_account_id,
                        'point': send_point
                    },
                    success: function () {
                        location.reload();
                        alert('移送が成功しました。');
                    }
                });
            }
        }

        $('document').ready(function () {
            $('.counter').countUp();
        });
    </script>

@endsection
