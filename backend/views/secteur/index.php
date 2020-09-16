<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Secteur;
use backend\models\Activite;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\Secteur_economiqueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Secteurs Economiques';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $model1= Secteur::find()->all();
    $model_sec= new Secteur();
    $secteur = ArrayHelper::map(Activite::find()->asArray()->all(), 'id_activite', 'libelli');

?>

<section class="content"">
  
    <div class="row">
    <div class="col-md-3">
          <?= Html::a('Ajouter un secteur', ['#'], ['class' => 'btn btn-primary btn-block mb-3',"data-toggle"=>"modal", 'data-target'=>"#modal-default3"]) ?>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Secteurs</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0" style="display: block;">
              <ul class="nav nav-pills flex-column">
              <?php 
              foreach($model1 as $m){             
              ?>
                <li class="nav-item active">
                <?php Pjax::begin(['id' => 'new_note']) ?>
                  <a href="index.php?r=secteur&id_secteur=<?=$m['id_secteur'] ?>" class="nav-link" onclick="setIdSecteur(<?=$m['id_secteur'] ?>)">
                    <i class="fas fa-inbox"></i> <?=$m['libelli'];?>
                    <span class="badge bg-primary float-right">12</span>
                  </a>
                  <?php Pjax::end(); ?>
                </li>   
              <?php }?>         
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Create </h3>
                </div>
                <div class="card-body">
                 
                  <!-- /btn-group -->
                  <div class="input-group">
                  <?php Pjax::begin(['id' => 'new_note']) ?>
 <?php $form = ActiveForm::begin([ 'action' => ['secteur/create'],'options' => ['method' => 'post']]) ?>
 <?= $form->field($model_sec, 'libelli')->textInput(['maxlength' => true]) ?>
 <?=  $form->field($model_sec, 'id_secteur')->hiddenInput(['id' => 'idSecteur'])->label(false);?>
                 <div class="input-group-append">
                    <?= Html::submitButton('Sauvegarder' , ['class' => 'btn btn-success']) ?>
                  </div>
                    <?php ActiveForm::end();     ?>
                    <!-- /btn-group -->
                    <?php Pjax::end(); ?>
                  </div>
                  <!-- /input-group -->
                </div>
              </div>    
    </div>



   
   
   
   
   
    <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title" id="titleSecteur" >Activités</h3>

            </div>
            
            


            <?php Pjax::begin(['id' => 'notes']) ?>

            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_entreprise',
            'libelli',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' =>['class' => 'table table-sm'],
        'pager' => [
        'firstPageLabel' => 'first',
        'lastPageLabel' => 'last',
        'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
        'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
    ],
        
    ]);
    
?>
 </div>
  
    <?php Pjax::end() ?>
    </div>

    <?php
    $this->registerJs(
        '$("document").ready(function(){
            $("#new_note").on("pjax:end", function() {
            $.pjax.reload({container:"#notes"});  //Reload GridView
        });
    });'
    );
?>

</div>
</div>
</section>

<script type="text/javascript">

    function setIdSecteur(x) {
        document.getElementById('idSecteur').value = x;
      //  document.getElementById("titleSecteur").innerHTML = y;
    
    }
 
</script>
<div class="modal fade in" id="modal-default3" style="display: none; padding-top: 50px;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title">Secteur économique</h4>
              <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>            
              </div>
              <div class="modal-body">
          
        
        <div class="col-md-12">
<?php $form = ActiveForm::begin([ 'action' => ['secteur_economique/create'],'options' => ['method' => 'post']]) ?>
        <div class="row">
        <div class="col-md-6"> 
       
    <?= $form->field($model_sec, 'libelli')->textInput(['maxlength' => true]) ?>

<?= $form->field($model_sec, 'id_secteur')->textInput() ?>




    
   
        </div>
        
        
        <div class="col-md-12">     
        
        </div>
              </div>
            
               <div class="modal-footer">
               <div class="form-group">
        <?= Html::submitButton('Sauvegarder' , ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end();     ?>
        </div>
              </div>
          
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</div>