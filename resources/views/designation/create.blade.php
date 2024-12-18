@extends('layouts.admin')
@section('title')
    {{ __('Create Designation') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('designation.index') }}">{{ __('Designation') }}</a><span
        class="breadcrumb-item active">{{ __('Create') }}</span>

@endsection
@section('content')

    {!! Form::open(['route' => 'designation.store', 'method' => 'POST']) !!}
    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Create New Designation') }} </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name', __('Designation')) }}
                    {!! Form::text('designation', null, ['placeholder' => __('Enter Designation'),  'class' => 'form-control']) !!}
                </div>
                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}

                <a class="btn btn-secondary" href="{{ route('designation.index') }}"> {{ __('Back') }}</a>
            </div>
            <div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
