@extends('layouts.admin')
@section('title')
    {{ __('Create Room Type') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('room_type.index') }}">{{ __('Room Type') }}</a><span
        class="breadcrumb-item active">{{ __('Create') }}</span>

@endsection
@section('content')

    {!! Form::open(['route' => 'room_type.store', 'method' => 'POST']) !!}
    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Create New Room Type') }} </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name', __('Room Type')) }}
                    {!! Form::text('room_type', null, ['placeholder' => __('Name'),  'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {{ Form::label('name', __('Description')) }}
                    <textarea name="description" id="description" cols="30" rows="3" class="form-control mb-3"></textarea>

                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}

                <a class="btn btn-secondary" href="{{ route('cities.index') }}"> {{ __('Back') }}</a>
            </div>
            <div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
