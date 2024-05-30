@extends('layouts.admin')
@section('title')
{{ __('Create Stocks') }}
@endsection
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a>
<a class="breadcrumb-item" href="{{ route('stock_inventory') }}">{{ __('Stocks') }}</a>
<span class="breadcrumb-item active">{{ __('Create') }}</span>

@endsection
@section('content')

{!! Form::open(['route' => 'stock.store', 'method' => 'POST']) !!}
<div class="col-md-4 m-auto">
    <div class="card">
        <div class="card-header">
            {{ __('Create New Stock') }}
        </div>
        <div class="card-body">
            <div class="form-group">
                {{ Form::label('name', __('Product Category')) }}
                <select name="product_category_id" id="product_category_id" class="form-control">
                    <option value="">Select</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {{ Form::label('name', __('Product')) }}
                <select name="product_id" id="product_id" class="form-control">
                    <option value="">Select</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {{ Form::label('name', __('Stock')) }}
                <select name="stock" id="stock" class="form-control">
                    <option value="">Select</option>
                    <option value="In">In</option>
                    <option value="Out">Out</option>
                </select>
            </div>
            <div class="form-group">
                {{ Form::label('name', __('Quantity')) }}
                {!! Form::text('quantity', null, ['placeholder' => __('Quantity'), 'class' => 'form-control']) !!}
            </div>
            {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}
            <a class="btn btn-secondary" href="{{ route('stock_inventory') }}"> {{ __('Back') }}</a>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection