<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TypeCaracteristiqueProduitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Type Caracteristique Produits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-caracteristique-produit-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Type Caracteristique Produit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_type',
            'designation',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
