<?php

namespace Justin\Form;

class Form {

    public $config = [];

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function open($action = '', $method = 'GET', $enctype = null)
    {
        if(!$enctype) {
            $enctype = 'enctype="multipart/form-data"';
        }

        return '<form class="'. $this->config['class_form'] .'" action="'. $action .'" method="'. $method .'" '. $enctype .'>';
    }

    public function close()
    {
        return '</form>';
    }

    public function text($name, $value = null, array $attributes = array())
    {
        $attributes['type'] = 'text';
        $attributes['name'] = $name;
        $attributes['value'] = $value;

        if(isset($attributes['class'])) {
            $attributes['class'] = $this->config['control_class'] . ' ' . $attributes['class'];
        } else {
            $attributes['class'] = $this->config['control_class'];
        }


        return '<input '. $this->makeAttrs($attributes) .'>';
    }

    public function radio($name, $value, $current = null, array $attributes = array())
    {
        $attributes['type'] = 'radio';
        $attributes['name'] = $name;
        $attributes['value'] = $value;

        if($current == $value) {
            $attributes['checked'] = 'checked';
        }

        return '<input '. $this->makeAttrs($attributes) .'>';
    }

    public function checkbox($name, $value, $current = null, array $attributes = array())
    {
        $attributes['type'] = 'checkbox';
        $attributes['name'] = $name;
        $attributes['value'] = $value;

        if($current == $value) {
            $attributes['checked'] = 'checked';
        }

        return '<input '. $this->makeAttrs($attributes) .'>';
    }

    public function reset($label, array $attributes = array())
    {
        $attributes['type'] = 'reset';
        return '<button '. $this->makeAttrs($attributes) .'>'. $label .'</button>';
    }

    public function textarea($name, $value)
    {
        # code...
    }

    public function submit($label, array $attributes = array())
    {
        $attributes['type'] = 'submit';
        return '<button '. $this->makeAttrs($attributes) .'>'. $label .'</button>';
    }

    public function button($label, array $attributes = array())
    {
        $attributes['type'] = 'button';
        return '<button '. $this->makeAttrs($attributes) .'>'. $label .'</button>';
    }

    public function select($name, $current, array $data, array $attributes = array())
    {
        $attributes['name'] = $name;
        $select = '
            <select '. $this->makeAttrs($attributes) .'>
                :options
            </select>
        ';

        $options = '';
        $selected = '';

        foreach($data as $k => $v) {
            if($current == $k) {
                $selected = ' selected="selected"';
            }
            $options .= '<option value="'. $k .'"'. $selected .'>'. $v .'</option>';
        }

        return str_replace(':options', $options, $select);
    }

    function selectGroup($name, $current = null, array $data = array(), array $attributes = array()) {
        $attributes['name'] = $name;
        $select = '
            <select '. $this->makeAttrs($attributes) .'>
                :optgroups
            </select>
        ';

        $optgroups = '';
        $selected = '';

        foreach($data as $group => $opts) {
            $optgroups .= '<optgroup label="'. $group .'">';
            $options = '';
            foreach($opts as $k => $v) {
                if($current == $k) {
                    $selected = ' selected="selected"';
                }

                $options .= '<option value="'. $k .'"'. $selected .'>'. $v .'</option>';
            }
            $optgroups .= $options . '</optgroup>';
        }

        return str_replace(':optgroups', $optgroups, $select);
    }

    public function error($name) {

    }

    public function label($label, array $attributes = array()) {
        if(!isset($attributes['class'])) {
            $attributes['class'] = $this->config['label_class'];
        }
        return '<label '. $this->makeAttrs($attributes) .'>'. $label .'</label>';
    }

    public function control($label, $control, $error = null) {
        $errorLabel = '';
        if(is_callable($error)) {
            $errorLabel = call_user_func($error);
        }

        if(is_string($error)) {
            $errorLabel = $error;
        }

        return '
            <div class="form-group">
                '. $label .'
                <div class="col-sm-6">'. $control . $errorLabel .'</div>
            </div>
        ';
    }


    public function makeAttrs(array $attrs) {
        $attrStr = '';
        foreach($attrs as $key => $value) {
            $attrStr .= "$key=\"$value\" ";
        }

        return trim($attrStr, ' ');
    }
}