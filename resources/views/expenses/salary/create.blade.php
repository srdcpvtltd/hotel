@extends('layouts.admin')
@section('title')
    {{ __('Create salary') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a>
    <a class="breadcrumb-item" href="{{ route('salary.index') }}">{{ __('salary') }}</a>
    <span class="breadcrumb-item active">{{ __('Create') }}</span>
@endsection
@section('content')
    {!! Form::open(['route' => 'salary.store', 'method' => 'POST']) !!}
    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Create New salary') }} </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Staff')) }}
                            <select name="staff_id" id="staff_id" class="form-control">
                                <option value="">Select</option>
                                @foreach ($staff as $staffs)
                                    <option value="{{ $staffs->id }}">{{ $staffs->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Salary')) }}
                            {!! Form::text('salary', null, ['placeholder' => __('Salary'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary', 'id' => 'submit']) }}
                <a class="btn btn-secondary" href="{{ route('salary.index') }}"> {{ __('Back') }}</a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
