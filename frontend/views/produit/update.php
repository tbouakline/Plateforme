<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Produit */

$this->title = 'Mise à jour du produit: ' . $model->designation;
$this->params['breadcrumbs'][] = ['label' => 'Produits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_prod, 'url' => ['view', 'id' => $model->id_prod]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="produit-update w-100">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'composition' => $composition,
        'listeCategorie' => $listeCategorie,
        'listeSousCategorie' => $listeSousCategorie,
        'listeType' => $listeType,
    ]) ?>

</div>
