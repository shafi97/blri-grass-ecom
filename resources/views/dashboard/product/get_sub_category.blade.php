@php $x = 1 @endphp
<option selected disabled value="">Choose...</option>
@foreach ($inputs as $input)
    <option value="{{ $input->id }}">{{ $input->name }}</option>
@endforeach
<style>
    p {
        font-size: 14px;
        line-height: 0;
        margin-bottom: 0;
    }
</style>
