<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SousCategorieProduit */

$this->title = 'Create Sous Categorie Produit';
$this->params['breadcrumbs'][] = ['label' => 'Sous Categorie Produits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sous-categorie-produit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
