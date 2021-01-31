<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

use kartik\select2\Select2;
use yii\captcha\Captcha;
use kartik\depdrop\DepDrop;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>


  
  


  <div class="card" style="width:60%;">
  <div class="card-body">
    <div class="container">
      <div id="wizard">
        
        <section>
		

          <div class="content-wrapper">
          <?php $form = ActiveForm::begin(); ?>
          <h4 class="section-heading">Intoduire vos informations </h4>
            <div class="row">



              <div class="form-group col-md-6">
                
                  <?= $form->field($model, 'username')->textInput(); ?>

                  <?= $form->field($model, 'password')->passwordInput(); ?>
                  
                  <?= $form->field($model, 'nom')->textInput(); ?>
              </div>

              <div class="form-group col-md-6">
                <?= $form->field($model, 'email')->textInput(); ?>

                <?= $form->field($model, 'passwordconf')->passwordInput(); ?>

                <?= $form->field($model, 'prenom')->textInput(); ?>
              </div>

              <div class="form-group col-md-12">
                <?= $form->field($model, 'nom_rs')->textInput(); ?>
              </div>
           
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

                    <?php
                    echo $form->field($model, 'id_secteur')->widget(Select2::classname(), [
                        'data' => $listeSecteur,
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

                    <?php 
                      echo $form->field($model, 'id_sous_secteur')->widget(DepDrop::classname(), [
                        'options'=>['id'=>'signupform-id_sous_secteur'],
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
                        'type' => DepDrop::TYPE_SELECT2,
                        'pluginOptions'=>[
                          'depends'=>['signupform-id_secteur', 'signupform-id_sous_secteur'],
                          'placeholder'=>'',
                          'url'=>Url::to(['/site/activite'])
                        ]
                      ]);             
                                 
                    ?>                
              </div>
             
            <div class="form-group col-md-12">
                  <?= $form->field($model, 'captcha')->widget(Captcha::className(), [

                    'captchaAction' => 'site/captcha', 

                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',

                    

                ]) ?>         
              </div>
            

            <?= Html::submitButton('<i class="far fa-file-alt"></i> S\'inscrire', ['class' => 'btn btn-primary shadow px-5', 'name' => 'signup-button']) ?>
            <?php ActiveForm::end(); ?>

            
          </div>
		  </div>
		 
        </section>
        
        
        
       
      </div>
    </div>

    </div> <!-- card-body.// -->
  </div> <!-- card .// -->