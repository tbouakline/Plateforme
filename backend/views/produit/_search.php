<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProduitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_prod') ?>

    <?= $form->field($model, 'designation') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'reference') ?>

    <?= $form->field($model, 'marque') ?>

    <?= $form->field($model, 'id_categorie') ?>

    <?php // echo $form->field($model, 'id_sous_categorie') ?>

    <?php // echo $form->field($model, 'id_type') ?>

    <?php // echo $form->field($model, 'fini_matiere') ?>

    <?php // echo $form->field($model, 'prix_unitaire') ?>

    <?php // echo $form->field($model, 'date_insertion') ?>

    <?php // echo $form->field($model, 'date_validation') ?>

    <?php // echo $form->field($model, 'id_user_validation') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
