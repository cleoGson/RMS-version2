<div class="form-group row{{ $errors->has($name) ? ' has-error' : '' }}">
    <?php $lable = str_replace('_id','',$name);
    $key = str_replace('_',' ',$lable);
    ?>
    {{ Form::label($lable, null, ['class' => 'black col-md-3 col-form-label']) }}
    <div class="col-md-9">
            <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
            <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
        {{ Form::select(strtolower($name.'[]'),[''=>'Select '.ucwords($key)]+ $options, $value, array_merge(['class' => 'form-control select2-single'], $attributes+['multiple'=>'multiple'])) }}
        @if ($errors->has($name))
            <span class="help-block"><strong>{{ $errors->first($name) }}</strong></span>
        @endif
    </div>
</div>
