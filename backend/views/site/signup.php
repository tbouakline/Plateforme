<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="register-box">
  <div class="register-logo">
    <a href="index.php?r=site/login"><b>Por</b>tail</a>
  </div>
  

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


        <div>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true,'class'=>'form-control', 'placeholder'=>"Nom d'utilisateur"]) ->label(false)?>

             
            

        </div>
        <div >
        <?= $form->field($model, 'email')->textInput(['class'=>'form-control','placeholder'=>"Email"])->label(false) ?>
   
        <div >
        <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control','placeholder'=>"Mot de passe"])->label(false) ?>


        </div>
        <div class="row">
       
          <?= 
          $form->field($model, 'image')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
        ]);
         // $form->field($model, 'image')->fileInput(['class'=> 'form-control','placeholder'=>"Selectionner une image de profile"])->label(false) ?>
         
    </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
          <?= Html::submitButton('Signup', ['class' => 'btn btn-primary btn-block', 'name' => 'signup-button']) ?>
       
          </div>
          <!-- /.col -->
        </div>
        <?php ActiveForm::end(); ?>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="index.php?r=site/login" class="text-center">Déja inscrit</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->


</div>