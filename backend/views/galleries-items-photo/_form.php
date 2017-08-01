<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GalleriesItemsPhoto */
/* @var $form yii\widgets\ActiveForm */

//
$this->registerCssFile('/css/fileinput.min.css');
$this->registerCssFile('http://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css');
//$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js');
$this->registerJsFile('/js/fileinput.min.js');


?>

<div class="galleries-items-photo-form">

    <?php
    $form = ActiveForm::begin([
            //'action' => ['/models/update?id=' . $model->id_model],
            'method' => 'post',
            'options' => ['enctype' => 'multipart/form-data']
        ]
    );
    ?>

    <input type="hidden" name="GalleriesItemsPhoto[gallery_id]" value="<?= $gallery ?>">

    <?= $form->field($model, 'name_item')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php
    // ибо для аплоуда нужен дивой ID мождели жертвы а при киэйте его нет
    // ибо для аплоуда нужен дивой ID мождели жертвы а при киэйте его нет
    if (!$model->isNewRecord) {
    ?>
    <h1>List photos uploaded successfully</h1>
    <?php
    // ДВА БЛОКА список картинок и загрузчик
    // костыль - создаем ID важно для AttachmentsTable (в экшене тоже этот же котыль)
    $model->id = $model->id_item;
    echo \nemmo\attachments\components\AttachmentsTable::widget(['model' => $model]);
    ?>
    <h1>Upload a new photo hosting from PC <br>(displayed only the first one from here in the gallery)</h1>
    <?php
    echo \nemmo\attachments\components\AttachmentsInput::widget([
        'id' => 'file-input', // Optional
        'model' => $model,
        'options' => [ // Options of the Kartik's FileInput widget
            'multiple' => true, // If you want to allow multiple upload, default to false
        ],
        'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget
            // принимает не более 10 !!
            'maxFileCount' => 1 // Client max files
        ]
    ]);


    }//if UPDATE

    ?>


    <?php ActiveForm::end(); ?>


</div>
