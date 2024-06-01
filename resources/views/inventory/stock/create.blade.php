@extends('layouts.admin')
@section('title')
    {{ __('Create Stocks') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a>
    <a class="breadcrumb-item" href="{{ route('stock_inventory') }}">{{ __('Stocks') }}</a>
    <span class="breadcrumb-item active">{{ __('Create') }}</span>
@endsection
@section('content')
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    {!! Form::open(['route' => 'stock.store', 'method' => 'POST']) !!}
    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header">
                {{ __('Create New Stock') }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Product Category')) }}
                            <select name="product_category_id" id="product_category_id" class="form-control">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Product')) }}
                            <select name="product_id" id="product_id" class="form-control">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Stock')) }}
                            <select name="stock" id="stock" class="form-control">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('name', __('Quantity')) }}
                            {!! Form::text('quantity', null, ['placeholder' => __('Quantity'), 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}
                <a class="btn btn-secondary" href="{{ route('stock_inventory') }}"> {{ __('Back') }}</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js" defer="defer"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#product_category_id').on('change', function() {
                var ProductCategoryId = this.value;
                $.ajax({
                    url: "{{ route('getProduct') }}?ProductCategory_id=" + ProductCategoryId,
                    type: 'get',
                    success: function(res) {
                        $('#product_id').html('<option value="">Select</option>');
                        $.each(res, function(key, value) {
                            $('#product_id').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

            $('#product_id').on('change', function() {
                var ProductId = this.value;
                $.ajax({
                    url: "{{ route('getProductStock') }}?Product_id=" + ProductId,
                    type: 'get',
                    success: function(res) {
                        if (res > 0) {
                            $('#stock').html(
                                '<option value="">Select</option><option value="In">In</option><option value="Out">Out</option>'
                            );
                        } else {
                            $('#stock').html(
                                '<option value="">Select</option><option value="In">In</option>'
                            );
                        }
                    }
                });
            });

            $('#table').DataTable();
        });
    </script>
@endsection
