@props([
'type'=>'text',
'value'=>'',
'name'
])

<input
    type="{{$type}}"
    value="{{ old($name,$value) }}"
    class="form-control"
    id="{{$id ?? $name}}"
    name="{{$name}}"
    {{$attributes->class(['form-control','is-invalid'=>$errors->has($name)])}}
>
