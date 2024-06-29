@extends('layouts.admin')
@section('title')
{{ __('Create Food Category') }}
@endsection
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a>
<a class="breadcrumb-item" href="{{ route('food.management') }}">{{ __('Food Management') }}</a>
<a class="breadcrumb-item" href="{{ route('food_category.index') }}">{{ __('Category') }}</a>
<span class="breadcrumb-item active">{{ __('Create') }}</span>

@endsection
@section('content')

{!! Form::open(['route' => 'food_category.store', 'method' => 'POST']) !!}
<div class="col-md-4 m-auto">
    <div class="card">
        <div class="card-header">{{ __('Create New Food Category') }} </div>
        <div class="card-body">
            <div class="form-group">
                {{ Form::label('name', __('Name')) }}
                {!! Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
            </div>
            {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary','id' => 'submit']) }}
            <a class="btn btn-secondary" href="{{ route('food_category.index') }}"> {{ __('Back') }}</a>
        </div>
    </div>
</div>
{!! Form::close() !!}

@endsection