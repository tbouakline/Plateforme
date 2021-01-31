<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Activite */

$this->title = 'Update Activite: ' . $model->id_act;
$this->params['breadcrumbs'][] = ['label' => 'Activites', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_act, 'url' => ['view', 'id' => $model->id_act]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="activite-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
