<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ImageProduitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Image Produits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-produit-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Image Produit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_image',
            'id_prod',
            'chemin',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
