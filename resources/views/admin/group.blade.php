@extends('layout.dashboard')

@section('page-css')

@endsection

@section('content')
    <div class="app-content my-3 my-md-5">
        <div class="side-app">
            <div class="row" style="margin-top: 5vh;">
                <div class="col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Groups</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-3">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Create New Group</button>
                                </div>
                                <div class="col-7">
                                    <div style="display: flex;">
                                        <label class="col-md-4 col-form-label text-md-right">Add P to Group: </label>
                                        <input type="number" id="multi_point" class="form-control" step=".01" style="margin-left: 1rem;">
                                        <select class="form-control custom-select" id="multi_way" style="margin-left: 1rem;">
                                            <option value="0">-- P way --</option>
                                            <option value="1">P</option>
                                            <option value="2">%</option>
                                        </select>
                                        <input type="button" id="multi_add" class="btn btn-primary btn-block" value="Add P" style="margin-left: 1rem;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <select class="form-control custom-select" id="group_list" multiple style="height: 60vh;" onclick="showGroupMembers(this)">
                                        <option value="0">-- Groups --</option>
                                        @foreach($groups as $group)
                                            <option value="{{$group->id}}">{{$group->group_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class="form-control custom-select" id="member_list" multiple style="height: 60vh;">
                                        <option value="0">-- members --</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class="form-control custom-select" id="user_list" multiple style="height: 60vh;">
                                        <option value="0">-- users --</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->user_id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 3vh;">
                                <div class="col-4">
                                    <button type="button" class="btn btn-primary" style="margin-left: 30%;" id="delete_group">Remove Group</button>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-primary" style="margin-left: 30%;" id="delete_user_group">Remove member</button>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-primary" style="margin-left: 30%;" id="add_user_group">Add to Group</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create a new Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2 col-lg-2"></div>
                        <div class="col-md-8 col-lg-8">
                            <div class="form-group">
                                <label class="form-label">Please input group name。</label>
                                <input type="text" id="create_group_name" class="form-control" name="example-text-input" placeholder="group name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" id="create_group" class="btn btn-primary">Create</button>
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
                        <p>Please wait.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script>
        function showGroupMembers(s)
        {
            var group_id = parseInt(s.value);

            if (group_id == 0)
            {
                return;
            }

            $("#loadMe").modal({
                backdrop: "static", //remove ability to close modal with click
                keyboard: false, //remove option to close with keyboard
                show: true //Display loader!
            });
            $.ajax({
                type: 'POST',
                url: "{{url('/admin/get_group_members')}}",
                data:{
                    'id': group_id,
                },
                success: function (member_list) {
                    $("#loadMe").modal("hide");
                    $('#user_list').find('option').remove().end().append('<option value="0">-- users --</option>').val(0);
                    @foreach($users as $user)
                        $('#user_list').append($("<option></option>").attr('value', '{{$user->id}}').text('{{$user->name}}'));
                    @endforeach
                    $('#member_list').find('option').remove().end().append('<option value="0">-- members --</option>').val(0);
                    $.map(member_list, function(val, key) {
                        $('#member_list').append($("<option></option>").attr('value', val['id']).text(val['name']));
                        $("#user_list option[value='" + val['id'] + "']").remove();
                    });
                }
            })
        }

        $('document').ready(function () {
            $('#create_group').click(function () {
                var create_group_name = $('#create_group_name').val();
                if (create_group_name == '')
                {
                    alert('Please input group name。');
                    return;
                }
                $("#loadMe").modal({
                    backdrop: "static", //remove ability to close modal with click
                    keyboard: false, //remove option to close with keyboard
                    show: true //Display loader!
                });
                $.ajax({
                    type: 'POST',
                    url: "{{url('/admin/create_group')}}",
                    data:{
                        'group_name': create_group_name,
                    },
                    success: function () {
                        $("#loadMe").modal("hide");
                        location.reload();
                    }
                });
            });

            $('#add_user_group').click(function () {
                var user_id = $('#user_list').val();
                if (user_id.length == 0 || user_id == "0")
                {
                    return;
                }
                user_id = parseInt(user_id);

                var group_id = $('#group_list').val();
                if (group_id.length == 0 || group_id == "0")
                {
                    return;
                }
                group_id = parseInt(group_id);
                $("#loadMe").modal({
                    backdrop: "static", //remove ability to close modal with click
                    keyboard: false, //remove option to close with keyboard
                    show: true //Display loader!
                });
                $.ajax({
                    type: 'POST',
                    url: "{{url('/admin/add_user_group')}}",
                    data:{
                        'user_id': user_id,
                        'group_id': group_id
                    },
                    success: function () {
                        $("#loadMe").modal("hide");
                        var user_name = $("#user_list option[value='" + user_id + "']").text();
                        $('#member_list').append($("<option></option>").attr('value', user_id).text(user_name));
                        $("#user_list option[value='" + user_id + "']").remove();
                    }
                });
            });

            $('#delete_user_group').click(function () {
                var user_id = $('#member_list').val()
                if (user_id.length == 0 || user_id == "0")
                {
                    return;
                }
                user_id = parseInt(user_id);

                var group_id = $('#group_list').val();
                if (group_id.length == 0 || group_id == "0")
                {
                    return;
                }
                group_id = parseInt(group_id);

                $("#loadMe").modal({
                    backdrop: "static", //remove ability to close modal with click
                    keyboard: false, //remove option to close with keyboard
                    show: true //Display loader!
                });
                $.ajax({
                    type: 'POST',
                    url: "{{url('/admin/delete_user_group')}}",
                    data:{
                        'user_id': user_id,
                        'group_id': group_id
                    },
                    success: function () {
                        $("#loadMe").modal("hide");
                        var user_name = $("#member_list option[value='" + user_id + "']").text();
                        $('#user_list').append($("<option></option>").attr('value', user_id).text(user_name));
                        $("#member_list option[value='" + user_id + "']").remove();
                    }
                });
            });

            $('#delete_group').click(function () {
                var r = confirm("Remove Selected Group");
                if (r == false)
                {
                    return;
                }
                var group_id = $('#group_list').val();
                if (group_id.length == 0 || group_id == "0")
                {
                    return;
                }
                group_id = parseInt(group_id);

                $("#loadMe").modal({
                    backdrop: "static", //remove ability to close modal with click
                    keyboard: false, //remove option to close with keyboard
                    show: true //Display loader!
                });
                $.ajax({
                    type: 'POST',
                    url: "{{url('/admin/delete_group')}}",
                    data:{
                        'group_id': group_id
                    },
                    success: function () {
                        $("#loadMe").modal("hide");
                        location.reload();
                    }
                });
            });

            var user_list = []
            var add_method = 0
            var point_value = 0

            $('#multi_add').click(function () {
                $('#member_list option').each(function(i){
                    var user_id = $(this).val();
                    if (user_id != 0)
                    {
                        user_list.push(parseInt(user_id));
                    }
                });
                point_value = $('#multi_point').val();
                add_method = $('#multi_way').val();
                call_ajax();
            });

            function call_ajax() {
                if (add_method == 0)
                {
                    alert('Please select how to add P。');
                    return ;
                }
                if (point_value == '' || point_value == 0)
                {
                    alert('Please input P value。');
                    return ;
                }
                if (user_list.length == 0)
                {
                    alert('Please select user。');
                    return ;
                }

                $("#loadMe").modal({
                    backdrop: "static", //remove ability to close modal with click
                    keyboard: false, //remove option to close with keyboard
                    show: true //Display loader!
                });

                $.ajax({
                    type: 'POST',
                    url: "{{url('/admin/group_add_point')}}",
                    data:{
                        'user_id': user_list,
                        'add_method': add_method,
                        'point': point_value,
                    },
                    success: function () {
                        $("#loadMe").modal("hide");
                        location.reload();
                    }
                });

                user_list = []
                add_method = 0
                point_value = 0
            }
        });
    </script>
@endsection
