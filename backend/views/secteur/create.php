<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Secteur_economique */

$this->title = 'Create Secteur Economique';
$this->params['breadcrumbs'][] = ['label' => 'Secteur Economiques', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="secteur-economique-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
