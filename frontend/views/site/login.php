<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login-box" style="width:35%;margin-top: auto; margin-bottom: auto;">
  
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Connectez-vous pour démarrer votre session</p>

      <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div >
        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder'=>"Nom d'utilisateur",'class'=>'form-control'])->label(false) ?>

         
        </div>
        <div>
        <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control','placeholder'=>"Mot de passe"]) ->label(false)?>
      
        </div>
        <div class="row">
          <div class="col-6">
            <div class="icheck-primary">
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-6">
          <?= Html::submitButton('<i class="fa fa-fw fa-unlock"></i> Connexion', ['class' => 'btn btn-primary btn-block shadow px-5', 'name' => 'login-button']) ?>
              
          </div>
          <!-- /.col -->
        </div>
      </form>
      <?php ActiveForm::end(); ?>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="index.php?r=site/reset-password-request">J'ai oublié le mot de passe</a>
      </p>
      <p class="mb-0">
        <a href="index.php?r=site/signup" class="text-center">S'inscrire</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>


