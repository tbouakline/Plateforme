<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CategorieEntreprise */

$this->title = 'Create Categorie Entreprise';
$this->params['breadcrumbs'][] = ['label' => 'Categorie Entreprises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorie-entreprise-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
