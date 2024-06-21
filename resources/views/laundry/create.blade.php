@extends('layouts.admin')
@section('title')
    {{ __('Create Laundry') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a>
    <a class="breadcrumb-item" href="{{ route('laundry.index') }}">{{ __('Laundry') }}</a>
    <span class="breadcrumb-item active">{{ __('Create') }}</span>
@endsection
@section('content')
    {!! Form::open(['route' => 'laundry.store', 'method' => 'POST']) !!}
    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Create New Laundry') }} </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('name', __('Room')) }}
                            <select name="room_id" id="room_id" class="form-control">
                                <option value="">Select</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('name', __('Staff')) }}
                            <select name="assign_staff_id" id="assign_staff_id" class="form-control">
                                <option value="">Select</option>
                                @foreach ($staffs as $staff)
                                    <option value="{{ $staff->id }}">{{ $staff->name }} ({{ $staff->designation->designation }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('name', __('Status')) }}
                            <select name="status" id="status" class="form-control">
                                <option value="">Select</option>
                                <option value="0">In Progress</option>
                                <option value="1">Complete</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('name', __('Item')) }}
                            {!! Form::text('item[]', null, ['placeholder' => __('Item'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('name', __('Quantity')) }}
                            {!! Form::text('quantity[]', null, ['placeholder' => __('Quantity'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-1" style="top: 31px;" id="add_btn">
                        <button type="button" class="btn btn-primary">Add</button>
                    </div>
                </div>
                <div id="append_data"></div>
                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary', 'id' => 'submit']) }}
                <a class="btn btn-secondary" href="{{ route('laundry.index') }}"> {{ __('Back') }}</a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <div id="repeat_data" style="visibility: hidden;">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('name', __('Item')) }}
                    {!! Form::text('item[]', null, ['placeholder' => __('Item'), 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('name', __('Quantity')) }}
                    {!! Form::text('quantity[]', null, ['placeholder' => __('Quantity'), 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-1" style="top: 31px;">
                <button type="button" class="btn btn-danger dlt_btn">Delete</button>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#add_btn').on('click', function() {
                var data = $('#repeat_data').html();
                $('#append_data').append(data);
            });

            $(document).on('click', '.dlt_btn', function(e) {
                e.preventDefault();
                $(this).closest('.row').remove();
                return false;
            });
        });
    </script>
@endsection
