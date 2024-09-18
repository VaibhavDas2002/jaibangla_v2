@props(['name', 'label' => ''])

<label {{ $attributes->merge(['class' => 'form-label', 'for'=> $name]) }}>
    {{ empty($label) ? trim(str_replace('id','',str_replace('_',' ',$name))) : $label}}
</label>