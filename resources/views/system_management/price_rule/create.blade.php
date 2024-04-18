@extends('layouts.admin')
@section('title')
{{ __('Create Price Rule') }}
@endsection
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item" href="{{ route('room_type.index') }}">{{ __('Price Rule') }}</a><span class="breadcrumb-item active">{{ __('Create') }}</span>

@endsection
@section('content')

{!! Form::open(['route' => 'price_rule.store', 'method' => 'POST']) !!}
<div class="col-md-8 m-auto">
    <div class="card">
        <div class="card-header">{{ __('Create New Price Rule') }} </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('name', __('Room Type')) }}
                        <select name="room_type_id" id="room_type_id" class="form-control">
                            <option value="">Select</option>
                            @foreach($room_type as $roomtype)
                            <option value="{{ $roomtype->id }}">{{ $roomtype->room_type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('name', __('Price')) }}
                        {!! Form::text('price', '100', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('name', __('Extra Adult Price')) }}
                        {!! Form::text('extra_adult_price', '100', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('name', __('Extra Child Price')) }}
                        {!! Form::text('extra_child_price', '50', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('name', __('Checkin Time')) }}
                        {!! Form::time('check_in', '12:00', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('name', __('Checkout Time')) }}
                        {!! Form::time('check_out', '12:00', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('name', __('Overtime Surcharge')) }}
                        {!! Form::text('overtime_charge', '10', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('name', __('Rounded minutes to one hour')) }}
                        {!! Form::text('rounded_minutes', '30', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">{{ __('Holiday Price') }} </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('name', __('Friday Price')) }}
                        {!! Form::text('friday_price', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('name', __('Saturday Price')) }}
                        {!! Form::text('saturday_price', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('name', __('Sunday Price')) }}
                        {!! Form::text('sunday_price', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('name', __('Holiday Price')) }}
                        {!! Form::text('holiday_price', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}
            <a class="btn btn-secondary" href="{{ route('cities.index') }}"> {{ __('Back') }}</a>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection