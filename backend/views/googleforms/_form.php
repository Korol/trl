<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Googleforms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="googleforms-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'google_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'google_id_editmode')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>


    <hr>
    <h1>Meta fields for creating the multifolder on MFiles</h1>

    <?= $form->field($model, 'mfiles_meta_class_id')->dropDownList(
        [
            '8' => 'מכירות',
            '43' => 'לביצוע',
        ],
        ['prompt' => '-select-']);


    ?>

    <?= $form->field($model, 'mfiles_meta_dropdwn_001_id')->dropDownList(
        [
            '47' => 'מכירות',
            '59' => 'רמת כלל הפרוייקט',
        ],
        ['prompt' => '-select-']);


    ?>

    <?= $form->field($model, 'mfiles_meta_dropdwn_002_id')->dropDownList(
        [
//            '117' => '117',
//            '106' => '106',
//            '107' => '107',
//            '113' => '113',

            106 => "ארון קודש",
            107 => "בימה",
            111 => "דלתות",
            114 => "כיסא אליהו",
            112 => "לוחות זיכרון",
            110 => "מחיצות",
            115 => "מיוחד",
            119 => "מערכות ישיבה",
            109 => "ספריות",
            108 => "עמוד חזן",
            116 => "ציפוי קיר",
            117 => "רמת כלל הפרוייקט",
            113 => "שולחן קריאה",
        ],
        ['prompt' => '-select-']);


    ?>

    <hr>
    <h1>Internal message about new Filling Form</h1>


    <?= $form->field($model, 'internal_message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'internal_emails')->textInput(['maxlength' => true]) ?>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<pre>
    Attention
     - The unique ID of the form (from its URL) for inserting to the Google_Script lets search in EDIT_mode instead VIEW_mode of Google_Form
     - It is important to first form field was named: מספר לקוח
     - Example script to insert into the Google script Editor  <a href="/dont_move_google_script.txt">see here</a>

</pre>

<div>
    <a href="/img/STEP01.png"><img src="/img/STEP01.png" width="250px" style="border: 1px solid black"><br><br>
        <a href="/img/STEP02.png"><img src="/img/STEP02.png" width="250px" style="border: 1px solid black"><br><br>
            <a href="/img/STEP03.png"><img src="/img/STEP03.png" width="250px" style="border: 1px solid black"><br><br>
                <a href="/img/STEP04.png"><img src="/img/STEP04.png" width="250px"
                                               style="border: 1px solid black"><br><br>
                    <a href="/img/STEP05.png"><img src="/img/STEP05.png" width="250px"
                                                   style="border: 1px solid black"><br><br>
                        <a href="/img/STEP06.png"><img src="/img/STEP06.png" width="250px"
                                                       style="border: 1px solid black"><br><br>
                            <a href="/img/STEP07.png"><img src="/img/STEP07.png" width="250px"
                                                           style="border: 1px solid black"><br><br>
                                <a href="/img/STEP08.png"><img src="/img/STEP08.png" width="250px"
                                                               style="border: 1px solid black"><br><br>

</div>
