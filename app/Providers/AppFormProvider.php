<?php

/* 
 * created by NELSON ZACHARIA ( +255 713 127 045).
 */

function fields($fields_array, $errors) {
  foreach ($fields_array as $field) {
    $has_error = $errors->has($field) ? ' has-error' : '';
    $old = Request::old($field);
    $r = '<div class="form-group  ' . $has_error . '">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="' . $field . '">' . ucwords($field) . ' <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" value="' . $old . '" id="' . $field . '" name="' . $field . '" class="form-control col-md-7 col-xs-12">';
    $errors->has($field) ? $r .= '<span class="help-block">' . $errors->first($field) . '</span>' : '';
    $r .= '</div></div>';
    echo $r;
  }
}

function selection() {
  
}

function horizontal($fields, $errors) {
  extract($fields);
  $variable = isset($variable) ? $variable : '';
  $type = isset($type) ? $type : 'text';
  $label = isset($label) ? $label : '';
  $has_error = $errors->has($variable) ? ' has-error' : '';
  $value = isset($value) ? $value : '' ;// !isset($value) ? $value : Request::old($variable);
  $old = Request::old($variable) != '' ? Request::old($variable) : $value ;
  $r = '<div class="form-group  ' . $has_error . '">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="' . $variable . '">' . ucwords($label) . ' <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="'.$type.'" value="' . $old . '" id="' . $variable . '" name="' . $variable . '" class="form-control col-md-7 col-xs-12">';
  $errors->has($variable) ? $r .= '<span class="help-block">' . $errors->first($variable) . '</span>' : '';

  $r .= '</div></div>';
  echo $r;
}

function hide($variables) {
  extract($variables);
  $out = ' <input type="hidden" name="' . $variable . '" value="' . $value . '" /> ';
  echo $out;
}

function verify($array){
  extract($array);
 $r = '<div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Confirm Delete Record &nbsp;&nbsp;&nbsp;<a href="'.route($route.'.index').'" class="btn btn-info btn-xs pull-right"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>Are you sure you want to delete <strong>'.$display.'</strong></p>

                    <form method="POST" action="'.route($route.".destroy",["id"=>$id]).'">
                        <input type="hidden" name="_token" value="'.Session::token().'">
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger">Yes I\'m sure. Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>';
 echo $r;
}


function selection3($fields) {
  extract($fields);
  $mainclass = isset($mainclass) ? $mainclass : '';
  $mainid = isset($mainid) ? $mainid : '';
  $out = '<div id ="' . $mainid . '" class="form-group ' . $mainclass . '">';
  $out .= '<label for="' . $variable . '" class="control-label col-md-4">' . $label . '</label>';
  $out .= ' <div class="col-md-6">';
  foreach ($options as $opt) {
    extract($opt);
    $oid = isset($oid) ? $oid : $ovalue;
    $out .= ' <label class="custom-control '.$oclass.'" for="' . $oid . '">';
    $out .= ' <input type="' . $type . '" name="' . $variable . '"';
    $value == $ovalue ? $out .= 'checked="checked"' : '';
    $out .= ' value="' . $ovalue . '" id="' . $oid . '" class="custom-control-input"/> ' . $oname;
    $out .= ' <span class="help-block custom-control-indicator">' . $ohelpBlock . '</span>';
    $out .= '</label>';
  }
  $out .= ' </div> </div>';
  echo $out;
}

function select($fields,$errors) {
  extract($fields);
  $variable = isset($variable) ? $variable : '';
  $type = isset($type) ? $type : 'text';
  $class = isset($class) ? $class : '';
  $label = isset($label) ? $label : '';
  $has_error = $errors->has($variable) ? ' has-error' : '';
  $value = isset($value) ? $value : '' ;// !isset($value) ? $value : Request::old($variable);
  $old = Request::old($variable) != '' ? Request::old($variable) : $value ;
  
  $out = '<div class="form-group">';
  $out .= '<label for="' . $variable . '" class="control-label col-md-4">' . $label . '</label>';
  $out .= ' <div class="col-md-6">';
  $out .= '<select class="form-control ' . $class . '" name="' . $variable . '" id="' . $variable . '" >';
  $out .= '<option value="">select ' . $label . '</option>';
  foreach ($options as $key => $values) {
    $out .= ' <option value="' . $key . '" ';
    strtolower($value) == strtolower($key) ? $out .= 'selected="selected"' : '';
    $out .= ' >' . $values . '</option>';
  }
  $out .= ' </select></div> </div>';
  echo $out;
}

function select_multiple($variables) {
  extract($variables);
  require 'formFields.php';
  $id = str_replace('[]', '', $variable);
  $out = '<div class="form-group">';
  $out .= '<label for="' . $variable . '" class="control-label col-md-4">' . $name . '</label>';
  $out .= ' <div class="col-md-6">';
  $out .= '<select class="form-control ' . $class . '" name="' . $variable . '" id="' . $id . '"' . $other . ' >';
  $out .= '<option value="">select ' . $name . '</option>';
  foreach ($options as $key => $values) {

    $out .= ' <option value="' . $key . '" ';
    if (!is_array($value))
      strtolower($value) == strtolower($values) ? $out .= 'selected="selected"' : '';
    else {
      in_array($values, $value) ? $out .= 'selected="selected"' : '';
    }
    $out .= ' >' . $values . '</option>';
  }
  $out .= ' </select></div> </div>';
  echo $out;
}

function text($variables) {
  extract($variables);
  require 'formFields.php';
  $out = '<div class="form-group">';
  $out .= '<label for="' . $variable . '" class="control-label col-md-4">' . $name . '</label>';
  $out .= ' <div class="col-md-6">';
  $out .= ' <textarea class="form-control" id="repaire" name="' . $variable . '">' . $value . '</textarea>';
  $out .= ' </div> </div>';
  echo $out;
}


