@extends('layouts.admin')
@section('title')
    {{ __('Edit Plan') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('police_stations.index') }}">{{ __('Plan') }}</a><span
        class="breadcrumb-item active">{{ __('Edit') }}</span>
@endsection
@section('content')
    {!! Form::model($plan, ['method' => 'PATCH', 'route' => ['plans.update', $plan->id]]) !!}
    <div class="col-md-10 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Edit District') }} </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name', __('Name')) }}
                    {!! Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {{ Form::label('name', __('Price')) }}
                    {!! Form::text('price', null, ['placeholder' => __('Price'), 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="role_id" id="role">
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                            @if ($role->name != 'admin' && $role->name != 'user' && $role->name != 'viewer' && $role->name != 'free')
                                <option value="{{ $role->id }}" @if($role->id == $plan->role_id) selected @endif>{{ $role->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {{ Form::label('name', __('Modules')) }}
                    {!! Form::textarea('modules', null, ['placeholder' => __('Modules'), 'class' => 'form-control', 'rows' => '4']) !!}
                </div>
                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}

                <a class="btn btn-secondary" href="{{ route('plans.index') }}"> {{ __('Back') }}</a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
