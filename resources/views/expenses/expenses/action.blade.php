<div class="btn-group">
    <button class="btn btn-secondary" type="button">{{ __('Action') }}</button>
    <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split" type="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button>
    <div class="dropdown-menu" x-placement="bottom-start">
        <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-expanded="false"><i
                class="fas fa-ellipsis-h"></i></a>
        <a href="{{ route('vendors.show', $vendor->id) }}" class="dropdown-item"><i class="cil-eye action-btn"></i>
            {{ __('Show') }}</a>
        <a href="{{ route('vendors.edit', $vendor->id) }}" class="dropdown-item"><i class="cil-pencil action-btn"></i>
            {{ __('Edit') }}</a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('vendors.index') }}" class="dropdown-item  text-danger" data-toggle="tooltip"
            data-original-title="{{ __('Delete') }}" onclick="delete_record('delete-form-{{ $vendor->id }}')"><i
                class="cil-trash action-btn"></i>{{ __('Delete') }}</a>
        {!! Form::open([
            'method' => 'DELETE',
            'route' => ['vendors.destroy', $vendor->id],
            'id' => 'delete-form-' . $vendor->id,
        ]) !!}
        {!! Form::close() !!}
    </div>
</div>
