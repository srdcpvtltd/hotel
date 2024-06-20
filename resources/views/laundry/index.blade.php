@extends('layouts.admin')
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a>
    <span class="breadcrumb-item active">{{ __('Laundry') }}</span>
@endsection
@section('title')
    {{ __('Laundry') }}
@endsection
@section('css')
    @include('layouts.datatables_css')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="fade-in guest-register">
            <div class="card">
                <div class="card-header"><i class="fa fa-align-justify"></i>
                    <h4>{{ __('Laundry') }}</h4>
                </div>
                <div class="card-body">
                    {{ $dataTable->table(['width' => '100%', 'class' => 'table table-responsive-sm table-striped']) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    @include('layouts.datatables_js')
    {{ $dataTable->scripts() }}
@endsection