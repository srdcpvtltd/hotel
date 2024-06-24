@extends('layouts.admin')
@section('title')
    {{ __('Create Vendor') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a>
    <a class="breadcrumb-item" href="{{ route('vendors.index') }}">{{ __('Vendor') }}</a>
    <span class="breadcrumb-item active">{{ __('Create') }}</span>
@endsection
@section('content')
    {!! Form::open(['route' => 'vendors.store', 'method' => 'POST']) !!}
    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Create New Vendor') }} </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Category')) }}
                            <select name="category_id" id="category" class="form-control">
                                <option value="">Select</option>
                                @foreach ($category as $categoryy)
                                    <option value="{{ $categoryy->id }}">{{ $categoryy->name }}</option>
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
                            {{ Form::label('name', __('Email')) }}
                            {!! Form::text('email', null, ['placeholder' => __('Email'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Mobile No.')) }}
                            {!! Form::text('mobile_no', null, ['placeholder' => __('Mobile No.'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Address')) }}
                            {!! Form::text('address', null, ['placeholder' => __('Address'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Country')) }}
                            <select name="country_id" id="country" class="form-control">
                                <option value="">Select</option>
                                @foreach ($country as $countryy)
                                    <option value="{{ $countryy->id }}">{{ $countryy->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('State')) }}
                            <select name="state_id" id="state" class="form-control">
                                <option value="">Select</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('District')) }}
                            <select name="district_id" id="district" class="form-control">
                                <option value="">Select</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('City')) }}
                            {!! Form::text('city', null, ['placeholder' => __('City'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('GST No.')) }}
                            {!! Form::text('gst_no', null, ['placeholder' => __('GST No.'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Contact Person Name')) }}
                            {!! Form::text('contact_person_name', null, ['placeholder' => __('Contact Person Name'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Contact Person Mobile')) }}
                            {!! Form::text('contact_person_mobile', null, ['placeholder' => __('Contact Person Mobile No.'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Contact Person Email')) }}
                            {!! Form::text('contact_person_email', null, ['placeholder' => __('Contact Person Email'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>


                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary', 'id' => 'submit']) }}
                <a class="btn btn-secondary" href="{{ route('rooms.index') }}"> {{ __('Back') }}</a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
@endsection
