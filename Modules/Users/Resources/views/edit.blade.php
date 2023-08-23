@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit User</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="row mb-3">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-end">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="name"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name',$user->name) }}" required autocomplete="name" autofocus>
                                    @error('name')<span class="invalid-feedback"
                                                         role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-end">email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email',$user->email) }}" required autocomplete="email" autofocus>
                                    @error('email')<span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="type" class="col-md-4 col-form-label text-md-end">Type</label>

                                <div class="col-md-6">
                                    <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                                        <option value="" selected>Select a type</option>
                                        <option value="{{\App\Models\User::USER_TYPE_OWNER}}" @if(old('type',$user->type) == \App\Models\User::USER_TYPE_OWNER) selected @endif}}>Owner</option>
                                        <option value="{{\App\Models\User::USER_TYPE_IT_ADMIN}}" @if(old('type',$user->type) == \App\Models\User::USER_TYPE_IT_ADMIN) selected @endif}}>IT Admin</option>
                                        <option value="{{\App\Models\User::USER_TYPE_MANAGER}}" @if(old('type',$user->type) == \App\Models\User::USER_TYPE_MANAGER) selected @endif}}>Manager</option>
                                        <option value="{{\App\Models\User::USER_TYPE_USER}}" @if(old('type',$user->type) == \App\Models\User::USER_TYPE_USER) selected @endif}}>User</option>
                                    </select>

                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
{{--                            <div class="row mb-3">--}}
{{--                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">--}}

{{--                                    @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row mb-3">--}}
{{--                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

