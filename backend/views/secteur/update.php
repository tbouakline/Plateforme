<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Secteur_economique */

$this->title = 'Update Secteur Economique: ' . $model->id_secteur_eco;
$this->params['breadcrumbs'][] = ['label' => 'Secteur Economiques', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_secteur_eco, 'url' => ['view', 'id' => $model->id_secteur_eco]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="secteur-economique-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
