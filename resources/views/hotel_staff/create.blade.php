@extends('layouts.admin')
@section('title')
    {{ __('Create Hotel Staff') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('hotel_staff.index') }}">{{ __('Hotel Staff') }}</a><span
        class="breadcrumb-item active">{{ __('Create') }}</span>
@endsection
@section('content')
    {!! Form::open(['route' => 'hotel_staff.store', 'method' => 'POST']) !!}
    <div class="col-md-8 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Create New Hotel Staff') }} </div>
            <div class="card-body">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                {{ Form::label('name', __('Hotel Staff Name')) }}
                                {!! Form::text('name', null, ['placeholder' => __('Enter Name'), 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                {{ Form::label('name', __('Contact number')) }}
                                {!! Form::text('contact_no', null, ['placeholder' => __('Enter Contact Number'), 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                {{ Form::label('name', __('Designation')) }}
                                <select name="designation" id="designation" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($designation as $desg)
                                    <option value="{{ $desg->id }}">{{ $desg->designation }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                {{ Form::label('name', __('Salary')) }}
                                {!! Form::text('salary', null, ['placeholder' => __('Enter Salary'), 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                {{ Form::label('name', __('Shift')) }}
                                <select name="shift" id="shift" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Morning">Morning</option>
                                    <option value="Night">Night</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}

                <a class="btn btn-secondary" href="{{ route('hotel_staff.index') }}"> {{ __('Back') }}</a>
            </div>
            <div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
