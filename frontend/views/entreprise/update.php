<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Entreprise */

$this->title = 'Mise à jour des informations de l\'entreprise : ' . $model->nom_rs;
$this->params['breadcrumbs'][] = ['label' => 'Entreprises', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_ent, 'url' => ['view', 'id' => $model->id_ent]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entreprise-update w-100">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'user' => $user,
        'listeCategorie' => $listeCategorie,
        'listeSecteur' => $listeSecteur,
        'listeSousSecteur' => $listeSousSecteur,
        'listeActivite' => $listeActivite,
        'listeFormeJuridique' => $listeFormeJuridique,
        'listeWilaya' => $listeWilaya,
        'listeCommune' => $listeCommune,
    ]) ?>

</div>
