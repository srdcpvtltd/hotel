@extends('layouts.admin')
@section('title')
    {{ __('Edit Laundry') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a>
    <a class="breadcrumb-item" href="{{ route('laundry.index') }}">{{ __('Laundry') }}</a>
    <span class="breadcrumb-item active">{{ __('Edit') }}</span>
@endsection
@section('content')
    {!! Form::model($laundry, ['method' => 'PATCH', 'route' => ['laundry.update', $laundry->id]]) !!}
    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Edit Laundry') }} </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('name', __('Room')) }}
                            <select name="room_id" id="room_id" class="form-control">
                                <option value="">Select</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}" @if ($room->id == $laundry->room_id) selected @endif>
                                        {{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('name', __('Staff')) }}
                            <select name="assign_staff_id" id="assign_staff_id" class="form-control">
                                <option value="">Select</option>
                                @foreach ($staffs as $staff)
                                    <option value="{{ $staff->id }}" @if ($staff->id == $laundry->assign_staff_id) selected @endif>
                                        {{ $staff->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('name', __('Status')) }}
                            <select name="status" id="status" class="form-control">
                                <option value="">Select</option>
                                <option value="0" @if ($laundry->status == '0') selected @endif>In Progress
                                </option>
                                <option value="1" @if ($laundry->status == '1') selected @endif>Complete</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('name', __('Item')) }}
                            {!! Form::text('item', null, ['placeholder' => __('Item'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('name', __('Quantity')) }}
                            {!! Form::text('quantity', null, ['placeholder' => __('Quantity'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary', 'id' => 'submit']) }}
                <a class="btn btn-secondary" href="{{ route('laundry.index') }}"> {{ __('Back') }}</a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
