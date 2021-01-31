<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TypeProduit */

$this->title = 'Create Type Produit';
$this->params['breadcrumbs'][] = ['label' => 'Type Produits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-produit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
