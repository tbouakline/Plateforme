<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CategorieEntreprise */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categorie-entreprise-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'designation_courte')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designation_longue')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
