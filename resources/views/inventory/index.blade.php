@extends('layouts.admin')
@section('title')
    {{ __('Stock & Inventory') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><span
        class="breadcrumb-item active">{{ __('Stock & Inventory') }}</span>
@endsection
@section('css')
    @include('layouts.datatables_css')
    <style>
        .pt_10 {
            padding-top: 10px;
        }

        .pb_10 {
            padding-bottom: 10px;
        }

        .dgn {
            color: #a42121;
            font-size: 35px;
        }

        .bos_shadow {
            border: 0;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, .14), 0 3px 1px -2px rgba(0, 0, 0, .2), 0 1px 5px 0 rgba(0, 0, 0, .12);
        }

        .cntnr_height {
            height: 400px;
        }

        p {
            color: #000;
        }

        a {
            text-decoration: none !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Stock & Inventory') }}</h4>
                        </div>
                        <div class="container cntnr_height">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3 mt-3 mb-3">
                                        <a href="{{ url('product_category') }}">
                                            <div class="border pt_10 pb_10 text-center align-middle bos_shadow">
                                                {{-- <p class="mb-0"><i class="cil-room dgn"></i></p> --}}
                                                <p class="mb-0">Products Category</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 mt-3 mb-3">
                                        <a href="{{ url('product') }}">
                                            <div class="border pt_10 pb_10 text-center align-middle bos_shadow">
                                                {{-- <p class="mb-0"><i class="cil-calculator dgn"></i></p> --}}
                                                <p class="mb-0">Products</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 mt-3 mb-3">
                                        <a href="{{ url('stock') }}">
                                            <div class="border pt_10 pb_10 text-center align-middle bos_shadow">
                                                {{-- <p class="mb-0"><i class="cil-bed dgn"></i></p> --}}
                                                <p class="mb-0">Stock</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
