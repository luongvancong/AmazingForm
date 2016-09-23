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


    /**
     * Close the form
     * @return html
     */
    public function close() {
        return '</form>';
    }


    /**
     * Input control
     * @param  string $type
     * @param  string $name
     * @param  string $value
     * @param  array  $attr
     * @return html
     */
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

        // Sort by key asc
        ksort($attr);

        return '<input '. makeAttributes($attr) .' />';
    }


    /**
     * Text control
     * @param  string $name
     * @param  string $value
     * @param  array  $attr
     * @return string\html
     */
    public function text($name = "", $value = "", $attr = array())
    {
        return $this->input('text', $name, $value, $attr);
    }

    /**
     * Hidden control
     * @param  string $name
     * @param  string $value
     * @param  array  $attr
     * @return html
     */
    public function hidden($name = "", $value = "", $attr = array())
    {
        return $this->input('hidden', $name, $value, $attr);
    }


    /**
     * Option control
     * @param  string $name
     * @param  mixed $value
     * @param  mixed $checkedValue
     * @param  array  $attr
     * @return html
     */
    public function radio($name = "", $value = null, $checkedValue = null, $attr = array())
    {
        if($checkedValue !== null && $value !== null && $checkedValue === $value) $attr['checked'] = 'checked';
        return $this->input('radio', $name, $value, $attr);
    }



    /**
     * Checkbox control
     * @param  string $name
     * @param  mixed $value
     * @param  mixed $checkedValue
     * @param  array  $attr
     * @return html
     */
    public function checkbox($name = "", $value = null, $checkedValue = null, $attr = array())
    {
        if($checkedValue !== null && $value !== null && $checkedValue === $value) $attr['checked'] = 'checked';
        return $this->input('checkbox', $name, $value, $attr);
    }


    /**
     * Select control
     * @param  string $name
     * @param  string $value
     * @param  array  $data
     * @param  array  $attr
     * @return html
     */
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


    /**
     * Textarea
     * @param  string  $name
     * @param  string  $value
     * @param  integer $cols
     * @param  integer $rows
     * @param  array   $attr
     * @return html
     */
    public function textarea($name = "", $value = "", $cols = 100, $rows = 5, array $attr = array())
    {
        if($name) $attr['name'] = $name;
        if($rows) $attr['rows'] = $rows;
        if($cols) $attr['cols'] = $cols;

        $defaultAttr = ['class' => 'form-control'];
        $attr = mergeAttributes($defaultAttr, $attr);

        ksort($attr);

        return '<textarea '. makeAttributes($attr) .'>'. $value .'</textarea>';
    }


    /**
     * Button control
     * @param  string $type
     * @param  array  $attr
     * @return string\html
     */
    public function button($type = 'button', array $attr = array())
    {
        $attr['type'] = $type;
        return '<button '. makeAttributes($attr) .'></button>';
    }


    /**
     * Reset button control
     * @param  array  $attr
     * @return string\html
     */
    public function reset(array $attr = array())
    {
        $defaultAttr = ['class' => 'btn btn-sm btn-danger'];
        $attr = mergeAttributes($defaultAttr, $attr);

        ksort($attr);

        return $this->button('reset', $attr);
    }

    /**
     * Submit control
     * @param  array  $attr
     * @return string|html
     */
    public function submit(array $attr = array())
    {
        $defaultAttr = ['class' => 'btn btn-sm btn-primary'];
        $attr = mergeAttributes($defaultAttr, $attr);

        ksort($attr);

        return $this->button('submit', $attr);
    }


    public function editor($name = "", $value = "", array $attr = array())
    {
        $defaultAttr = ['class' => 'you-editor'];
        $attr = mergeAttributes($defaultAttr, $attr);
        return $this->textarea($name, $value, 100, 50, $attr);
    }


    /**
     * Control group
     * @param  string|html $label
     * @param  string|html $control
     * @param  string|html $template
     * @return html
     */
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


    /**
     * Call table instance
     * @return Justin\Form\Table
     */
    public function table()
    {
        $this->table = new Table($this);
        return $this->table;
    }


    /**
     * Set control template
     * @param string|html $template
     */
    public function setControlTemplate($template)
    {
        $this->controlTemplate = $template;
    }


    /**
     * Get control template
     * @return string|html
     */
    public function getControlTemplate()
    {
        return $this->controlTemplate;
    }


}