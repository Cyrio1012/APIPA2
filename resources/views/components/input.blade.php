<!-- resources/views/components/input.blade.php -->
@props(['type' => 'text', 'name', 'label' => '', 'value' => ''])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block font-medium">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
           value="{{ old($name, $value) }}"
           {{ $attributes->merge(['class' => 'border rounded w-full p-2']) }}>
    @error($name)
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>
