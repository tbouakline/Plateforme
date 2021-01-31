<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Changement du mot de passe';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Veuillez remplir le formulaire ci-dessous :</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'change-password-form']); ?>

                <?= $form->field($model, 'old_password')->passwordInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'new_password')->passwordInput() ?>
                <?= $form->field($model, 'confirm_new_password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('<i class="fa fa-key"></i> Changer', ['class' => 'btn btn-primary shadow px-5',]) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
