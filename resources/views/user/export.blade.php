@extends('layout.user')

@section('page-css')

@endsection

@section('content')
    <div class="app-content my-3 my-md-5">
        <div class="side-app">
            <div class="row row-cards">
                <div class="col-md-5 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title" style="font-size: 1rem; color: #0c85d0;">
                                <br>
                                <p style="font-size: 1.5rem; color: orangered;">Account list</p>
                                <br>
                                @foreach($account_info as $account)
                                    <p>Account ID : {{$account->account_id}}  =>  {{$account->point}}</p>
                                @endforeach
                                <br><br>
                                <p style="font-size: 1.5rem; color: orangered;">Request Export</p>
                                <br>
                                <select class="form-control custom-select" id="account_select" style="margin-left: 1rem; height: 2.5rem; width: 13rem;">
                                    <option value="0">-- account --</option>
                                    @foreach($account_info as $account)
                                        <option value="{{$account->account_id}}">{{$account->account_id}}</option>
                                    @endforeach
                                </select>
                                <input type="number" id="point_export" class="form-control" step=".01" style="margin-left: 1rem; height: 2.5rem; width: 13rem;">
                                <input type="button" id="btn_export" class="btn btn-primary btn-block" value="Export" onclick="requestExport()" style="margin-left: 1rem; height: 2.5rem; max-width: 7rem;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title" style="font-size: 1rem; color: #0c85d0;">
                                <br>
                                <p style="font-size: 1.5rem; color: orangered;">Export History</p>
                                <br>
                                <table id="history" class="table table-striped table-bordered" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th class="wd-20p">No</th>
                                        <th class="wd-20p">Account ID</th>
                                        <th class="wd-15p">Point</th>
                                        <th class="wd-20p">Request Date</th>
                                        <th class="wd-20p">Admin Confirm Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($export_list) == 0)
                                        <tr>
                                            <td colspan="5">There is no export history.</td>
                                        </tr>
                                    @else
                                        @foreach($export_list as $export_info)
                                            <tr>
                                                <td>{{ ++$idx }}</td>
                                                <td>{{ $export_info->account_id }}</td>
                                                <td>{{ $export_info->point }}</td>
                                                <td>{{ $export_info->time }}</td>
                                                <td>
                                                    @if($export_info->admin_check == 1)
                                                        {{ $export_info->check_time }}
                                                    @else
                                                        Pending
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
                    'id': {{ $user_id }},
                },
                success: function (response) {
                    $.map(response, function(val, key) {
                        account_list.push([val['account_id'], parseFloat(val['point'])]);
                    });
                }
            });
        });

        function requestExport()
        {
            var account_id = $("#account_select").val();
            var point = $("#point_export").val();
            var check_send = 1;
            for (var i = 0; i < account_list.length; i++)
            {
                if (account_id == account_list[i][0])
                {
                    if (parseFloat(point) > account_list[i][1])
                    {
                        check_send = 0;
                        alert("You don't have enough points in your account.");
                    }
                }
            }
            if (check_send == 1)
            {
                $("#loadMe").modal({
                    backdrop: "static", //remove ability to close modal with click
                    keyboard: false, //remove option to close with keyboard
                    show: true //Display loader!
                });
                $.ajax({
                    type: 'POST',
                    url: "{{url('/user/export_point')}}",
                    data:{
                        'id': account_id,
                        'user_id': {{ $user_id }},
                        'point': point
                    },
                    success: function () {
                        location.reload();
                        $("#loadMe").modal("hide");
                        alert('You export your points successfully');
                    }
                });
            }
        }
    </script>

@endsection

