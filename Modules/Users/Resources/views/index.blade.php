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
                    <div class="card-header">User Management</div>

                    <div class="card-body">

                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Change Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->typeString}}</td>
                                    <td>{{$user->statusString}}</td>
                                    <td>
                                        <a href="{{url('users/edit').'/'.$user->id}}" class="btn btn-primary">
                                            Edit
                                        </a>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('user.change-status') }}">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            <input type="hidden" name="status" value="{{$user->status}}">
                                            @if($user->status == 0)
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

