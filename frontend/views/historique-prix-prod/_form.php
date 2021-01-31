<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\HistoriquePrixProd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="historique-prix-prod-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_prod')->textInput() ?>

    <?= $form->field($model, 'date_debut')->textInput() ?>

    <?= $form->field($model, 'date_fin')->textInput() ?>

    <?= $form->field($model, 'prix_unitaire')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
