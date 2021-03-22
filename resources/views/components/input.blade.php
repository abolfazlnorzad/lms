<div class="mlg-15 w-100">
    <input type="{{$type}}"
           name="{{$name}}" placeholder="{{$placeholder}}"
        {{$attributes->merge(['class'=>' text w-100'])}}
        value="{{old($name)}}"
    >
    <x-validation-error field='{{str_replace("]","",str_replace("[",".",$name))}}'/>
</div>
