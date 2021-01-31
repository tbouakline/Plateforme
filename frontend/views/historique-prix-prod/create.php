<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\HistoriquePrixProd */

$this->title = 'Create Historique Prix Prod';
$this->params['breadcrumbs'][] = ['label' => 'Historique Prix Prods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historique-prix-prod-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
