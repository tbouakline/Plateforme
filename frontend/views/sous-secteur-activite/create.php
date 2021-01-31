<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SousSecteurActivite */

$this->title = 'Create Sous Secteur Activite';
$this->params['breadcrumbs'][] = ['label' => 'Sous Secteur Activites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sous-secteur-activite-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
