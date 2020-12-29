<textarea placeholder="{{$placeholder}}" name="{{$name}}" class="text h" {{$attributes}}>
    {!! isset($value) ? $value : old($name) !!}

</textarea>
<x-validation-error field="{{$name}}"/>
