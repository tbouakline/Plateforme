<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model frontend\models\Produit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produit-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="card mb-3">
      <div class="card-header text-white bg-info">Informations du produit</div>
      <div class="card-body">

        <div class="row">
        
            <div class="form-group col-md-6">
                <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group col-md-6">
               <?= $form->field($model, 'reference')->textInput(['maxlength' => true]) ?> 
            </div>
            <div class="form-group col-md-12">
               <?= $form->field($model, 'description')->textArea(['rows'=>3]) ?> 
            </div>
            <div class="form-group col-md-6">
               <?= $form->field($model, 'marque')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group col-md-6">
               <?php if($model->fini_matiere=='PRODUIT FINI') { ?>
                    <?= $form->field($model, 'prix_unitaire')->textInput() ?>
               <?php } else { ?>
                    <?= $form->field($composition, 'quantite')->textInput() ?>
               <?php } ?>
            </div>

        </div> 

      </div>
    </div>

    <div class="card mb-3">
      <div class="card-header text-white bg-info">Catégorie / Sous catégorie / Type du produit</div>
      <div class="card-body">

        <div class="row">
        
            <div class="form-group col-md-6">
               <?php
                    echo $form->field($model, 'id_categorie')->widget(Select2::classname(), [
                        'data' => $listeCategorie,
                        'language' => 'fr',
                        'theme' => 'krajee',
                        'options' => ['id'=>'signupform-id_categorie', 'placeholder' => ''],
                        'pluginOptions' => ['allowClear' => true],
                    ]);      
                ?>
            </div>
            <div class="form-group col-md-6">
                <?php 
                  echo $form->field($model, 'id_sous_categorie')->widget(DepDrop::classname(), [
                    'options'=>['id'=>'signupform-id_sous_categorie'],
                    'data' => $listeSousCategorie,
                    'type' => DepDrop::TYPE_SELECT2,
                    'pluginOptions'=>[
                      'depends'=>['signupform-id_categorie'],
                      'placeholder'=>'',
                      'url'=>Url::to(['/site/sous-categorie'])
                    ]
                  ]);
                ?>
            </div>        
            <div class="form-group col-md-12">
                <?php
                  echo $form->field($model, 'id_type')->widget(DepDrop::classname(), [
                    'options'=>['id'=>'signupform-id_type'],
                    'data' => $listeType,
                    'type' => DepDrop::TYPE_SELECT2,
                    'pluginOptions'=>[
                      'depends'=>['signupform-id_categorie', 'signupform-id_sous_categorie'],
                      'placeholder'=>'',
                      'url'=>Url::to(['/site/type'])
                    ]
                  ]);             
                             
                ?>
            </div>

        </div> 

      </div>
    </div>

    <div class="row">
        <div class="form-group col-md-12">
            <?= Html::submitButton('<i class="fas fa-save"></i> Enregistrer',['class'=>'btn btn btn-primary shadow px-5']) ?>
        </div> 
    </div>

    <?php ActiveForm::end(); ?>

</div>
