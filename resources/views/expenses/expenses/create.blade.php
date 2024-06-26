@extends('layouts.admin')
@section('title')
    {{ __('Create Expenses') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a>
    <a class="breadcrumb-item" href="{{ route('expenses.index') }}">{{ __('Expenses') }}</a>
    <span class="breadcrumb-item active">{{ __('Create') }}</span>
@endsection
@section('content')
    {!! Form::open(['route' => 'expenses.store', 'method' => 'POST']) !!}
    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Create New Expenses') }} </div>
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
                            {{ Form::label('name', __('Purchase Type')) }}
                            <select name="purchase_type" id="purchase_type" class="form-control">
                                <option value="">Select</option>
                                <option value="Local">Local</option>
                                <option value="Vendor">Vendor</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" id="vendor">
                        <div class="form-group">
                            {{ Form::label('name', __('Vendor')) }}
                            <select name="vendor_id" id="vendor_id" class="form-control">
                                <option value="">Select</option>
                                @foreach ($vendor as $vendors)
                                    <option value="{{ $vendors->id }}">{{ $vendors->name }} ({{ $vendors->category->name }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Title')) }}
                            {!! Form::text('title', null, ['placeholder' => __('Title'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Amount')) }}
                            {!! Form::text('amount', null, ['placeholder' => __('Amount'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Date')) }}
                            {!! Form::date('date', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Remark')) }}
                            {!! Form::text('remark', null, ['placeholder' => __('Remark'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Payment Mode')) }}
                            <select name="payment_mode" id="payment_mode" class="form-control">
                                <option value="">Select</option>
                                <option value="Online">Online</option>
                                <option value="Cash">Cash</option>
                                <option value="UPI">UPI</option>
                                <option value="Unpaid">Unpaid</option>
                            </select>
                        </div>
                    </div>
                </div>
                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary', 'id' => 'submit']) }}
                <a class="btn btn-secondary" href="{{ route('expenses.index') }}"> {{ __('Back') }}</a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#vendor').hide();
            $('#purchase_type').on('change', function() {
                var purchase_type = $(this).val();
                if (purchase_type == "Vendor") {
                    $('#vendor').show();
                } else {
                    $('#vendor').hide();
                }
            });
        });
    </script>
@endsection
