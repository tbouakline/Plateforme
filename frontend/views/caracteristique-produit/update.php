<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CaracteristiqueProduit */

$this->title = 'Mise à jour du caractéristique : ' . $model->designation;
$this->params['breadcrumbs'][] = ['label' => 'Caracteristiques du produit', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_caracteristique, 'url' => ['view', 'id' => $model->id_caracteristique]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="caracteristique-produit-update w-100">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'type' => $type,
        'listeTypeCaracteristique' => $listeTypeCaracteristique,
    ]) ?>

</div>
