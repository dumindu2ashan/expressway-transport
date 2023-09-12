@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create Route</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('route.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-end">Route</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" autocomplete="name" autofocus>
                                    @error('name')<span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input type="hidden" name="is_expressway" value="0" />
                                        <input class="form-check-input" type="checkbox" name="is_expressway" id="is_expressway" {{ old('is_expressway') ? 'checked' : '' }} value="1">

                                        <label class="form-check-label" for="is_expressway">
                                            Is expressway
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

