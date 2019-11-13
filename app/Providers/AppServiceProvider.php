<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Form;
use Illuminate\Http\Request;
use Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('greater_than', function($attribute, $value, $params, $validator){
            $other = request()->get($params[0]);
            return intval($value) > intval($other);
        });

        Validator::replacer('greater_than', function($message, $attribute, $rule, $params) {
            return str_replace('_', ' ' , 'The '. $attribute .' must be greater than the ' .$params[0]);
        });
        Schema::defaultStringLength(191);
        Form::component('inputPassword', 'components.form.password', ['name', 'value'=>null, 'attributes'=>[]]);
        Form::component('inputText', 'components.form.text', ['name', 'value'=>null, 'attributes'=>[]]);
        Form::component('inputTextArea', 'components.form.textarea', ['name', 'value'=>null, 'attributes'=>[]]);
        Form::component('inputNumber', 'components.form.number', ['name', 'value'=>null, 'attributes'=>[]]);
        Form::component('inputSelect', 'components.form.select', ['name','options'=>[], 'value'=>null, 'attributes'=>[]]);
        Form::component('inputSelect2', 'components.form.select2', ['name','options'=>[], 'value'=>null, 'attributes'=>[]]);
        Form::component('radioSet', 'components.form.radio_set', ['name','options'=>[], 'value'=>null, 'attributes'=>[]]);
        Form::component('inputButton', 'components.form.button', ['name'=>'Submit','url'=>url()->previous(),'attributes'=>[]]);
        Form::component('inputDate', 'components.form.date', ['name', 'value'=>null, 'attributes'=>[]]);
        Form::component('inputDateTime', 'components.form.dateTimepicker', ['name', 'value'=>null, 'attributes'=>[]]);
        Form::component('inputDateRangeStart', 'components.form.daterangestart', ['name', 'value'=>null, 'attributes'=>[]]);
        Form::component('inputDateRangeEnd', 'components.form.daterangeend', ['name', 'value'=>null, 'attributes'=>[]]);
        Form::component('inputTimepickerTwo', 'components.form.dateTimepickerTwo', ['name', 'value'=>null, 'attributes'=>[]]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        

    }
}
