<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ImageProduit */

$this->title = 'Update Image Produit: ' . $model->id_image;
$this->params['breadcrumbs'][] = ['label' => 'Image Produits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_image, 'url' => ['view', 'id' => $model->id_image]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="image-produit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
