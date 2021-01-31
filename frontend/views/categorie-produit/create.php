<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CategorieProduit */

$this->title = 'Create Categorie Produit';
$this->params['breadcrumbs'][] = ['label' => 'Categorie Produits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorie-produit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
