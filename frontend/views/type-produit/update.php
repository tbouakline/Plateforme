<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TypeProduit */

$this->title = 'Update Type Produit: ' . $model->id_type;
$this->params['breadcrumbs'][] = ['label' => 'Type Produits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_type, 'url' => ['view', 'id' => $model->id_type]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="type-produit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
