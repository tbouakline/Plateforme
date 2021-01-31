<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Entreprise */

$this->title = 'Create Entreprise';
$this->params['breadcrumbs'][] = ['label' => 'Entreprises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entreprise-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
