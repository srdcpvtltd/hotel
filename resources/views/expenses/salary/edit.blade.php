@extends('layouts.admin')
@section('title')
    {{ __('Edit Expense') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('salary.index') }}">{{ __('Expense') }}</a><span
        class="breadcrumb-item active">{{ __('Edit') }}</span>
@endsection
@section('content')
    {!! Form::model($salary, ['method' => 'PATCH', 'route' => ['salary.update', $salary->id]]) !!}
    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Edit Expense') }} </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Staff')) }}
                            <select name="staff_id" id="staff_id" class="form-control">
                                <option value="">Select</option>salary
                                @foreach ($staff as $staffs)
                                    <option value="{{ $staffs->id }}" {{ ($staffs->id == $salary->vendor_id) ? 'selected':'' }}>{{ $staffs->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Salary')) }}
                            {!! Form::text('salary', $salary->amount, ['placeholder' => __('Salary'), 'class' => 'form-control']) !!}
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
