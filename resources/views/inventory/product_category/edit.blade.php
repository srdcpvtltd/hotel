@extends('layouts.admin')
@section('title')
{{ __('Edit Product Category') }}
@endsection
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a>
<a class="breadcrumb-item" href="{{ route('product_category.index') }}">{{ __('Product Category') }}</a>
<span class="breadcrumb-item active">{{ __('Edit') }}</span>

@endsection
@section('content')

{!! Form::model($product_category, ['method' => 'PATCH', 'route' => ['product_category.update', $product_category->id]]) !!}
<div class="col-md-8 m-auto">
    <div class="card">
        <div class="card-header">{{ __('Edit Product Category') }} </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('name', __('Name')) }}
                        {!! Form::text('name', $product_category->name , ['class' => 'form-control']) !!}
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