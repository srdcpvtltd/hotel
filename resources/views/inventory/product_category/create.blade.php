@extends('layouts.admin')
@section('title')
{{ __('Create Product Category') }}
@endsection
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a>
<a class="breadcrumb-item" href="{{ route('product_category.index') }}">{{ __('Product Category') }}</a>
<span class="breadcrumb-item active">{{ __('Create') }}</span>

@endsection
@section('content')

{!! Form::open(['route' => 'product_category.store', 'method' => 'POST']) !!}
<div class="col-md-4 m-auto">
    <div class="card">
        <div class="card-header">{{ __('Create New Product Category') }} </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('name', __('Name')) }}
                        {!! Form::text('name', '', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}
            <a class="btn btn-secondary" href="{{ route('product_category.index') }}"> {{ __('Back') }}</a>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection