<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EntrepriseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entreprises';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entreprise-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Entreprise', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_ent',
            'nom_rs',
            'adresse',
            'id_commune',
            'id_wilaya',
            //'tel',
            //'fax',
            //'email:email',
            //'longitude',
            //'latitude',
            //'num_rc',
            //'article_impo',
            //'code_nis',
            //'code_nif',
            //'id_categorie',
            //'id_secteur',
            //'id_sous_secteur',
            //'id_activite',
            //'id_forme_juridique',
            //'capital',
            //'effectif',
            //'logo',
            //'iso_9001',
            //'iso_14001',
            //'iso_2200',
            //'iso_ohsas_18001',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
