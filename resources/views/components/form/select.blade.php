@props(['disabled' => false, 'name', 'label' => ''])

<x-form.field>

    @if ($attributes->has('required'))
        <div class="flex items-center gap-1">
            <!-- <x-form.label name="{{ $name }}" label="{{ $label }}" /> -->
            <!-- <span class="text-danger fw-bold">*</span> -->
        </div>
    @else
        <!-- <x-form.label name="{{ $name }}" label="{{ $label }}"/> -->
    @endif

    <select {{ $disabled ? 'disabled' : '' }}
            {!! $attributes->merge(['class' => 'form-select']) !!}
            id = "{{ $name }}"
            name = "{{ $name }}"
    >
        {{ $slot }}
    </select>

    <x-form.error name="{{ $name }}"/>

</x-form.field>
