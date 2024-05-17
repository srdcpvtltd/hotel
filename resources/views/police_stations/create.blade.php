@extends('layouts.admin')
@section('title')
    {{ __('Create Police Station') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('police_stations.index') }}">{{ __('Police Station') }}</a><span
        class="breadcrumb-item active">{{ __('Create') }}</span>

@endsection
@section('content')

    {!! Form::open(['route' => 'police_stations.store', 'method' => 'POST']) !!}
    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Create New Police Station') }} </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name', __('Name')) }}
                    {!! Form::text('code', null, ['placeholder' => __('Name'),  'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label>Country</label>
                    <select  class="form-select form-select-lg form-control select2" name="country_id" id="country">
                        <option value="" selected>Select country</option>
                        @foreach ($countries as $country)
                        <option value="{{ $country->id }}" @if(isset($inputs) && isset($inputs['country_id']) && $inputs['country_id'] == $country->id) selected @endif>{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>State</label>
                    <select  name="state_id" class="form-select form-select-lg form-control select2" id="state">
                        <option value="">Select State</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>District</label>
                    <select  name="district_id" class="form-select form-select-lg form-control select2" id="district">
                        <option value="">Select District</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <select  name="city_id" class="form-select form-select-lg form-control select2" id="city">
                        <option value="">Select City</option>
                    </select>
                </div>
                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}

                <a class="btn btn-secondary" href="{{ route('police_stations.index') }}"> {{ __('Back') }}</a>
            </div>
            <div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#country').on('change', function() {
            var countryId = this.value;
            $('#state').html('');
            $.ajax({
                url: "{{ route('getStates') }}?country_id=" + countryId,
                type: 'get',
                success: function(res) {
                    $('#state').html('<option value="">Select State</option>');
                    $.each(res, function(key, value) {
                        $('#state').append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#district').html('<option value="">Select District</option>');
                }
            });
        });
        $('#state').on('change', function() {
            var stateId = this.value;
            $('#district').html('');
            $.ajax({
                url: "{{ route('getDistricts') }}?state_id=" + stateId,
                type: 'get',
                success: function(res) {
                    $('#district').html('<option value="">Select District</option>');
                    $.each(res, function(key, value) {
                        $('#district').append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#city').html('<option value="">Select City</option>');
                }
            });
        });
        $('#district').on('change', function() {
            var districtId = this.value;
            $('#city').html('');
            $.ajax({
                url: "{{ route('getCities') }}?district_id=" + districtId,
                type: 'get',
                success: function(res) {
                    $('#city').html('<option value="">Select City</option>');
                    $.each(res, function(key, value) {
                        $('#city').append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
</script>
@endsection
