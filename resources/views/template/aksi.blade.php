{!! Form::open(['route' => [$route.'.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
    {!! link_to_route($route.'.edit', ' Ubah', $data->id, ['class' => 'btn btn-primary'] ) !!}
    {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirmation();"]) !!}

{!! Form::close() !!}