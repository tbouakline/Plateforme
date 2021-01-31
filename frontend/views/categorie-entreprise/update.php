<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CategorieEntreprise */

$this->title = 'Update Categorie Entreprise: ' . $model->id_categorie;
$this->params['breadcrumbs'][] = ['label' => 'Categorie Entreprises', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_categorie, 'url' => ['view', 'id' => $model->id_categorie]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="categorie-entreprise-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
