<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TypeCaracteristiqueProduit */

$this->title = 'Create Type Caracteristique Produit';
$this->params['breadcrumbs'][] = ['label' => 'Type Caracteristique Produits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-caracteristique-produit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
