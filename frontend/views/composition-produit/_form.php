<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CompositionProduit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="composition-produit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_prod')->textInput() ?>

    <?= $form->field($model, 'id_matiere')->textInput() ?>

    <?= $form->field($model, 'quantite')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
