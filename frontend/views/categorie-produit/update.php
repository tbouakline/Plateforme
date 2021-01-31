<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CategorieProduit */

$this->title = 'Update Categorie Produit: ' . $model->id_categorie;
$this->params['breadcrumbs'][] = ['label' => 'Categorie Produits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_categorie, 'url' => ['view', 'id' => $model->id_categorie]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="categorie-produit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
