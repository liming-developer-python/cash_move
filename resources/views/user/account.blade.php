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
                                <div class="card-title" style="font-size: 1rem; color: #0c85d0;">
                                    Account ID : {{$account->account_id}}
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <h5 style="color: #0c85d0;">Amounts</h5>
                                <h2 class="counter" id="{{'amount_' . $account->account_id}}"> {{$account->point}}</h2>
                                <div class="row" style="padding-top: 3vh;">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-label" style="color: #0c85d0;">Receiver ID</label>
                                            <input type="number" class="form-control" placeholder="Account ID" id="{{'account_' . $account->account_id}}" step=".01">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-label" style="color: #0c85d0;">Send Amount</label>
                                            <input type="number" class="form-control" placeholder="pts" id="{{'point_' . $account->account_id}}" step=".01">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 3vh;">
                                    <div class="col-md-1"></div>
                                    <div class="col-sm-6 col-md-5">
                                    </div>
                                    <div class="col-sm-6 col-md-5">
                                        <div class="form-group">
                                            <label class="form-label" style="color: #0c85d0;">Please check again before send.</label>
                                            <input type="button" class="btn btn-primary" value="Send" id="{{'transfer_' . $account->account_id}}" onclick="sendInfo(this)">
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
    <!-- Modal -->
    <div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="loader"></div>
                    <div clas="loader-txt">
                        <p>Please wait for a moment.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script>
        var account_list = [];
        $(document).ready(function () {
            $.ajax({
                type: 'POST',
                url: "{{url('/user/get_account_list')}}",
                data:{
                    'id': '',
                },
                success: function (response) {
                    $.map(response, function(val, key) {
                        account_list.push(val['account_id'])
                    });
                }
            });
        });

        function sendInfo(s) {
            var id = s.id;
            var account_id = id.replace('transfer_', '');
            var check_send = 1;
            var send_account_id = $('#account_' + account_id.toString()).val();

            if (! account_list.includes(parseInt(send_account_id)))
            {
                check_send = 0;
                alert('Please select correct Account ID where you want to transfer.');
            }

            var send_point = $('#point_' + account_id.toString()).val();
            var amount_point = $('#amount_' + account_id.toString()).text();
            if (send_point == 0)
            {
                check_send = 0;
                alert('You should type amount of points.');
            }
            if (send_point > parseFloat(amount_point))
            {
                check_send = 0;
                alert("You don't have enough points.");
            }
            if (send_account_id == account_id)
            {
                check_send = 0;
                alert('Please select another account to send points. You selected the same account');
            }
            if (check_send == 1){
                $("#loadMe").modal({
                    backdrop: "static", //remove ability to close modal with click
                    keyboard: false, //remove option to close with keyboard
                    show: true //Display loader!
                });
                $.ajax({
                    type: 'POST',
                    url: "{{url('/user/send_point')}}",
                    data:{
                        'id': account_id,
                        'send_account': send_account_id,
                        'point': send_point
                    },
                    success: function () {
                        location.reload();
                        $("#loadMe").modal("hide");
                        alert('Transfer Succeed.');
                    },
                    error: function () {
                        $("#loadMe").modal("hide");
                        alert('Transfer failed.');
                    }
                });
            }
        }

        $('document').ready(function () {
            $('.counter').countUp();
        });
    </script>

@endsection
