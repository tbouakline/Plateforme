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
      <p class="login-box-msg">Identifiez-vous pour ouvrir une session</p>

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
      
      <p class="mb-1">
        <a href="index.php?r=site/reset-password-request">J'ai oublié le mot de passe</a>
      </p>

      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>


