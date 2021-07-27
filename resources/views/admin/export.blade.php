@extends('layout.dashboard')

@section('page-css')

@endsection

@section('content')
    <div class="app-content my-3 my-md-5">
        <div class="side-app">
            <div class="page-header">
                <h4 class="page-title">Movement History</h4>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th class="wd-20p">ID</th>
                                        <th class="wd-20p">UserID</th>
                                        <th class="wd-15p">AccountID</th>
                                        <th class="wd-20p">Amount</th>
                                        <th class="wd-20p">Request Time</th>
                                        <th class="wd-20p">Confirm</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($export_data as $data)
                                        <tr id="{{$data->id}}">
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->user_id}}</td>
                                            <td>{{$data->account_id}}</td>
                                            <td>{{$data->point}}</td>
                                            <td>{{$data->time}}</td>
                                            <td>
                                                @if ( $data->check_time != NULL)
                                                    {{ $data->check_time }}
                                                @else
                                                    <input id="{{$data->id}}" type="button" class="btn btn-primary confirm_btn" style="float: right;" value="Confirm">
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
    </div>
@endsection

@section('page-js')
    <script>
        $(".verify_btn").click(function(e){
            var confirmCheck = confirm("Do you really want to confirm the request?");
            if (confirmCheck) {
                var idClicked = e.target.id;
                $.ajax({
                    type: 'POST',
                    url: "{{url('admin/export_confirm')}}",
                    data:{
                        'request_id': idClicked,
                    },
                    success: function () {
                        location.reload();
                    }
                });
            }
        });
        $('document').ready(function () {

        });
    </script>
@endsection
