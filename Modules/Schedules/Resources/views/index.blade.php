@extends('layouts.app')
@section('cass')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">{{$error}}</div>
            @endforeach
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Schedule Management</div>

                    <div class="card-body">

                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Estimated KM</th>
                                <th>Total Bill</th>
                                <th>Status</th>
                                <th>Change Status</th>
{{--                                <th>Buses</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td>{{$schedule->start_date}}</td>
                                    <td>{{$schedule->end_date}}</td>
                                    <td>{{$schedule->estimated_km}}</td>
                                    <td>{{$schedule->total_bill}}</td>
                                    <td>{{$schedule->statusString}}</td>
                                    <td>
                                        <form method="POST" action="{{ route('schedule.change-status') }}">
                                            @csrf
                                            <input type="hidden" name="schedule_id" value="{{$schedule->id}}">
                                            <input type="hidden" name="status" value="{{$schedule->status}}">
                                            @if($schedule->status == 0)
                                                <button type="submit" class="btn btn-success">
                                                    Active
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-danger">
                                                    Deactive
                                                </button>
                                            @endif
                                        </form>
                                    </td>
{{--                                    <td></td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        new DataTable('#example');
    </script>
@endsection

