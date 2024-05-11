<div class="btn-group">
    <button class="btn btn-secondary" type="button">{{ __('Action') }}</button>
    <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split" type="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
            class="sr-only">Toggle Dropdown</span></button>
    <div class="dropdown-menu" x-placement="bottom-start">
        <a href="#" class="action-item" role="button" data-toggle="dropdown"
            aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
        @can('edit-Designation')
            <a href="{{ route('designation.edit', $designation->id) }}" class=" dropdown-item"><i
                    class="cil-pencil action-btn"></i>
                {{ __('Edit') }}</a>
        @endcan
        <div class="dropdown-divider"></div>
        @can('delete-Designation')
            <a href="{{ route('designation.index') }}" class="dropdown-item  text-danger"
                data-toggle="tooltip" data-original-title="{{ __('Delete') }}"
                onclick="delete_record('delete-form-{{ $designation->id }}')"><i
                    class="cil-trash action-btn"></i>{{ __('Delete') }}</a>
            {!! Form::open(['method' => 'DELETE', 'route' => ['designation.destroy', $designation->id], 'id' => 'delete-form-' . $designation->id]) !!}
            {!! Form::close() !!}
        @endcan
    </div>
</div>
