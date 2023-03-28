@props(['name', 'label'])
@php
    $value = old($name);
@endphp
<div class="form-floating">
    <textarea name="{{ $name }}" id="{{ $name }}" class="form-control @error($name) is-invalid @enderror" {{ $attributes }}>{{ $value }}</textarea>
    <label for="{{ $name }}">{{ $label }}</label>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
