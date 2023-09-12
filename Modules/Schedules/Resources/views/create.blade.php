@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create Schedule</div>
                    <div class="card-body">
                        <form method="POST" id="formCheck">
                            @csrf
                            <div class="row mb-3">
                                <label for="start_date"
                                       class="col-md-1 col-form-label text-md-end">Start date</label>
                                <div class="col-md-2">
                                    <input id="start_date" type="text"
                                           class="form-control"
                                           name="start_date"
                                           value="{{ old('start_date') }}" autofocus data-date-format="yyyy-mm-dd"
                                           autocomplete="off">
                                    <small class="text-danger" id="error_start_date"></small>
                                </div>
                                <label for="end_date"
                                       class="col-md-1 col-form-label text-md-end">End date</label>
                                <div class="col-md-2">
                                    <input id="end_date" type="text"
                                           class="form-control" name="end_date"
                                           value="{{ old('end_date') }}" autofocus data-date-format="yyyy-mm-dd"
                                           autocomplete="off">
                                    <small class="text-danger" id="error_end_date"></small>
                                </div>
                                <label for="type"
                                       class="col-md-1 col-form-label text-md-end">Type</label>
                                <div class="col-md-2">
                                    <select class="form-control" name="type" id="type">
                                        <option value="">Select a type</option>
                                        @foreach($types as $type)
                                            <option value="{{$type}}">{{$type}}</option>
                                        @endforeach
                                    </select>
                                    @error('type')<span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                                <div class="col-md-2">
                                    <button type="button" id="searchButton" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                        <form method="POST" action="{{ route('schedule.store') }}">
                            @csrf
                            <input type="hidden" name="start_date" id="h_start_date">
                            <input type="hidden" name="end_date" id="h_end_date">
                            <input type="hidden" name="estimated_km" id="h_estimated_km">
                            <div class="row mb-3">
                                <label for="estimated_km"
                                       class="col-md-1 col-form-label text-md-end">Estimated KM</label>
                                <div class="col-md-2">
                                    <input id="estimated_km" type="text"
                                           class="form-control @error('estimated_km') is-invalid @enderror"
                                           name="estimated_km"
                                           value="{{ old('estimated_km') }}" autofocus
                                           autocomplete="off">
                                    @error('estimated_km')<span class="invalid-feedback"
                                                                role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Vehicle No</th>
                                        <th>Type</th>
                                        <th>Price_per_km</th>
                                        <th>Total Price</th>
                                        <th>Select buses</th>
                                    </tr>
                                    </thead>
                                    <tbody id="incrementDiv">
                                    </tbody>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td id="total_cost"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Schedule</button>
                                </div>
                            </div>
                            <input type="hidden" name="total_bill" id="total_bill">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#start_date').datepicker({
            minDate: 0,
            dateFormat: 'yy-mm-dd',
            setDate: new Date(),
        });
        $('#end_date').datepicker({
            minDate: 0,
            dateFormat: 'yy-mm-dd',
            setDate: new Date(),
        });

        total_bill = 0;

        function getTot(checkbox) {
            cost = parseInt($(checkbox).attr("data-cost"));
            if (checkbox.checked) {
                total_bill += cost;
            } else {
                total_bill -= cost;
            }
            $('#total_cost').html(total_bill);
            $('#total_bill').val(total_bill);
        }

        $('#searchButton').click(function (e) {
            total_bill=0;
            $('#total_bill').val(0);
            $('#total_cost').html(0)
            $('.innerTr').remove();
            $('#error_start_date').html('')
            $('#error_end_date').html('')
            $.ajax({
                type: "POST",
                url: "{{ url('schedule/check-available') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'start_date': $('#start_date').val(),
                    'end_date': $('#end_date').val(),
                    'type': $('#type').val(),
                },
                success: function (response) {
                    $('#h_estimated_km').val($('#estimated_km').val());
                    $('#h_end_date').val($('#end_date').val());
                    $('#h_start_date').val($('#start_date').val());
                    estimated_km = $('#estimated_km').val();
                    $.each(response, function (key, value) {
                        var html = '<tr class="innerTr">' +
                            '<td>' + value.vehicle_no + '</td>' +
                            '<td>' + value.type + '</td>' +
                            '<td>' + value.price_per_km + '</td>' +
                            '<td>' + value.price_per_km * estimated_km + '</td>' +
                            '<td><input class="form-check-input buses_ids" type="checkbox" name="buses_ids[]" id="buses_ids" value="' + value.id + '" data-cost="' + value.price_per_km * estimated_km + '" onchange="getTot(this)"></td>' +
                            '</tr>';

                        $('#incrementDiv').first().after(html);
                    });
                },
                error: function (xhr) {
                    var errors_list = JSON.parse(xhr.responseText);
                    if (xhr.status == 422) {
                        errors = errors_list.errors;
                        if (errors.start_date) {
                            $('#error_start_date').html(errors.start_date[0])
                        }
                        if (errors.end_date) {
                            $('#error_end_date').html(errors.end_date[0])
                        }
                    }
                },
            })
        });


    </script>
@endsection

