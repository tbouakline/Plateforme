<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CategorieProduitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorie Produits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorie-produit-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Categorie Produit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_categorie',
            'designation',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
