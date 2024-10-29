<div class="form-group mb-3" style="width: 70%;">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" id="{{ $name }}" class="form-control" value="{{ old($name, $value ?? '') }}" placeholder="{{ $placeholder ?? '' }}" required="{{ $required ?? false ? 'required' : '' }}">
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
