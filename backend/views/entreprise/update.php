<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Entreprise */

$this->title = ' Modifier Entreprise: ' . $model->id_entreprise;
$this->params['breadcrumbs'][] = ['label' => 'Entreprises', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_entreprise, 'url' => ['view', 'id' => $model->id_entreprise]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section class="content"">
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-6">
    <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> Mettre à jour</h3>
              </div>
              <div class="card-body"> 
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


              <!-- /.card-body -->
 </div>

   

  
</div>
</div>
</div></div></div>
