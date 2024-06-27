@extends('layouts.admin')
@section('title')
    {{ __('Expense Details') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('expenses.index') }}">{{ __('Expense') }}</a><span
        class="breadcrumb-item active">{{ __('Show') }}</span>
@endsection
@section('content')
    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Expense Details') }} </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Category</th>
                            <td>{{ $Expense->category->name }}</td>
                            <th>Purchase Type</th>
                            <td>{{ $Expense->purchase_type }}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ $Expense->title }}</td>
                            @if ($Expense->vendor_id != 0)
                                <th>Vendor</th>
                                <td>{{ $Expense->vendor->name }}</td>
                            @else
                            <th></th>
                            <td></td>
                            @endif
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td>{{ $Expense->amount }}/-</td>
                            <th>Date</th>
                            <td>{{ $Expense->date }}</td>
                        </tr>
                        <tr>
                            <th>Remark</th>
                            <td>{{ $Expense->remark }}</td>
                            <th>Payment Mode</th>
                            <td>{{ $Expense->payment_mode }}</td>
                        </tr>
                    </tbody>
                </table>
                <a class="btn btn-secondary" href="{{ route('expenses.index') }}"> {{ __('Back') }}</a>
            </div>
        </div>
    </div>
@endsection
