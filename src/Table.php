<?php

namespace Justin\Form;

class Table {

    protected $form;

    protected $rowTemplate;

    public function __construct(AmazingForm $form)
    {
        $this->form = $form;
    }

    public function open($attr = array()) {
        $attr['class'] = 'table';
        return '<table '. makeAttributes($attr)  .'>';
    }


    public function row($label, $control, $template = null)
    {
        $defaultTemplate = '<tr>
            <td><div class="__label">:label</div></td>
            <td>:control</td>
        </tr>';

        if($this->getRowTemplate()) $defaultTemplate = $this->getRowTemplate();

        if($template) $defaultTemplate = $template;

        $defaultTemplate = str_replace(':label', $label, $defaultTemplate);
        $defaultTemplate = str_replace(':control', $control, $defaultTemplate);

        return $defaultTemplate;
    }

    public function setRowTemplate($template) {
        $this->rowTemplate = $template;
    }

    public function getRowTemplate() {
        return $this->rowTemplate;
    }

    public function close() {
        return '</table>';
    }
}