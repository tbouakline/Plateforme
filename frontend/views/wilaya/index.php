<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WilayaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wilayas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wilaya-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Wilaya', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_wilaya',
            'nom',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
