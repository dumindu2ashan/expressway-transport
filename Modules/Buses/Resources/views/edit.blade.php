@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create Bus</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('bus.update') }}">
                            <input type="hidden" name="id" value="{{$bus->id}}">
                            @csrf
                            <div class="row mb-3">
                                <label for="vehicle_no"
                                       class="col-md-4 col-form-label text-md-end">Vehicle Number</label>
                                <div class="col-md-6">
                                    <input id="vehicle_no" type="text"
                                           class="form-control @error('vehicle_no') is-invalid @enderror" name="vehicle_no"
                                           value="{{ old('vehicle_no',$bus->vehicle_no) }}" autocomplete="vehicle_no" autofocus>
                                    @error('vehicle_no')<span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="type"
                                       class="col-md-4 col-form-label text-md-end">Type</label>
                                <div class="col-md-6">
                                    <input id="type" type="text"
                                           class="form-control @error('type') is-invalid @enderror" name="type"
                                           value="{{ old('type',$bus->type) }}" autocomplete="type" autofocus>
                                    @error('type')<span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="price_per_km"
                                       class="col-md-4 col-form-label text-md-end">Price Per KM</label>
                                <div class="col-md-6">
                                    <input id="price_per_km" type="text"
                                           class="form-control @error('price_per_km') is-invalid @enderror" name="price_per_km"
                                           value="{{ old('price_per_km',$bus->price_per_km) }}" autocomplete="price_per_km" autofocus>
                                    @error('price_per_km')<span class="invalid-feedback"
                                                                role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
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

