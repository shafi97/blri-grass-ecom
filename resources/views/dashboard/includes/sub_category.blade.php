<option value="">Choose..</option>
@foreach ($datum as $data)
    <option value="{{ $data->id }}">{{ $data->name }}</option>
@endforeach
