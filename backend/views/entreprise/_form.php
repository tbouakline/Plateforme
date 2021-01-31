<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Entreprise */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entreprise-form">

    <?php $form = ActiveForm::begin(); ?> 

        <div class="card mb-3">
          <div class="card-header text-white bg-info">Utilisateur</div>
          <div class="card-body">
            
            <div class="row">

                <div class="form-group col-md-6">
                    <?= $form->field($user, 'nom')->textInput(['maxlength' => true]) ?>            
                </div>
                <div class="form-group col-md-6">
                    <?= $form->field($user, 'prenom')->textInput(['maxlength' => true]) ?>            
                </div>
                <div class="form-group col-md-6">
                    <?= $form->field($user, 'date_naissance')->widget(DatePicker::className(), [
                        'name' => 'date_naissance',                        
                        'options' => ['placeholder' => 'Date de naissance', 'readOnly'=>false,],
                        'convertFormat' => false,
                        'pluginOptions' => ['minView' =>1 ,
                            'format' => 'yyyy/mm/dd',
                            'todayHighlight' => true
                        ]
                    ]); ?>            
                </div>
                <div class="form-group col-md-6">
                    <?= $form->field($user, 'lieu_naissance')->textInput(['maxlength' => true]) ?>            
                </div>
                <div class="form-group col-md-12">
                    <?= $form->field($user, 'poste')->textInput(['maxlength' => true]) ?>            
                </div>
                <div class="form-group col-md-6">
                    <?= $form->field($user, 'tel')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="form-group col-md-6">
                    <?= $form->field($user, 'fax')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="form-group col-md-6">
                    <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="form-group col-md-6">
                    <?= $form->field($user, 'photo')->fileInput(); ?>
                </div>              

            </div> 

          </div>
        </div>   

        <div class="card mb-3">
          <div class="card-header text-white bg-info">Identité / Contact / Localisation</div>
          <div class="card-body">
            
            <div class="row">

                <div class="form-group col-md-12">
                    <?= $form->field($model, 'nom_rs')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="form-group col-md-6">
                    <?= $form->field($model, 'adresse')->textInput(['maxlength' => true]) ?>            
                </div>        
                <div class="form-group col-md-6">
                   <?php
                        echo $form->field($model, 'id_wilaya')->widget(Select2::classname(), [
                            'data' => $listeWilaya,
                            'language' => 'fr',
                            'theme' => 'krajee',
                            'options' => ['id' => 'signupform-id_wilaya', 'placeholder' => ''],
                            'pluginOptions' => ['allowClear' => true],
                        ]);      
                    ?> 
                </div>
                <div class="form-group col-md-6">
                    <?php 
                      echo $form->field($model, 'id_commune')->widget(DepDrop::classname(), [
                        'options'=>['id'=>'signupform-id_commune'],
                        'data' => $listeCommune,
                        'type' => DepDrop::TYPE_SELECT2,
                        'pluginOptions'=>[
                          'depends'=>['signupform-id_wilaya'],
                          'placeholder'=>'',
                          'url'=>Url::to(['/site/commune'])
                        ]
                      ]);
                    ?>
                </div>
                <div class="form-group col-md-6">
                    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="form-group col-md-6">
                    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="form-group col-md-6">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="form-group col-md-6">
                   <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?> 
                </div>
                <div class="form-group col-md-6">
                    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>
                </div>

            </div> 

          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header text-white bg-info">Identifications</div>
          <div class="card-body">

            <div class="row">
            
                <div class="form-group col-md-6">
                    <?= $form->field($model, 'num_rc')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="form-group col-md-6">
                   <?= $form->field($model, 'article_impo')->textInput(['maxlength' => true]) ?> 
                </div>
                <div class="form-group col-md-6">
                    <?= $form->field($model, 'code_nis')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="form-group col-md-6">
                    <?= $form->field($model, 'code_nif')->textInput(['maxlength' => true]) ?>
                </div>

            </div> 

          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header text-white bg-info">Catégorie / Forme juridique / Activité</div>
          <div class="card-body">

            <div class="row">
            
                <div class="form-group col-md-6">
                    <?php
                        echo $form->field($model, 'id_categorie')->widget(Select2::classname(), [
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
                        echo $form->field($model, 'id_forme_juridique')->widget(Select2::classname(), [
                            'data' => $listeFormeJuridique,
                            'language' => 'fr',
                            'theme' => 'krajee',
                            'options' => ['placeholder' => ''],
                            'pluginOptions' => ['allowClear' => true],
                        ]);      
                    ?>
                </div>
                <div class="form-group col-md-6">
                    <?php
                        echo $form->field($model, 'id_secteur')->widget(Select2::classname(), [
                            'data' => $listeSecteur,
                            'language' => 'fr',
                            'theme' => 'krajee',
                            'options' => ['id'=>'signupform-id_secteur', 'placeholder' => ''],
                            'pluginOptions' => ['allowClear' => true],
                        ]);      
                    ?>
                </div>
                <div class="form-group col-md-6">
                    <?php 
                      echo $form->field($model, 'id_sous_secteur')->widget(DepDrop::classname(), [
                        'options'=>['id'=>'signupform-id_sous_secteur'],
                        'data' => $listeSousSecteur,
                        'type' => DepDrop::TYPE_SELECT2,
                        'pluginOptions'=>[
                          'depends'=>['signupform-id_secteur'],
                          'placeholder'=>'',
                          'url'=>Url::to(['/site/sous-secteur'])
                        ]
                      ]);
                    ?>
                </div>
                <div class="form-group col-md-12">
                    <?php
                      echo $form->field($model, 'id_activite')->widget(DepDrop::classname(), [
                        'options'=>['id'=>'signupform-id_activite'],
                        'data' => $listeActivite,
                        'type' => DepDrop::TYPE_SELECT2,
                        'pluginOptions'=>[
                          'depends'=>['signupform-id_secteur', 'signupform-id_sous_secteur'],
                          'placeholder'=>'',
                          'url'=>Url::to(['/site/activite'])
                        ]
                      ]);             
                                 
                    ?>
                </div>

            </div> 

          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header text-white bg-info">Autres</div>
          <div class="card-body">

            <div class="row">
            
                <div class="form-group col-md-6">
                    <?= $form->field($model, 'capital')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="form-group col-md-6">
                    <?= $form->field($model, 'effectif')->textInput() ?>
                </div>        
                <div class="form-group col-md-6">
                    <?= $form->field($model, 'iso_9001')->checkbox(); ?>
                </div>
                <div class="form-group col-md-6">
                   <?= $form->field($model, 'iso_14001')->checkbox(); ?>
                </div>
                <div class="form-group col-md-6">
                   <?= $form->field($model, 'iso_2200')->checkbox(); ?>
                </div>
                <div class="form-group col-md-6">
                   <?= $form->field($model, 'iso_ohsas_18001')->checkbox(); ?>
                </div>
                <div class="form-group col-md-6">
                    <?= $form->field($model, 'logo')->fileInput(); ?>
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
