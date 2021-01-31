<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SousCategorieProduitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sous Categorie Produits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sous-categorie-produit-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sous Categorie Produit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_sous_categorie',
            'designation',
            'id_categorie',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
