<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Secteur_economique;
use common\models\Secteur;
use common\models\Entreprise;
use backend\models\Branche;
use yii\widgets\Pjax;
use frontend\models\Activite;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
//use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EntrepriseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entreprises';
$this->params['breadcrumbs'][] = $this->title;
?>


<section class="content"">
<div class="row">

    <div class="container-fluid">
    <div class="row">
    <div class="card">
    <div class="card-header">
    
       
    </div>
    <?php Pjax::begin(['id' => 'new_note']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nom_entreprise',
            'statut_juridique',            
            'taille',
          
            [
              'attribute' => 'id_activite',
              'value' => 'activite.libelli'
              ],
            
              [
                'attribute' => 'wilaya',
                'value' => 'wilayas.nom'
                ],
            [
              'attribute' => 'valide',
              
              'contentOptions' =>function($model, $key, $index, $column){ 
                if($model->valide=='0')return ['class'=>"right badge badge-danger"];
                else if($model->valide=='1') return['class'=> "right badge badge-success"];
              },
              'content'=> function($model, $key, $index, $column){
                if($model->valide=='0')
                return "Invalide";
                else return " Valide";
              }
          ],
            //'siege_social',
            //'id_admin',
           [ 
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Actions',
            'headerOptions' => ['style' => 'color:#337ab7'],
            'template' => "{print}{delete}",
            'buttons' => [
           'print' => function ($url, $model) {
                return Html::a('<i class="icon fas fa-check"></i>', $url, [
                    'title' => Yii::t('app', 'Valider'),
                     
                ]);
            },

            ],
            'urlCreator' => function ($action, $model, $key, $index) {
          
            if ($action === 'print') {
                $url ='index.php?r=entreprise/valider&id='.$model->id_entreprise;
                return $url;
            }
             
              

            }

           ], 
      ],
      'tableOptions' =>['class' => 'table table-striped table-bordered'],
      'rowOptions'=>function ($model, $key, $index, $grid){
        $class=$index%2?'odd':'even';
        return array('key'=>$key,'index'=>$index,'class'=>$class);
      },
        
    ]); ?>
    <?php Pjax::end(); ?>
  
</div>
</div>
</div>


</section>



