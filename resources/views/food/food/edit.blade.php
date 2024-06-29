@extends('layouts.admin')
@section('title')
    {{ __('Edit Food Item') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a>
    <a class="breadcrumb-item" href="{{ route('food.management') }}">{{ __('Food Management') }}</a>
    <a class="breadcrumb-item" href="{{ route('food.index') }}">{{ __('Food Item') }}</a>
    <span class="breadcrumb-item active">{{ __('Edit') }}</span>
@endsection
@section('content')
    {!! Form::model($food, ['method' => 'PATCH', 'route' => ['food.update', $food->id]]) !!}
    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Edit Food Item') }} </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Category')) }}
                            <select name="category_id" id="category" class="form-control">
                                <option value="">Select</option>
                                @foreach ($category as $categoryy)
                                    <option value="{{ $categoryy->id }}"
                                        {{ $categoryy->id == $food->category_id ? 'selected' : '' }}>
                                        {{ $categoryy->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Name')) }}
                            {!! Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Price')) }}
                            {!! Form::text('price', null, ['placeholder' => __('Price'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary', 'id' => 'submit']) }}
                <a class="btn btn-secondary" href="{{ route('food.index') }}"> {{ __('Back') }}</a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
