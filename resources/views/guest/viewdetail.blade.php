@extends('layouts.admin')
@section('title')
    {{ __('Guest View Detail') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('admin.report') }}">{{ __('Report') }}</a><span
        class="breadcrumb-item active">{{ __('Guest View Detail') }}</span>
@endsection
<style>
    .detil-item {
        margin-top: 20px;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <section class="content">
                <div class="fade-in guest-register">
                    <div class="card">
                        <div class="fade-in guest-register">
                            <div class="card">
                            <div class="card-header">Guest Detail</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <b>Guest Name:</b> {{ $booking->gues_name }}
                                        </div>
                                        <div class="col-md-4">
                                            <b>Mobile Number:</b> {{ $booking->mobile_number }}
                                        </div>
                                        <div class="col-md-4">
                                            <b>Alternate Mobile Number:</b> {{ $booking->alter_mobile_number }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Age:</b> {{ $booking->age }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Gender:</b> {{ $booking->gender }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Guest Email Id:</b> {{ $booking->email_id }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Guest Arrived From:</b> {{ $booking->arrived_from }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Nationality:</b> {{ $booking->nationality }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Means of Transport:</b> {{ $booking->transport }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House Number:</b> {{ $booking->house_number }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House Lane:</b> {{ $booking->lane }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House Landmark:</b> {{ $booking->land_mark }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House Country:</b> {{ $booking->country->name }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House State:</b> {{ $booking->state->name }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House District:</b> {{ $booking->district->name }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House City:</b> {{ $booking->city->name }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House Town:</b> {{ $booking->present_town }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House Pin:</b> {{ $booking->present_pin }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House Number:</b> {{ $booking->p_house_number }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House Lane:</b> {{ $booking->p_lane }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House Landmark:</b> {{ $booking->p_land_mark }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House Country:</b> {{ $booking->p_country->name }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House State:</b> {{ $booking->p_state->name }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House District:</b> {{ $booking->p_district->name }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House City:</b> {{ $booking->p_city->name }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House Town:</b> {{ $booking->p_town }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House Pin:</b> {{ $booking->p_pin }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Local Contact Name:</b> {{ $booking->local_contact_name }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Local Contact Number:</b> {{ $booking->local_contact_number }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Arrival Date & Time:</b> {{ $booking->arrival_date }} {{ $booking->arrival_time }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>ID Type:</b> {{ $booking->id_type }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>ID Number:</b> {{ $booking->id_number }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Room Booked:</b> {{ $booking->room_booked }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Room Number:</b> @if($booking->rooms != []) @foreach($booking->rooms as $room){{ $room->room_number }} @if($booking->room_booked >= 2) , @endif @endforeach @endif
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Purpose of Visit:</b> {{ $booking->whom_to_visit }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Total Amount:</b> {{ $booking->total_amount }} Rs.
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Payment Method:</b> {{ $booking->payment_method }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Payment Status:</b> {{ $booking->payment_status }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
@endsection