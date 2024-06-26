@extends('layouts.admin')
@section('title')
    {{ __('Edit Expense') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('expenses.index') }}">{{ __('Expense') }}</a><span
        class="breadcrumb-item active">{{ __('Edit') }}</span>
@endsection
@section('content')
    {!! Form::model($Expense, ['method' => 'PATCH', 'route' => ['expenses.update', $Expense->id]]) !!}
    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Edit Expense') }} </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Category')) }}
                            <select name="category_id" id="category" class="form-control">
                                <option value="">Select</option>
                                @foreach ($category as $categoryy)
                                    <option value="{{ $categoryy->id }}" {{ ($categoryy->id == $Expense->category_id) ? 'selected':'' }}>{{ $categoryy->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Purchase Type')) }}
                            <select name="purchase_type" id="purchase_type" class="form-control">
                                <option value="">Select</option>
                                <option value="Local" {{ ($Expense->purchase_type == "Local") ? 'selected':'' }}>Local</option>
                                <option value="Vendor" {{ ($Expense->purchase_type == "Vendor") ? 'selected':'' }}>Vendor</option>
                            </select>
                        </div>
                    </div>
                    @if($Expense->vendor_id != 0)
                    <div class="col-md-3" id="vendor">
                        <div class="form-group">
                            {{ Form::label('name', __('Vendor')) }}
                            <select name="vendor_id" id="vendor_id" class="form-control">
                                <option value="">Select</option>
                                @foreach ($vendor as $vendors)
                                    <option value="{{ $vendors->id }}" {{ ($vendors->id == $Expense->vendor_id) ? 'selected':'' }}>{{ $vendors->name }}
                                        ({{ $vendors->category->name }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
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
                                <option value="Online" {{ ($Expense->payment_mode == "Online") ? 'selected':'' }}>Online</option>
                                <option value="Cash" {{ ($Expense->payment_mode == "Cash") ? 'selected':'' }}>Cash</option>
                                <option value="UPI" {{ ($Expense->payment_mode == "UPI") ? 'selected':'' }}>UPI</option>
                                <option value="Unpaid" {{ ($Expense->payment_mode == "Unpaid") ? 'selected':'' }}>Unpaid</option>
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
@endsection
