@extends('layouts.admin')
@section('title')
    {{ __('Edit Hotel Staff') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('designation.index') }}">{{ __('Hotel Staff') }}</a><span
        class="breadcrumb-item active">{{ __('Edit') }}</span>
@endsection
@section('content')
    {!! Form::model($hotel_staff, ['method' => 'PATCH', 'route' => ['hotel_staff.update', $hotel_staff->id]]) !!}
    <div class="col-md-8 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Edit Hotel Staff') }} </div>
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
                                <select name="designation_id" id="designation" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($designation as $desg)
                                        <option value="{{ $desg->id }}" @if($desg->id == $hotel_staff->designation_id) selected @endif>{{ $desg->designation }}</option>
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
                                    <option value="Morning" @if($hotel_staff->shift == "Morning") selected @endif>Morning</option>
                                    <option value="Night" @if($hotel_staff->shift == "Night") selected @endif>Night</option>
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
