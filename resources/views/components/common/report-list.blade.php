<div>
    <x-form.select name="reportId" id="reportId" required>
        <option value="">--Select--</option>
        @foreach ($reports as $arr)
                <option value="{{ $arr->id }}">
                    {{ $arr->name }}
                </option>

        @endforeach
    </x-form.select>
</div>
