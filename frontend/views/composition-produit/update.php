<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CompositionProduit */

$this->title = 'Update Composition Produit: ' . $model->id_prod;
$this->params['breadcrumbs'][] = ['label' => 'Composition Produits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_prod, 'url' => ['view', 'id_prod' => $model->id_prod, 'id_matiere' => $model->id_matiere]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="composition-produit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
