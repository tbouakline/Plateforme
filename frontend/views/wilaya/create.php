<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Wilaya */

$this->title = 'Create Wilaya';
$this->params['breadcrumbs'][] = ['label' => 'Wilayas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wilaya-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
