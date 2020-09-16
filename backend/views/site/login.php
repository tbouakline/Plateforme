<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Ouvrir une </b>session</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div >
        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder'=>"Nom d'utilisateur",'class'=>'form-control'])->label(false) ?>

         
        </div>
        <div>
        <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control','placeholder'=>"Mot de passe"]) ->label(false)?>
      
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
          <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
              
          </div>
          <!-- /.col -->
        </div>
      </form>
      <?php ActiveForm::end(); ?>
      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="index.php?r=site/signup" class="text-center">Ouvrir un compte</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>


