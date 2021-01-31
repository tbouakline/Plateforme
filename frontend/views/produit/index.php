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

    <p>
        <button type="button" class="btn btn-sm btn-primary shadow px-5" data-toggle="modal" data-target="#modal-new-product">Produit <span class="fa fa-plus"></span></button>
    </p>

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

<div class="modal fade in" id="modal-new-product">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Nouveau produit</h4>
              </div>
              <div class="modal-body">
              <?php $form = ActiveForm::begin(['id'=>'new-product', 'options'=>['class'=>'form-horizontal']]); ?>

                <div class="row">

                      <div class="form-group col-md-6">
                        <?= $form->field($newProduit, 'designation')->textInput(); ?>
                      </div>                     

                      <div class="form-group col-md-6">                          
                          <?= $form->field($newProduit, 'reference')->textInput(); ?>
                      </div>

                      <div class="form-group col-md-12">
                        <?= $form->field($newProduit, 'description')->textArea(['rows'=>3]); ?>
                      </div>

                      <div class="form-group col-md-6">                          
                          <?= $form->field($newProduit, 'marque')->textInput(); ?>
                      </div>

                      <div class="form-group col-md-6">                          
                          <?= $form->field($newProduit, 'prix_unitaire')->textInput(); ?>
                      </div>
                   
                      <div class="form-group col-md-6">                  

                            <?php
                            echo $form->field($newProduit, 'id_categorie')->widget(Select2::classname(), [
                                'data' => $listeCategorie,
                                'language' => 'fr',
                                'theme' => 'krajee',
                                'options' => ['placeholder' => ''],
                                'pluginOptions' => ['allowClear' => true],
                            ]);             
                                         
                            ?>

                      </div>
                      <div class="form-group col-md-6">
                            <?php 
                              echo $form->field($newProduit, 'id_sous_categorie')->widget(DepDrop::classname(), [
                                'options'=>['id'=>'produit-id_sous_categorie'],
                                'type' => DepDrop::TYPE_SELECT2,
                                'pluginOptions'=>[
                                  'depends'=>['produit-id_categorie'],
                                  'placeholder'=>'',
                                  'url'=>Url::to(['/produit/sous-categorie'])
                                ]
                              ]);
                            ?>
                        
                      </div>
                      <div class="form-group col-md-12">
                            <?php
                              echo $form->field($newProduit, 'id_type')->widget(DepDrop::classname(), [
                                'options'=>['id'=>'produit-id_type'],
                                'type' => DepDrop::TYPE_SELECT2,
                                'pluginOptions'=>[
                                  'depends'=>['produit-id_categorie', 'produit-id_sous_categorie'],
                                  'placeholder'=>'',
                                  'url'=>Url::to(['/produit/type'])
                                ]
                              ]);             
                                         
                            ?>                
                      </div>                    

                    <?= Html::submitButton('<i class="fa fa-plus"></i> Ajouter',['class'=>'btn btn btn-primary shadow px-5']) ?>
                    <?php ActiveForm::end(); ?>

                    
                  </div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->

          </div> <!-- card-body.// -->
  </div> <!-- card .// -->
        </div>
