<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Wilaya */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wilaya-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_wilaya')->textInput() ?>

    <?= $form->field($model, 'nom')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
