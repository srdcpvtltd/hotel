@extends('layouts.admin')
@section('title')
{{ __('Edit Room') }}
@endsection
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item" href="{{ route('cities.index') }}">{{ __('Room') }}</a><span class="breadcrumb-item active">{{ __('Edit') }}</span>

@endsection
@section('content')

{!! Form::model($room, ['method' => 'PATCH', 'route' => ['rooms.update', $room->id]]) !!}
<div class="col-md-4 m-auto">
    <div class="card">
        <div class="card-header">{{ __('Create New Room') }} </div>
        <div class="card-body">
            <div class="form-group">
                {{ Form::label('name', __('Room Name')) }}
                {!! Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {{ Form::label('name', __('Room Type')) }}
                <select name="room_type_id" id="room_type_id" class="form-control">
                    <option value="">Select</option>
                    @foreach($room_type as $roomtype)
                    <option value="{{ $roomtype->id }}" @if($room->room_type_id == $roomtype->id) selected @endif>{{ $roomtype->room_type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {{ Form::label('name', __('Price')) }}
                {!! Form::text('price', null, ['placeholder' => __('Price'),'id' => 'price', 'class' => 'form-control', 'readonly']) !!}
            </div>
            {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary','id' => 'submit']) }}
            <a class="btn btn-secondary" href="{{ route('rooms.index') }}"> {{ __('Back') }}</a>
        </div>
    </div>
</div>
{!! Form::close() !!}
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#room_type_id').on('change', function() {
            var RoomTypeId = this.value;
            $('#price').html('');
            $.ajax({
                url: "{{ route('getPrice') }}?Roomtype_id=" + RoomTypeId,
                type: 'get',
                success: function(res) {
                    if(res == "No Price Rules Created"){
                        $('#price').val(res);
                        $('#submit').attr("disabled", true);
                    } else {
                        $('#price').val(res);
                        $('#submit').attr("disabled", false);
                    }
                }
            });
        });
    });
</script>
@endsection