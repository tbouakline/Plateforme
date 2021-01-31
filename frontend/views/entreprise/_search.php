<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EntrepriseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entreprise-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_ent') ?>

    <?= $form->field($model, 'nom_rs') ?>

    <?= $form->field($model, 'adresse') ?>

    <?= $form->field($model, 'id_commune') ?>

    <?= $form->field($model, 'id_wilaya') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'num_rc') ?>

    <?php // echo $form->field($model, 'article_impo') ?>

    <?php // echo $form->field($model, 'code_nis') ?>

    <?php // echo $form->field($model, 'code_nif') ?>

    <?php // echo $form->field($model, 'id_categorie') ?>

    <?php // echo $form->field($model, 'id_secteur') ?>

    <?php // echo $form->field($model, 'id_sous_secteur') ?>

    <?php // echo $form->field($model, 'id_activite') ?>

    <?php // echo $form->field($model, 'id_forme_juridique') ?>

    <?php // echo $form->field($model, 'capital') ?>

    <?php // echo $form->field($model, 'effectif') ?>

    <?php // echo $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'iso_9001') ?>

    <?php // echo $form->field($model, 'iso_14001') ?>

    <?php // echo $form->field($model, 'iso_2200') ?>

    <?php // echo $form->field($model, 'iso_ohsas_18001') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
