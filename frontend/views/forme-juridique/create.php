<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\FormeJuridique */

$this->title = 'Create Forme Juridique';
$this->params['breadcrumbs'][] = ['label' => 'Forme Juridiques', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forme-juridique-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
