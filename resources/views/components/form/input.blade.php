@props(['name', 'label'])
@php
    $value = old($name);
@endphp
<div class="form-floating">
    <input name="{{ $name }}" class="form-control @error($name) is-invalid @enderror"{{ $name }}"
        value="{{ $value }}" {{ $attributes }}>
    <label for="{{ $name }}">{{ $label }}</label>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
