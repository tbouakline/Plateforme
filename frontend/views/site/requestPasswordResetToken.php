<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Demande de réinitialisation du mot de passe';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Veuillez saisir votre email. Un lien pour réinitialiser le mot de passe y sera envoyé :</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('<i class="fa fa-paper-plane"></i> Envoyer', ['class' => 'btn btn-primary shadow px-5',]) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
