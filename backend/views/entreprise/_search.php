<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntrepriseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entreprise-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_entreprise') ?>

    <?= $form->field($model, 'secteur_eco') ?>

    <?= $form->field($model, 'branche') ?>

    <?= $form->field($model, 'taille') ?>

    <?= $form->field($model, 'nom_entreprise') ?>

    <?php // echo $form->field($model, 'siege_social') ?>

    <?php // echo $form->field($model, 'id_admin') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
