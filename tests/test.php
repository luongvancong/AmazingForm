<?php
    require '../vendor/autoload.php';
?><!DOCTYPE html>
<html>
<head>
    <title>Test form</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/justin_form.css">
</head>
<body>
<h1>FORM WITH TABLE</h1>
<?php
    $form = new Justin\Form\AmazingForm();
    echo $form->open("", "POST", ['class' => 'form']);

    echo $form->table()->open();

    echo $form->table->row("Name", $form->text("name", "CONG"));
    echo $form->table->row("Gender", $form->radio("gender", 1) . ' Nam ' . $form->radio("gender", 0) . ' Nu');
    echo $form->table->row("Real", $form->checkbox("real", 0));

    $options = [
        1 => "Ha noi",
        2 => "HCM"
    ];
    echo $form->table->row("Tinh/Thanh Pho", $form->select("name", 2, $options));
    echo $form->table->row("Quan/Huyen", $form->text("name", "CONG"));
    echo $form->table->row("Content", $form->textarea("content", ""));

    echo $form->table()->close();

    echo $form->close();
?>
<pre>
    $form = new Justin\Form\AmazingForm();
    echo $form->open("", "POST", ['class' => 'form']);

    echo $form->table()->open();

    echo $form->table->row("Name", $form->text("name", "CONG"));
    echo $form->table->row("Gender", $form->radio("gender", 1) . ' Nam ' . $form->radio("gender", 0) . ' Nu');
    echo $form->table->row("Real", $form->checkbox("real", 0));

    $options = [
    1 => "Ha noi",
    2 => "HCM"
    ];
    echo $form->table->row("Tinh/Thanh Pho", $form->select("name", 2, $options));
    echo $form->table->row("Quan/Huyen", $form->text("name", "CONG"));
    echo $form->table->row("Content", $form->textarea("content", ""));

    echo $form->table()->close();

    echo $form->close();
</pre>

<hr>


<h1>FORM WITH TABLE TEMPLATE</h1>
<?php
    $form = new Justin\Form\AmazingForm();
    echo $form->open("", "POST", ['class' => 'form']);

    $defaultTemplate = '<tr>
        <td><div class="__label shit">:label</div></td>
        <td style="border: 1px solid red">:control</td>
    </tr>';

    echo $form->table()->open();

    $form->table->setRowTemplate($defaultTemplate);

    $nameTemplate = '<tr>
        <td><div class="__label shit">:label</div></td>
        <td>:control</td>
    </tr>';

    echo $form->table->row("Name", $form->text("name", "CONG"), $nameTemplate);
    echo $form->table->row("Gender", $form->radio("gender", 1) . ' Nam ' . $form->radio("gender", 0) . ' Nu');
    echo $form->table->row("Real", $form->checkbox("real", 0));

    $options = [
        1 => "Ha noi",
        2 => "HCM"
    ];
    echo $form->table->row("Tinh/Thanh Pho", $form->select("name", 2, $options));
    echo $form->table->row("Quan/Huyen", $form->text("name", "CONG"));
    echo $form->table->row("Content", $form->textarea("content", ""));

    echo $form->table()->close();

    echo $form->close();
?>

<hr>


<h1>FORM WITH BOOTSTRAP FORM</h1>
<?php
    $form = new Justin\Form\AmazingForm();
    echo $form->open("", "POST", ['class' => 'form form-horizontal']);

    echo $form->control("Name", $form->text("name", "CONG"));
    echo $form->control("Gender", $form->radio("gender", 1) . ' Nam ' . $form->radio("gender", 0) . ' Nu');
    echo $form->control("Real", $form->checkbox("real", 0));

    $options = [
        1 => "Ha noi",
        2 => "HCM"
    ];
    echo $form->control("Tinh/Thanh Pho", $form->select("name", 2, $options));
    echo $form->control("Quan/Huyen", $form->text("name", "CONG"));
    echo $form->control("Content", $form->textarea("content", ""));

    echo $form->close();
?>
<pre>
    $form = new Justin\Form\AmazingForm();
    echo $form->open("", "POST", ['class' => 'form form-horizontal']);

    echo $form->control("Name", $form->text("name", "CONG"));
    echo $form->control("Gender", $form->radio("gender", 1) . ' Nam ' . $form->radio("gender", 0) . ' Nu');
    echo $form->control("Real", $form->checkbox("real", 0));

    $options = [
        1 => "Ha noi",
        2 => "HCM"
    ];
    echo $form->control("Tinh/Thanh Pho", $form->select("name", 2, $options));
    echo $form->control("Quan/Huyen", $form->text("name", "CONG"));
    echo $form->control("Content", $form->textarea("content", ""));

    echo $form->close();
</pre>
<hr>


<h1>FORM WITH BOOTSTRAP FORM USING TEMPLATE AllOW OVERRIDE</h1>
<?php
    $form = new Justin\Form\AmazingForm();
    $template = '
        <div class="form-group">
            <div class="control-label col-sm-3">:label</div>
            <div class="col-sm-6">:control</div>
        </div>
    ';

    $form->setControlTemplate($template);

    echo $form->open("", "POST", ['class' => 'form form-horizontal']);

    $nameTemplate = '
        <div class="form-group">
            <div class="control-label col-sm-3">:label</div>
            <div class="col-sm-9">:control</div>
        </div>
    ';

    echo $form->control("Name", $form->text("name", "CONG"), $nameTemplate);
    echo $form->control("Gender", $form->radio("gender", 1) . ' Nam ' . $form->radio("gender", 0) . ' Nu', $template);
    echo $form->control("Real", $form->checkbox("real", 0), $template);

    $options = [
        1 => "Ha noi",
        2 => "HCM"
    ];
    echo $form->control("Tinh/Thanh Pho", $form->select("name", 2, $options), $template);
    echo $form->control("Quan/Huyen", $form->text("name", "CONG"), $template);
    echo $form->control("Content", $form->textarea("content", ""), $template);

    echo $form->close();
?>

<hr>

<h1>FORM WITH BOOTSTRAP FORM USING TEMPLATE SET ALL</h1>
<?php
    $form = new Justin\Form\AmazingForm();
    $template = '
        <div class="form-group">
            <div class="control-label col-sm-3">:label</div>
            <div class="col-sm-9">:control</div>
        </div>
    ';

    $form->setControlTemplate($template);

    echo $form->open("", "POST", ['class' => 'form form-horizontal']);

    echo $form->control("Name", $form->text("name", "CONG"));
    echo $form->control("Gender", $form->radio("gender", 1) . ' Nam ' . $form->radio("gender", 0) . ' Nu');
    echo $form->control("Real", $form->checkbox("real", 0));

    $options = [
        1 => "Ha noi",
        2 => "HCM"
    ];
    echo $form->control("Tinh/Thanh Pho", $form->select("name", 2, $options));
    echo $form->control("Quan/Huyen", $form->text("name", "CONG"));
    echo $form->control("Content", $form->textarea("content", ""));

    echo $form->close();
?>

</body>
</html>