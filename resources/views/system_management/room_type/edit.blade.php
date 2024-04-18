@extends('layouts.admin')
@section('title')
{{ __('Edit Room Type') }}
@endsection
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item" href="{{ route('cities.index') }}">{{ __('Room Type') }}</a><span class="breadcrumb-item active">{{ __('Edit') }}</span>

@endsection
@section('content')

{!! Form::model($room_type, ['method' => 'PATCH', 'route' => ['room_type.update', $room_type->id]]) !!}
<div class="col-md-4 m-auto">
    <div class="card">
        <div class="card-header">{{ __('Edit Room Type') }} </div>
        <div class="card-body">
            <div class="form-group">
                {{ Form::label('name', __('Room Type')) }}
                {!! Form::text('room_type', null, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {{ Form::label('name', __('Description')) }}
                <textarea name="description" id="description" cols="30" rows="3" class="form-control mb-3">{{ $room_type->description }}</textarea>
            </div>
            {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}

            <a class="btn btn-secondary" href="{{ route('cities.index') }}"> {{ __('Back') }}</a>
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
                url: "{{ route('getCities') }}?country_id=" + countryId,
                type: 'get',
                success: function(res) {
                    $('#state').html('<option value="">Select State</option>');
                    $.each(res, function(key, value) {
                        $('#state').append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#city').html('<option value="">Select City</option>');
                }
            });
        });
    });
</script>
@endsection