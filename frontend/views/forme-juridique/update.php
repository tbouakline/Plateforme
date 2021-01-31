<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\FormeJuridique */

$this->title = 'Update Forme Juridique: ' . $model->id_forme;
$this->params['breadcrumbs'][] = ['label' => 'Forme Juridiques', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_forme, 'url' => ['view', 'id' => $model->id_forme]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="forme-juridique-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
