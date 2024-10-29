<div class="form-group" style="width: 70%;">
    @if($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <select name="{{ $name }}" id="{{ $name }}" class="form-control">
        @foreach($options as $value => $text)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $text }}</option>
        @endforeach
    </select>
</div>
