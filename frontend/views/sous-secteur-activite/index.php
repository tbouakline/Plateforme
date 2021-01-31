<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SousSecteurActiviteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sous Secteur Activites';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sous-secteur-activite-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sous Secteur Activite', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_sous_secteur',
            'designation',
            'id_secteur',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
