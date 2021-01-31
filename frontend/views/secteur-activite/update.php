<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SecteurActivite */

$this->title = 'Update Secteur Activite: ' . $model->id_secteur;
$this->params['breadcrumbs'][] = ['label' => 'Secteur Activites', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_secteur, 'url' => ['view', 'id' => $model->id_secteur]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="secteur-activite-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
