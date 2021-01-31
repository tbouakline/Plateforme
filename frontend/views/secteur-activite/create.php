<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SecteurActivite */

$this->title = 'Create Secteur Activite';
$this->params['breadcrumbs'][] = ['label' => 'Secteur Activites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="secteur-activite-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
