<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CaracteristiqueProduit */

$this->title = 'Create Caracteristique Produit';
$this->params['breadcrumbs'][] = ['label' => 'Caracteristique Produits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caracteristique-produit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
