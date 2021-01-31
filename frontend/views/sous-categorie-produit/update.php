<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SousCategorieProduit */

$this->title = 'Update Sous Categorie Produit: ' . $model->id_sous_categorie;
$this->params['breadcrumbs'][] = ['label' => 'Sous Categorie Produits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_sous_categorie, 'url' => ['view', 'id' => $model->id_sous_categorie]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sous-categorie-produit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
