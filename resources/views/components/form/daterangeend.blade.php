<div class="form-group row{{ $errors->has($name) ? ' has-error' : '' }}">
    {{ Form::label($name, null, ['class' => 'blue col-md-3 col-form-label']) }}
    <div class="col-md-9">
        {{ Form::text($name, $value, array_merge(['class' => 'form-control endDate'], $attributes+['width'=>"97%"])) }}
        @if ($errors->has($name))
            <span class="help-block"><strong>{{ $errors->first($name) }}</strong></span>
        @endif
    </div>
</div>
