@extends('layouts.admin')
@section('title')
{{ __('Edit Booking') }}
@endsection
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item" href="{{ route('booking.index') }}">{{ __('Bookings') }}</a><span class="breadcrumb-item active">{{ __('Edit') }}</span>

@endsection
@section('content')
{!! Form::model($booking, ['method' => 'PATCH', 'route' => ['booking.update', $booking->id]]) !!}
<div class="col-md-8 m-auto">
    <div class="card">
        <div class="card-header">{{ __('Edit Booking') }} </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('name', __('Customer Name')) }}
                        {!! Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('name', __('Phone Number')) }}
                        {!! Form::text('phone_number', null, ['placeholder' => __('Phone Number'), 'class' => 'form-control', 'oninput' => "validateTelInput(this)", 'maxlength' => "10"]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Room Type</label>
                        <select class="form-control" name="room_type_id" id="room_type">
                            <option value="" selected>Select Room Type</option>
                            @foreach ($room_types as $room_type)
                            <option value="{{ $room_type->id }}" @if($room_type->id == $booking->room_type_id) selected @endif>{{ $room_type->room_type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('name', __('From Date')) }}
                        {!! Form::date('from_date', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('name', __('To Date')) }}
                        {!! Form::date('to_date', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('name', __('Advance Payment')) }}
                        {!! Form::text('advance_payment', null, ['placeholder' => __('0'), 'class' => 'form-control', 'oninput' => "validateTelInput(this)", 'maxlength' => "4"]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('name', __('Total Price')) }}
                        {!! Form::text('total_price', null, ['placeholder' => __('0'), 'class' => 'form-control', 'oninput' => "validateTelInput(this)", 'maxlength' => "4"]) !!}
                    </div>
                </div> -->
            </div>
            {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}

            <a class="btn btn-secondary" href="{{ route('cities.index') }}"> {{ __('Back') }}</a>
        </div>
        <div>
        </div>
    </div>
</div>
{!! Form::close() !!}
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
    function validateTelInput(input) {
        input.value = input.value.replace(/[^\d]/g, ''); // Replace any non-digit characters with an empty string
    }
</script>
@endsection