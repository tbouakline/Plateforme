<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Commune */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="commune-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_commune')->textInput() ?>

    <?= $form->field($model, 'code_postal')->textInput() ?>

    <?= $form->field($model, 'nom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_wilaya')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
