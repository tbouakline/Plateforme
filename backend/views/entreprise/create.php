<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Entreprise */

$this->title = 'Create Entreprise';
$this->params['breadcrumbs'][] = ['label' => 'Entreprises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content"">
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-6">
    <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> Creation</h3>
              </div>
              <div class="card-body">               
          <?= $this->render('_form', [ 'model' => $model,  ]) ?>
              </div>
              <!-- /.card-body -->
 </div>

   

  
</div>
</div>
</div></div></div>
