<div class="form-group row{{ $errors->has($name) ? ' has-error' : '' }}">
    {{ Form::label($name, null, ['class' => 'black col-md-3 col-form-label']) }}
    <div class="col-md-9">
        {{ Form::textarea($name, $value, array_merge(['class' => 'form-control editor','rows'=>2], $attributes)) }}
        @if ($errors->has($name))
            <span class="help-block"><strong>{{ $errors->first($name) }}</strong></span>
        @endif
    </div>
</div>
