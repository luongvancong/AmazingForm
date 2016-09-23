<?php

function alertError($key) {
    return '<span class="help-inline text-danger">Vui long nhap ten</span>';
}

class FormTest extends PHPUnit_Framework_TestCase
{
    public function setUp() {
        $config = require realpath('../Form/src/config.php');
        $this->form = new \Justin\Form\Form($config);
    }

    public function test_makeAttrs() {
        $attrs = ['class' => 'account name', 'id' => 'account_name', 'name' => 'name', 'value' => 'shit'];
        $actual = 'class="account name" id="account_name" name="name" value="shit"';
        $expect = $this->form->makeAttrs($attrs);
        $this->assertEquals($expect, $actual);
    }

    public function test_text() {
        $actual = '<input class="form-control my-class" id="my-class" type="text" name="age" value="18">';
        $expect = $this->form->text('age', 18, ['class' => 'my-class', 'id' => 'my-class']);
        $this->assertEquals($expect, $actual);
    }


    public function test_radio() {
        $actual = '<input class="my-class" id="my-class" type="radio" name="sex" value="1">';
        $expect = $this->form->radio('sex', 1, 0, ['class' => 'my-class', 'id' => 'my-class']);
        $this->assertEquals($expect, $actual);
    }

    public function test_radio_checked() {
        $actual = '<input class="my-class" id="my-class" type="radio" name="sex" value="1" checked="checked">';
        $expect = $this->form->radio('sex', 1, 1, ['class' => 'my-class', 'id' => 'my-class']);
        $this->assertEquals($expect, $actual);
    }

    public function test_checkbox() {
        $actual = '<input class="my-class" id="my-class" type="checkbox" name="sex" value="1">';
        $expect = $this->form->checkbox('sex', 1, 0, ['class' => 'my-class', 'id' => 'my-class']);
        $this->assertEquals($expect, $actual);
    }

    public function test_checkbox_checked() {
        $actual = '<input class="my-class" id="my-class" type="checkbox" name="sex" value="1" checked="checked">';
        $expect = $this->form->checkbox('sex', 1, 1, ['class' => 'my-class', 'id' => 'my-class']);
        $this->assertEquals($expect, $actual);
    }

    public function test_select() {
        $actual = '
            <select id="money" class="form-control" name="money">
                <option value="1000">1000</option>
            </select>
        ';

        $expect = $this->form->select('money', null, ['1000' => 1000], ['id' => 'money', 'class' => 'form-control']);

        $actual = str_replace("\n\r", '', $actual);
        $expect = str_replace("\n\r", '', $expect);

        $this->assertEquals($expect, $actual);
    }

    public function test_select_selected() {
        $actual = '
            <select id="money" class="form-control" name="money">
                <option value="1000" selected="selected">1000</option>
            </select>
        ';

        $expect = $this->form->select('money', 1000, ['1000' => 1000], ['id' => 'money', 'class' => 'form-control']);

        $actual = $this->replaceDirty($actual);
        $expect = $this->replaceDirty($expect);

        $this->assertEquals($expect, $actual);
    }

    private function replaceDirty($str) {
        $str = trim(preg_replace('/\s\s+/', '', $str), ' ');
        $str = str_replace("\n\r", '', $str);
        return $str;
    }

    public function test_select_group() {
        $actual = '
            <select id="money" class="form-control" name="money">
                <optgroup label="Name">
                    <option value="justin">Justin</option>
                </optgroup>
                <optgroup label="Age">
                    <option value="18">18</option>
                </optgroup>
            </select>
        ';

        $expect = $this->form->selectGroup('money',
                                           null,
                                           [
                                                'Name' => ['justin' => 'Justin'],
                                                'Age'  => ['18' => 18]
                                           ],
                                           ['id' => 'money', 'class' => 'form-control']);

        $actual = $this->replaceDirty($actual);
        $expect = $this->replaceDirty($expect);

        $this->assertEquals($expect, $actual);
    }

    public function test_select_group_selected() {
        $actual = '
            <select id="money" class="form-control" name="money">
                <optgroup label="Name">
                    <option value="justin">Justin</option>
                </optgroup>
                <optgroup label="Age">
                    <option value="18" selected="selected">18</option>
                </optgroup>
            </select>
        ';

        $expect = $this->form->selectGroup('money',
                                           18,
                                           [
                                                'Name' => ['justin' => 'Justin'],
                                                'Age'  => ['18' => 18]
                                           ],
                                           ['id' => 'money', 'class' => 'form-control']);

        $actual = $this->replaceDirty($actual);
        $expect = $this->replaceDirty($expect);

        $this->assertEquals($expect, $actual);
    }

    public function test_reset() {
        $actual = '<button class="form-control" id="shit" type="reset">Reset</button>';
        $expect = $this->form->reset('Reset', ['class' => 'form-control', 'id' => 'shit']);

        $actual = $this->replaceDirty($actual);
        $expect = $this->replaceDirty($expect);

        $this->assertEquals($expect, $actual);
    }

    public function test_submit() {
        $actual = '<button class="form-control" id="shit" type="submit">Submit</button>';
        $expect = $this->form->submit('Submit', ['class' => 'form-control', 'id' => 'shit']);

        $actual = $this->replaceDirty($actual);
        $expect = $this->replaceDirty($expect);

        $this->assertEquals($expect, $actual);
    }

    public function test_button() {
        $actual = '<button class="form-control" id="shit" type="button">Button</button>';
        $expect = $this->form->button('Button', ['class' => 'form-control', 'id' => 'shit']);

        $actual = $this->replaceDirty($actual);
        $expect = $this->replaceDirty($expect);

        $this->assertEquals($expect, $actual);
    }

    public function test_error() {
        $actual = '<span class="help-inline text-danger">Error</span>';
    }

    public function test_label() {

        $actual = $this->form->label('Name');
        $expect = '<label class="control-label col-sm-3">Name</label>';

        $actual = $this->replaceDirty($actual);
        $expect = $this->replaceDirty($expect);

        $this->assertEquals($expect, $actual);
    }

    public function test_control() {
        $actual = '
            <div class="form-group">
                <label class="control-label col-sm-3">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" value="" class="form-control">
                    <span class="help-inline text-danger">Vui long nhap ten</span>
                </div>
            </div>
        ';

        $expect = $this->form->control(
            $this->form->label('Name'),
            $this->form->text('name'),
            alertError('name')
        );

        $actual = $this->replaceDirty($actual);
        $expect = $this->replaceDirty($expect);

        $this->assertEquals($expect, $actual);
    }


}