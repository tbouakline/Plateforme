<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Entreprise */

$this->title ="Détail entreprise";
$this->params['breadcrumbs'][] = ['label' => 'Entreprises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<section class="content"">
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-6">
    <div class="card card-success">
              <div class="card-header">
              <?= Html::a('Update', ['update', 'id' => $model->id_entreprise], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_entreprise], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    
              </div>
              <div class="card-body"> 
   
     

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_entreprise',
            'secteur_eco',
            'branche',
            'taille',
            'nom_entreprise',
            'siege_social',
            'id_admin',
        ],
    ]) ?>
 </div>
              <!-- /.card-body -->
 </div>

   

  
</div>
</div>
</div></div></div>
