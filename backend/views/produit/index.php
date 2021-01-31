<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\grid\GridView;

use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProduitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Produits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produit-index">

    <div class="card">
  <div class="card-body">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'designation',
            'description',
            'reference',
            'marque',
            //'id_categorie',
            //'id_sous_categorie',
            //'id_type',
            //'fini_matiere',
            //'prix_unitaire',
            //'date_insertion',
            //'date_validation',
            //'id_user_validation',

            ['class' => 'yii\grid\ActionColumn',

                          'template'=>'{view}{update}',

                            'buttons'=>[

                                              'view' => function ($url, $model) { 

                                                return Html::a('<span class="fa fa-eye"></span>', 'index.php?r=produit/view&id='.$model->id_prod, [

                                    'title' => Yii::t('yii', 'Voir'),

                                ]);},


                                              'update' => function ($url, $model) { 

                                                return Html::a('<span class="fa fa-edit"></span>', 'index.php?r=produit/update&id='.$model->id_prod, [

                                    'title' => Yii::t('yii', 'Modifier'),

                                ]);},

                                          ]                            

                                            ],
          ],
    ]); ?>


</div>


  </div> <!-- card .// -->
        </div>
