@extends('layouts.admin')
@section('title')
{{ __('Edit Vendor Category') }}
@endsection
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a>
<a class="breadcrumb-item" href="{{ route('vendor_category.index') }}">{{ __('Vendor Category') }}</a>
<span class="breadcrumb-item active">{{ __('Edit') }}</span>

@endsection
@section('content')

{!! Form::model($VendorCategory, ['method' => 'PATCH', 'route' => ['vendor_category.update', $VendorCategory->id]]) !!}
<div class="col-md-4 m-auto">
    <div class="card">
        <div class="card-header">{{ __('Edit Vendor Category') }} </div>
        <div class="card-body">
            <div class="form-group">
                {{ Form::label('name', __('Name')) }}
                {!! Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
            </div>
            {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary','id' => 'submit']) }}
            <a class="btn btn-secondary" href="{{ route('vendor_category.index') }}"> {{ __('Back') }}</a>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection