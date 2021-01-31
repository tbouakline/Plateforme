<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\HistoriquePrixProd */

$this->title = 'Update Historique Prix Prod: ' . $model->id_prod;
$this->params['breadcrumbs'][] = ['label' => 'Historique Prix Prods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_prod, 'url' => ['view', 'id_prod' => $model->id_prod, 'date_debut' => $model->date_debut]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="historique-prix-prod-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
