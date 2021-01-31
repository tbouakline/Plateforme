<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ImageProduit */

$this->title = 'Create Image Produit';
$this->params['breadcrumbs'][] = ['label' => 'Image Produits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-produit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
