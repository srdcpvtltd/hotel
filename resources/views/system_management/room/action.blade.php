<div class="btn-group">
    <button class="btn btn-secondary" type="button">{{ __('Action') }}</button>
    <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split" type="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button>
    <div class="dropdown-menu" x-placement="bottom-start">
        <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-expanded="false"><i
                class="fas fa-ellipsis-h"></i></a>
        <a href="{{ route('rooms.edit', $room->id) }}" class=" dropdown-item"><i class="cil-pencil action-btn"></i>
            {{ __('Edit') }}</a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('rooms.index') }}" class="dropdown-item  text-danger" data-toggle="tooltip"
            data-original-title="{{ __('Delete') }}" onclick="delete_record('delete-form-{{ $room->id }}')"><i
                class="cil-trash action-btn"></i>{{ __('Delete') }}</a>
        {!! Form::open([
            'method' => 'DELETE',
            'route' => ['rooms.destroy', $room->id],
            'id' => 'delete-form-' . $room->id,
        ]) !!}
        {!! Form::close() !!}
    </div>
</div>
