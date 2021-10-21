@extends('layout.user')

@section('page-css')

@endsection

@section('content')
    <div class="app-content my-3 my-md-5">
        <div class="side-app">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Import History</h3>
                        </div>

                        <div class="card-body">
                            <div class="card-box tilebox-one w-100">
                                <table id="history" class="table table-striped table-bordered dataTable no-footer" style="width: 100%; color: black">
                                    <thead>
                                    <tr>
                                        <th class="wd-15p">No</th>
                                        <th class="wd-20p">Account ID</th>
                                        <th class="wd-20p">Amount</th>
                                        <th class="wd-20p">Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($history) == 0)
                                        <tr>
                                            <td colspan="5">There is no import history.</td>
                                        </tr>
                                    @else
                                        @foreach( $history as $detail )
                                            <tr>
                                                <td>{{ ++$idx }}</td>
                                                <td>{{ $detail->account_id }}</td>
                                                <td>{{ $detail->amount }}</td>
                                                <td>
                                                    {{ $detail -> time }}
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
@endsection

@section('page-js')
    <script>
        $('document').ready(function () {

        });
    </script>

@endsection
