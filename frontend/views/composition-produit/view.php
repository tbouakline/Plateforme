<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\CompositionProduit */

$this->title = $model->id_prod;
$this->params['breadcrumbs'][] = ['label' => 'Composition Produits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="composition-produit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_prod' => $model->id_prod, 'id_matiere' => $model->id_matiere], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_prod' => $model->id_prod, 'id_matiere' => $model->id_matiere], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_prod',
            'id_matiere',
            'quantite',
        ],
    ]) ?>

</div>
