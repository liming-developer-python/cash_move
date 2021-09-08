@extends('layout.dashboard')

@section('page-css')

@endsection

@section('content')

    <div class="app-content my-3 my-md-5">
        <div class="side-app">
            <div class="page-header">
                <h4 class="page-title">Users</h4>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Please check and verify new registered users.</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th class="wd-10p">ID</th>
                                        <th class="wd-10p">NickName</th>
                                        <th class="wd-15p">Email</th>
                                        <th class="wd-20p">Registration Date</th>
                                        <th class="wd-15p">Verify</th>
                                        <th class="wd-15p">Remove User</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)
                                        <tr id="{{$user->name}}">
                                            <td>{{ $loop->index + 1}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->created_at}}</td>
                                            @if ($user->admin_check == 0)
                                                <td style="color: red;">
                                                    New User
                                                    <input id="{{$user->id}}" type="button" class="btn btn-primary verify_btn" style="float: right;" value="Verify">
                                                </td>
                                            @else
                                                <td>
                                                    Verified User
                                                    <input type="button" class="btn btn-primary verify_btn" style="float: right;" value="Verify" disabled>
                                                </td>
                                            @endif
                                            <td>
                                                <input id="{{$user->id}}" type="button" class="btn btn-primary delete_btn" style="float: right;" value="Delete">
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
        $(".verify_btn").click(function(e){
            var idClicked = e.target.id;
            $("#loadMe").modal({
                backdrop: "static", //remove ability to close modal with click
                keyboard: false, //remove option to close with keyboard
                show: true //Display loader!
            });
            $.ajax({
                type: 'POST',
                url: "{{url('admin/user_check')}}",
                data:{
                    'user_id': idClicked,
                },
                success: function () {
                    $("#loadMe").modal("hide");
                    location.reload();
                }
            });
        });

        $(".delete_btn").click(function(e){
            var deleteCheck = confirm("Do you really want to delete the selected user?");
            if (deleteCheck) {
                var idClicked = e.target.id;
                $("#loadMe").modal({
                    backdrop: "static", //remove ability to close modal with click
                    keyboard: false, //remove option to close with keyboard
                    show: true //Display loader!
                });
                $.ajax({
                    type: 'POST',
                    url: "{{url('admin/user_delete')}}",
                    data:{
                        'user_id': idClicked,
                    },
                    success: function () {
                        $("#loadMe").modal("hide");
                        location.reload();
                    }
                });
            }
        });
    </script>

@endsection

