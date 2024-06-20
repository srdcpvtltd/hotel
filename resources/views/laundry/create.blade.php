@extends('layouts.admin')
@section('title')
    {{ __('Create Housekeeping') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a>
    <a class="breadcrumb-item" href="{{ route('housekeeping.index') }}">{{ __('Housekeeping') }}</a>
    <span class="breadcrumb-item active">{{ __('Create') }}</span>
@endsection
@section('content')
    {!! Form::open(['route' => 'housekeeping.store', 'method' => 'POST']) !!}
    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Create New Housekeeping') }} </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name', __('Room')) }}
                    <select name="room_id" id="room_id" class="form-control">
                        <option value="">Select</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {{ Form::label('name', __('Staff')) }}
                    <select name="assign_staff_id" id="assign_staff_id" class="form-control">
                        <option value="">Select</option>
                        @foreach ($staffs as $staff)
                            <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {{ Form::label('name', __('Status')) }}
                    <select name="status" id="status" class="form-control">
                        <option value="">Select</option>
                        <option value="0">In Progress</option>
                        <option value="1">Complete</option>
                    </select>
                </div>

                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary', 'id' => 'submit']) }}
                <a class="btn btn-secondary" href="{{ route('housekeeping.index') }}"> {{ __('Back') }}</a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@endsection
