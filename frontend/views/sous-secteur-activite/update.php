<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SousSecteurActivite */

$this->title = 'Update Sous Secteur Activite: ' . $model->id_sous_secteur;
$this->params['breadcrumbs'][] = ['label' => 'Sous Secteur Activites', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_sous_secteur, 'url' => ['view', 'id' => $model->id_sous_secteur]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sous-secteur-activite-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
