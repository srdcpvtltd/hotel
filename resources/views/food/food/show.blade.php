@extends('layouts.admin')
@section('title')
    {{ __('Vendor Details') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('vendors.index') }}">{{ __('Vendor') }}</a><span
        class="breadcrumb-item active">{{ __('Show') }}</span>
@endsection
@section('content')
    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Vendor Details') }} </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Category</th>
                            <td>{{ $Vendor->category->name }}</td>
                            <th>Name</th>
                            <td>{{ $Vendor->name }}</td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td>{{ $Vendor->email }}</td>
                            <th>Mobile No.</th>
                            <td>{{ $Vendor->mobile_no }}</td>
                        </tr>
                        <tr>
                            <th>GST No.</th>
                            <td>{{ $Vendor->gst_no }}</td>
                            <th>Contact Person Name</th>
                            <td>{{ $Vendor->contact_person_name }}</td>
                        </tr>
                        <tr>
                            <th>Contact Person Email</th>
                            <td>{{ $Vendor->contact_person_email }}</td>
                            <th>Contact Person Mobile</th>
                            <td>{{ $Vendor->contact_person_mobile }}</td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td>{{ $Vendor->country->name }}</td>
                            <th>State</th>
                            <td>{{ $Vendor->state->name }}</td>
                        </tr>
                        <tr>
                            <th>District</th>
                            <td>{{ $Vendor->district->name }}</td>
                            <th>City</th>
                            <td>{{ $Vendor->city }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td colspan="3">{{ $Vendor->address }}</td>
                        </tr>

                    </tbody>
                </table>
                <a class="btn btn-secondary" href="{{ route('vendors.index') }}"> {{ __('Back') }}</a>
            </div>
        </div>
    </div>
@endsection
