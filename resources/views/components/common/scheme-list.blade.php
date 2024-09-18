<div>
    <x-form.select name="schemeId" id="schemeId" required>
        <option value="">--Select--</option>
        @foreach ($schemes as $arr)
                <option value="{{ $arr->id }}">
                    {{ $arr->display_name }}
                </option>
     
        @endforeach
    </x-form.select>
</div>
