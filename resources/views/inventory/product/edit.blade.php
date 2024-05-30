@extends('layouts.admin')
@section('title')
{{ __('Edit Product') }}
@endsection
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a>
<a class="breadcrumb-item" href="{{ route('cities.index') }}">{{ __('Product') }}</a>
<span class="breadcrumb-item active">{{ __('Edit') }}</span>

@endsection
@section('content')

{!! Form::model($product, ['method' => 'PATCH', 'route' => ['product.update', $product->id]]) !!}
<div class="col-md-4 m-auto">
    <div class="card">
        <div class="card-header">{{ __('Edit Product') }} </div>
        <div class="card-body">
            <div class="form-group">
                {{ Form::label('name', __('Product Category')) }}
                <select name="product_category_id" id="product_category_id" class="form-control">
                    <option value="">Select</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $product->product_category_id) Selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {{ Form::label('name', __('Name')) }}
                {!! Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
            </div>

            {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary','id' => 'submit']) }}
            <a class="btn btn-secondary" href="{{ route('product.index') }}"> {{ __('Back') }}</a>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection