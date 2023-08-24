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
                    <div class="card-header">Report of buses</div>

                    <div class="card-body">

                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>Vehicle No</th>
                                <th>Type</th>
                                <th>Price per Km (Rs)</th>
                                <th>Trip count</th>
                                <th>total earn</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $bus)
                                <tr>
                                    <td>{{$bus->vehicle_no}}</td>
                                    <td>{{$bus->type}}</td>
                                    <td>{{$bus->price_per_km}}</td>
                                    <td>{{$bus->schedules->count('id')}}</td>
                                    <td>{{$bus->schedules->sum('total_bill')}}</td>
                                    <td>{{$bus->statusString}}</td>
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
        // new DataTable('#example');
    </script>
@endsection

