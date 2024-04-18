@extends('layouts.admin')
@section('title')
{{ __('Edit Price Rule') }}
@endsection
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item" href="{{ route('cities.index') }}">{{ __('Price Rule') }}</a><span class="breadcrumb-item active">{{ __('Edit') }}</span>

@endsection
@section('content')

{!! Form::model($price_rule, ['method' => 'PATCH', 'route' => ['price_rule.update', $price_rule->id]]) !!}
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
                            <option value="{{ $roomtype->id }}" @if( $price_rule->room_type_id == $roomtype->id) selected @endif>{{ $roomtype->room_type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('name', __('Price')) }}
                        {!! Form::text('price', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('name', __('Extra Adult Price')) }}
                        {!! Form::text('extra_adult_price', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('name', __('Extra Child Price')) }}
                        {!! Form::text('extra_child_price', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('name', __('Checkin Time')) }}
                        {!! Form::time('check_in', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('name', __('Checkout Time')) }}
                        {!! Form::time('check_out', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('name', __('Overtime Surcharge')) }}
                        {!! Form::text('overtime_charge', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('name', __('Rounded minutes to one hour')) }}
                        {!! Form::text('rounded_minutes', null, ['class' => 'form-control']) !!}
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