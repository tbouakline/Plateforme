<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SecteurActivite */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="secteur-activite-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
