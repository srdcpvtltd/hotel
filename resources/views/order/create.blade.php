@extends('layouts.admin')
@section('title')
    {{ __('Create Order') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('order.index') }}">{{ __('Order') }}</a><span
        class="breadcrumb-item active">{{ __('Create') }}</span>
@endsection
@section('content')
    {!! Form::open(['route' => 'order.store', 'method' => 'POST']) !!}
    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Create New Order') }} </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Room</label>
                            <select class="form-select form-select-lg form-control select2" name="room_id" id="room_id">
                                <option value="">Select</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Food Category</label>
                            <select class="form-select form-select-lg form-control select2" name="food_category_id"
                                id="food_category_id">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Food Item</label>
                            <select class="form-select form-select-lg form-control select2" name="food_id" id="food_id">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('name', __('Price')) }}
                            {!! Form::text('price', null, [
                                'placeholder' => __('Price'),
                                'class' => 'form-control',
                                'id' => 'price',
                                'readonly',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('name', __('Quantity')) }}
                            {!! Form::text('quantity', null, [
                                'placeholder' => __('Quantity'),
                                'class' => 'form-control',
                                'id' => 'quantity',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('name', __('Total Price')) }}
                            {!! Form::text('total_price', null, [
                                'placeholder' => __('Total Price'),
                                'class' => 'form-control',
                                'id' => 'total_price',
                                'readonly'
                            ]) !!}
                        </div>
                    </div>
                </div>

                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}

                <a class="btn btn-secondary" href="{{ route('order.index') }}"> {{ __('Back') }}</a>
            </div>
            <div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#food_category_id').on('change', function() {
                var categoryId = $(this).val();
                $('#food_id').html('');
                $.ajax({
                    url: "{{ route('getFood') }}?category_id=" + categoryId,
                    type: 'get',
                    success: function(res) {
                        $('#food_id').html('<option value="">Select Food</option>');
                        $.each(res, function(key, value) {
                            $('#food_id').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
            $('#food_id').on('change', function() {
                var foodId = $(this).val();
                $.ajax({
                    url: "{{ route('getFoodPrice') }}?food_id=" + foodId,
                    type: 'get',
                    success: function(res) {
                        console.log(res);
                        $('#price').val(res.price);
                    }
                });
            });
            $('#quantity').on('keyup', function() {
                var qnt = $(this).val();
                var price = $('#price').val();
                var tot = price * qnt;
                console.log(tot);
                $('#total_price').val(tot);
            });
        });
    </script>
@endsection
