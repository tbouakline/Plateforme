<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Commune */

$this->title = 'Update Commune: ' . $model->id_commune;
$this->params['breadcrumbs'][] = ['label' => 'Communes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_commune, 'url' => ['view', 'id' => $model->id_commune]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="commune-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
