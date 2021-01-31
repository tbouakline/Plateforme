<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Wilaya */

$this->title = 'Update Wilaya: ' . $model->id_wilaya;
$this->params['breadcrumbs'][] = ['label' => 'Wilayas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_wilaya, 'url' => ['view', 'id' => $model->id_wilaya]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wilaya-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
