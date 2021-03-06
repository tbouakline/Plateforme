<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CaracteristiqueProduitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Caracteristique Produits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caracteristique-produit-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Caracteristique Produit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_caracteristique',
            'id_prod',
            'id_type',
            'designation',
            'valeur',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
