<?php

namespace Justin\Form;

class AmazingForm {

    public $table;

    protected $controlTemplate;

    /**
     * Open normal form
     * @param  string $action
     * @param  string $method
     * @param  array  $attr
     * @return html
     */
    public function open($action = "", $method = "POST", $attr = array())
    {
        $attr['action'] = $action;
        $attr['method'] = $method;

        $defaultAttr = ['class' => 'j-amazing-form'];

        $attr = mergeAttributes($defaultAttr, $attr);

        return '<form action="'. $action .'" method="'. $method .'" '. makeAttributes($attr) .'>';
    }


    /**
     * Open multipart/form
     * @param  string $action
     * @param  string $method
     * @param  array  $attr
     * @return html
     */
    public function openMultipart($action = "", $method = "POST", $attr = array())
    {
        $attr['enctype'] = 'multipart/form-data';
        return $this->open($action, $method, $attr);
    }


    public function close() {
        return '</form>';
    }

    public function input($type = 'text', $name = "", $value = "", $attr = array())
    {
        $attr['type'] = $type;
        if($name) $attr['name'] = $name;
        if($value) $attr['value'] = $value;

        $defaultAttr = [];
        if(!in_array($type, ['radio', 'checkbox'])) {
            $defaultAttr['class'] = 'form-control';
        }

        $attr = mergeAttributes($defaultAttr, $attr);

        return '<input '. makeAttributes($attr) .' />';
    }

    public function text($name = "", $value = "", $attr = array())
    {
        return $this->input('text', $name, $value, $attr);
    }

    public function radio($name = "", $value = null, $checkedValue = null, $attr = array())
    {
        if($checkedValue !== null && $value !== null && $checkedValue === $value) $attr['checked'] = 'checked';
        return $this->input('radio', $name, $value, $attr);
    }

    public function checkbox($name = "", $value = null, $checkedValue = null, $attr = array())
    {
        if($checkedValue !== null && $value !== null && $checkedValue === $value) $attr['checked'] = 'checked';
        return $this->input('checkbox', $name, $value, $attr);
    }


    public function select($name = "", $value = "", array $data = array(), $attr = array())
    {
        $options = "";
        if($name) $attr['name'] = $name;

        $defaultAttr = ['class' => 'form-control'];

        $attr = mergeAttributes($defaultAttr, $attr);

        foreach($data as $key => $v) {
            $selected = "";
            if($key === $value) {
                $selected = 'selected="selected"';
            }
            $options .= '<option value="'. $key .'" '. $selected .'>'. $v .'</option>';
        }

        return '<select '. makeAttributes($attr) .'>'. $options .'</select>';
    }

    public function textarea($name = "", $value = "", $cols = 100, $rows = 5, array $attr = array())
    {
        if($name) $attr['name'] = $name;
        if($rows) $attr['rows'] = $rows;
        if($cols) $attr['cols'] = $cols;

        $defaultAttr = ['class' => 'form-control'];
        $attr = mergeAttributes($defaultAttr, $attr);

        return '<textarea '. makeAttributes($attr) .'>'. $value .'</textarea>';
    }

    public function control($label, $control, $template = null)
    {
        $defaultTemplate = '<div class="form-group">
            <div class="control-label col-sm-3">:label</div>
            <div class="col-sm-6">:control</div>
        </div>';

        if($this->getControlTemplate()) $defaultTemplate = $this->getControlTemplate();

        if($template) $defaultTemplate = $template;

        $defaultTemplate = str_replace(':label', $label, $defaultTemplate);
        $defaultTemplate = str_replace(':control', $control, $defaultTemplate);

        return $defaultTemplate;
    }

    public function table()
    {
        $this->table = new Table($this);
        return $this->table;
    }

    public function setControlTemplate($template)
    {
        $this->controlTemplate = $template;
    }

    public function getControlTemplate()
    {
        return $this->controlTemplate;
    }


}