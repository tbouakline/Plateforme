<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CompositionProduit */

$this->title = 'Create Composition Produit';
$this->params['breadcrumbs'][] = ['label' => 'Composition Produits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="composition-produit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
