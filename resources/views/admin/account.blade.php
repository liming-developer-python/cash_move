@extends('layout.dashboard')

@section('page-css')

@endsection

@section('content')
    <div class="app-content my-3 my-md-5">
        <div class="side-app">
            <div class="page-header">
                <h4 class="page-title">Accounts</h4>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-3">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Create new account</button>
                                </div>
                                <div class="col-7">
                                    <div style="display: flex;">
                                        <label class="col-md-4 col-form-label text-md-right">Multi-Add: </label>
                                        <input type="number" id="multi_point" class="form-control" step=".01" style="margin-left: 1vw;">
                                        <select class="form-control custom-select" id="multi_way" style="margin-left: 1vw;">
                                            <option value="0">-- pts way --</option>
                                            <option value="1">pts</option>
                                            <option value="2">%</option>
                                        </select>
                                        <input type="button" id="multi_add" class="btn btn-primary btn-block" value="Add pts" style="margin-left: 1vw;">
                                    </div>
                                </div>
                            </div>
{{--                            <div class="card-title">Multi-Add: </div>--}}
{{--                            <div style="display: flex;">--}}
{{--                                <input type="number" id="multi_point" class="form-control" step=".01" style="margin-left: 1vw; max-width: 15vw;">--}}
{{--                                <select class="form-control custom-select" id="multi_way" style="margin-left: 1vw; max-width: 10vw;">--}}
{{--                                    <option value="0">-- 追加方式 --</option>--}}
{{--                                    <option value="1">pts</option>--}}
{{--                                    <option value="2">%</option>--}}
{{--                                </select>--}}
{{--                                <input type="button" id="multi_add" class="btn btn-primary btn-block" value="ポイント追加" style="margin-left: 1vw; max-width: 10vw;">--}}
{{--                            </div>--}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th class="wd-20p"></th>
                                        <th class="wd-20p">User ID</th>
                                        <th class="wd-20p">Nickname</th>
                                        <th class="wd-15p">Account ID</th>
                                        <th class="wd-20p">pts</th>
                                        <th class="wd-20p">Add pts</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($accounts as $account)
                                        <tr id="{{$account->name}}">
                                            <td>
                                                <label class="custom-control custom-checkbox" style="align-items: center;">
                                                    <input type="checkbox" id="multi_select" class="custom-control-input" name="multi-select" value="{{'multi_' . $account->id}}">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </td>
                                            <td>{{$account->user_id}}</td>
                                            <td>{{$account->name}}</td>
                                            <td>{{$account->account_id}}</td>
                                            <td>{{$account->point}}</td>
                                            <td style="display: flex;">
                                                <input type="number" id="{{'point_' . $account->id}}" class="form-control" step=".01" style="margin-left: 1vw; max-width: 15vw;">
                                                <select class="form-control custom-select" id="{{'way_' . $account->id}}" style="margin-left: 1vw; max-width: 10vw;">
                                                    <option value="0">-- pts way --</option>
                                                    <option value="1">pts</option>
                                                    <option value="2">%</option>
                                                </select>
                                                <input type="button" id="{{'add_' . $account->id}}" class="btn btn-primary btn-block" value="Add pts" style="margin-left: 1vw; max-width: 10vw;">
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-1 col-lg-1"></div>
                        <div class="col-md-10 col-lg-10">
                            <div class="form-group">
                                <label class="form-label">Please select user。</label>
                                <select class="form-control custom-select" id="user_list">
                                    <option value="0">-- nickname --</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->user_id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" id="create_account" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script>
        $('document').ready(function () {
            $('#create_account').click(function () {
                var account_user_id = $('#user_list').val();
                if (account_user_id == 0)
                {
                    alert('Please select user first。');
                    return;
                }
                $.ajax({
                    type: 'POST',
                    url: "{{url('/admin/create_account')}}",
                    data:{
                        'user_id': account_user_id,
                    },
                    success: function () {
                        location.reload();
                    }
                });
            });

            var account_list = []
            var add_method = 0
            var point_value = 0

            $('#multi_add').click(function () {
                $('#multi_select:checked').each(function(i){
                    var account_id = $(this).val().replace('multi_', '');
                    account_list.push(parseInt(account_id));
                });
                point_value = $('#multi_point').val();
                add_method = $('#multi_way').val();
                call_ajax();
            })

            $('input:button').click(function () {
                var account_id = $(this).attr('id').replace('add_', '');
                if (isNaN(parseInt(account_id)))
                {
                    return ;
                }
                account_list.push(parseInt(account_id));
                point_value = $('#point_' + account_id.toString()).val();
                add_method = $('#way_' + account_id.toString()).val();
                call_ajax();
            })

            function call_ajax() {
                if (add_method == 0)
                {
                    alert('Please select how to add pts。');
                    return ;
                }
                if (point_value == '' || point_value == 0)
                {
                    alert('Please type pts value。');
                    return ;
                }
                if (account_list.length == 0)
                {
                    alert('Please select account。');
                    return ;
                }

                $.ajax({
                    type: 'POST',
                    url: "{{url('/admin/account_add_point')}}",
                    data:{
                        'account_id': account_list,
                        'add_method': add_method,
                        'point': point_value,
                    },
                    success: function () {
                        location.reload();
                    }
                });

                account_list = []
                add_method = 0
                point_value = 0
            }
        });
    </script>
@endsection
