<div class="form-group row{{ $errors->has($name) ? ' has-error' : '' }}">
    @foreach( $options as $option)
    <div class="col-md-9">
            {!! Form::radio($name, $option->id, false, ['class'=>"form-check-input", 'id'=>$name.'-'.$option->id]) !!}
            <label class="form-check-label" for="{{$name.'-'.$option->id}}"> {{$option->display_name}}</label>
        </div>
    @endforeach
</div>



