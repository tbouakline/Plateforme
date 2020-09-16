<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Secteur_economique */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="secteur-economique-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'libelli')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_secteur')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
