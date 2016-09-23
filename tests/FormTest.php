<?php

function alertError($key) {
    return '<span class="help-inline text-danger">Vui long nhap ten</span>';
}

class FormTest extends PHPUnit_Framework_TestCase
{
    public function setUp() {
        $this->form = new \Justin\Form\AmazingForm();
    }


    public function test_text() {
        $expect = '<input class="form-control my-class" id="my-class" name="age" type="text" value="18" />';
        $actual = $this->form->text('age', 18, ['class' => 'my-class', 'id' => 'my-class']);
        $this->assertEquals($expect, $actual);
    }

    public function test_hidden()
    {
        $expect = '<input class="form-control my-class" id="my-class" name="age" type="hidden" value="18" />';
        $actual = $this->form->hidden('age', 18, ['class' => 'my-class', 'id' => 'my-class']);
        $this->assertEquals($expect, $actual);
    }

    public function test_radio() {
        $expect = '<input class="gender" id="gender" name="gender" type="radio" value="1" />';
        $actual = $this->form->radio('gender', 1, 0, ['id' => 'gender', 'class' => 'gender']);

        $expect = $this->replaceDirty($expect);
        $actual = $this->replaceDirty($actual);
        $this->assertEquals($expect, $actual);
    }

    public function test_checkbox()
    {
        $expect = '<input name="gender" type="checkbox" value="1" />';
        $actual = $this->form->checkbox('gender', 1);
        $this->assertEquals($expect, $actual);
    }

    public function test_textarea() {
        $expect = '<textarea class="form-control" name="name">CONG</textarea>';
        $actual = $this->form->textarea("name", "CONG", 0, 0);
        $this->assertEquals($expect, $actual);
    }

    public function test_reset()
    {
        $expect = '<button class="btn btn-sm btn-danger" type="reset"></button>';
        $actual = $this->form->reset();
        $this->assertEquals($expect, $actual);
    }

    public function test_submit()
    {
        $expect = '<button class="btn btn-sm btn-primary" type="submit"></button>';
        $actual = $this->form->submit();
        $this->assertEquals($expect, $actual);
    }


    public function test_editor()
    {
        $expect = '<textarea class="form-control you-editor" cols="100" name="editor" rows="50"></textarea>';
        $actual = $this->form->editor('editor');
        $this->assertEquals($expect, $actual);
    }

    private function replaceDirty($str) {
        $str = trim(preg_replace('/\s\s+/', '', $str), ' ');
        $str = str_replace("\n\r", '', $str);
        return $str;
    }




}