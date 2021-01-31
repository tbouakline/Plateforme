<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CompositionProduitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Composition Produits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="composition-produit-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Composition Produit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_prod',
            'id_matiere',
            'quantite',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
