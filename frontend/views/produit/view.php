<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\DetailView;

use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

use common\models\Produit;
use common\models\CategorieProduit;
use common\models\SousCategorieProduit;
use common\models\TypeProduit;

use common\models\CaracteristiqueProduit;

/* @var $this yii\web\View */
/* @var $model frontend\models\Produit */
$this->title = $produit->designation;
$this->params['breadcrumbs'][] = ['label' => 'Produits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<script>
function show_hide_carac()
{
  ddlType= document.getElementById("caracteristiqueproduit-id_type");

  if(ddlType.options[ddlType.selectedIndex].text=="AUTRES")
  {
    document.getElementById("div_designation_type").style.display="block";
    document.getElementById("caracteristiqueproduit-designation").value="";
  }
  else
  {
    document.getElementById("div_designation_type").style.display="none";
    document.getElementById("caracteristiqueproduit-designation").value=ddlType.options[ddlType.selectedIndex].text;
  }
}
</script>

<div class="w-100 produit-view">

    <div class="card">
  <div class="card-body">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-edit"></i> Modifier', ['update', 'id' => $produit->id_prod], ['class' => 'btn btn btn-primary shadow px-5']) ?>
    </p>

        <div class="card mb-3">
          <div class="card-header text-white bg-info">Informations du produit</div>
          <div class="card-body">
            
            <?= DetailView::widget([
                'model' => $produit,
                'attributes' => [
                    'designation',
                    'description',
                    'reference',
                    'marque',
                    [
                    'label'  => 'Catégorie',
                    'value'  => function ($data) {
                        $categorie=CategorieProduit::findOne($data->id_categorie);
                        return (!empty($categorie)?$categorie->designation:'');                
                      },
                    ],
                    [
                    'label'  => 'Sous catégorie',
                    'value'  => function ($data) {
                        $sousCategorie=SousCategorieProduit::findOne($data->id_sous_categorie);
                        return (!empty($sousCategorie)?$sousCategorie->designation:'');                
                      },
                    ],
                     [
                    'label'  => 'Type',
                    'value'  => function ($data) {
                        $type=TypeProduit::findOne($data->id_type);
                        return (!empty($type)?$type->designation:'');                
                      },
                    ],
                    [
                    'label'  => 'Prix unitaire',
                    'value'  => function ($data) {
                        return !empty($data->prix_unitaire)?number_format($data->prix_unitaire,2,',',' '):"";                
                      },
                    ],
                    [
                    'label'  => 'Statut',
                    'value'  => function ($data) {
                        switch($data->status)
                        {
                            case 0 :
                                $status="En attente de validation";
                                break;
                            case 10 :
                                $status="Validé";
                                break;
                            case 12 :
                                $status="Bloqué";
                                break;
                        } 

                        return $status;               
                      },
                    ],
                ],
            ]) ?>
            

          </div>
        </div>

    

    </div> <!-- card-body.// -->
  </div> <!-- card .// -->

  <br>

<!-- Entêtes des onglets -->
<ul class="nav nav-tabs">
  <li class="nav-item"><a class="nav-link active" href="#caracteristiques" data-toggle="tab">Caractéristiques</a></li>
  <?php if($produit->fini_matiere=='PRODUIT FINI') { ?>
    <li class="nav-item"><a class="nav-link" href="#images" data-toggle="tab">Images</a></li>  
    <li class="nav-item"><a class="nav-link" href="#matieres_premieres" data-toggle="tab">Matières premières</a></li>
  <?php } ?>
</ul>

<!-- Détails des onglets -->
<div class="tab-content">

    <!-- Caractéristiques -->
    <div class="tab-pane fade show active" id="caracteristiques">
      <br><br>                        
      <div class="col-md-12">
        <div class="box box-danger direct-chat direct-chat-danger">
          <div class="box-header with-border">
            <h3 class="box-title"><strong>Caractéristiques</strong>  </h3>
          </div>
          <div class="box-body">
            <div class="direct-chat-messages">
                <button type="button" class="btn btn-primary btn-sm shadow px-5" data-toggle="modal" data-target="#modal-new-caracteristique">Ajouter <span class="fa fa-plus"></span>
                </button>
                <br><br>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>                                                
                      <th>Caractéristique</th>
                      <th>Valeur</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($listeCaracteristiques as $caracteristique) { ?>
                    <tr>                                                
                      <td><?= $caracteristique->designation; ?></td>                                                
                      <td><?= $caracteristique->valeur; ?></td>
                      <td>
                        <a href="index.php?r=caracteristique-produit%2Fupdate&id=<?= $caracteristique->id_caracteristique ?>"><li class="fa fa-fw fa-edit"></li></a>
                      </td>     
                    </tr>
                    <?php } ?>
                  </tbody>                                       
                </table>                   
            </div><!--/.direct-chat-messages-->
          </div><!-- /.box-body -->
        </div><!--/.direct-chat -->
      </div><!-- /.col -->
  </div>

<?php if($produit->fini_matiere=='PRODUIT FINI') { ?>
  <!-- Images -->
    <div class="tab-pane fade show" id="images">
      <br><br>                        
      <div class="col-md-12">
        <div class="box box-danger direct-chat direct-chat-danger">
          <div class="box-header with-border">
            <h3 class="box-title"><strong>Images</strong>  </h3>
          </div>
          <div class="box-body">
            <div class="direct-chat-messages">
                <button type="button" class="btn btn-primary btn-sm shadow px-5" data-toggle="modal" data-target="#modal-new-image">Ajouter <span class="fa fa-plus"></span>
                </button>
                <br><br>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Chemin</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($listeImages as $image) { ?>
                    <tr>                                                
                      <td>
                        <?= Html::img($image->chemin, ['alt' => 'Image non trouvé','width'=>250,'height'=>250]); ?>
                        </td> 
                      <td>
                        <a href="index.php?r=produit%2Fdelete-image&id=<?= $image->id_image ?>"><li class="fa fa-fw fa-trash"></li></a>
                      </td>     
                    </tr>
                    <?php } ?>
                  </tbody>                                       
                </table>                   
            </div><!--/.direct-chat-messages-->
          </div><!-- /.box-body -->
        </div><!--/.direct-chat -->
      </div><!-- /.col -->
  </div>

  <!-- Matières premières -->
    <div class="tab-pane fade show" id="matieres_premieres">
      <br><br>                        
      <div class="col-md-12">
        <div class="box box-danger direct-chat direct-chat-danger">
          <div class="box-header with-border">
            <h3 class="box-title"><strong>Matières premières</strong>  </h3>
          </div>
          <div class="box-body">
            <div class="direct-chat-messages">
                <button type="button" class="btn btn-sm btn-primary shadow px-5" data-toggle="modal" data-target="#modal-new-matiere-premiere">Ajouter <span class="fa fa-plus"></span>
                </button>
                <br><br>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>                                                
                      <th>Désignation</th>
                      <th>Description</th>
                      <th>Quantité</th>
                      <th>Caractéristiques</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($listeMatieres as $matiere) 
                          { 
                            $prod_compo=Produit::findOne($matiere->id_matiere);
                    ?>
                    <tr>                                                
                      <td><?= $prod_compo->designation; ?></td>                      
                      <td><?= $prod_compo->description; ?></td>
                      <td><?= $matiere->quantite; ?></td> 
                      <td>
                        <?php
                          $caracMatPrem=CaracteristiqueProduit::find()->where(['id_prod'=>$matiere->id_matiere])->all();
                        ?>
                        <ul>
                          <?php foreach($caracMatPrem as $oneCarac) { ?>
                            <li>
                              <b><u><?= $oneCarac->designation; ?> :</u></b> <?= $oneCarac->valeur; ?>
                            </li>
                          <?php } ?>
                        </ul>
                      </td>
                      <td>
                        <a href="index.php?r=produit%2Fview&id=<?= $matiere->id_matiere ?>"><li class="fa fa-fw fa-eye"></li></a>
                        <a href="index.php?r=produit%2Fupdate&id=<?= $matiere->id_matiere ?>"><li class="fa fa-fw fa-edit"></li></a>
                      </td>     
                    </tr>
                    <?php } ?>
                  </tbody>                                       
                </table>                   
            </div><!--/.direct-chat-messages-->
          </div><!-- /.box-body -->
        </div><!--/.direct-chat -->
      </div><!-- /.col -->
    </div>
<?php } ?>    
</div>

</div>


<!-- Nouvelle caractéristique -->
<div class="modal fade in" id="modal-new-caracteristique">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Nouvelle caractéristique</h4>
              </div>
              <div class="modal-body">
              <?php $form = ActiveForm::begin(['id'=>'new-caracteristique', 'options'=>['class'=>'form-horizontal']]); ?>

                <div class="row">

                      <div class="form-group col-md-6">                  

                            <?php
                            echo $form->field($newCaracteristique, 'id_type')->widget(Select2::classname(), [
                                'data' => $listeTypeCaracteristique,
                                'language' => 'fr',
                                'theme' => 'krajee',
                                'options' => ['onchange'=>'js:show_hide_carac();','placeholder' => '','multiple' => false,  'allowClear' => true],
                                'pluginOptions' => ['allowClear' => true],
                            ]);             
                                         
                            ?>

                      </div>
                      <div id="div_designation_type" class="form-group col-md-6" style="display:none">
                        <?= $form->field($newCaracteristique, 'designation')->textInput(); ?>
                      </div>  

                      <div class="form-group col-md-12">                          
                          <?= $form->field($newCaracteristique, 'valeur')->textInput(); ?>
                      </div>                    

                    <?= Html::submitButton('<i class="fa fa-plus"></i> Ajouter',['class'=>'btn btn-success btn btn-primary shadow px-5']) ?>
                    <?php ActiveForm::end(); ?>

                    
                  </div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

<?php if($produit->fini_matiere=='PRODUIT FINI') { ?>
<!-- Nouvelle Image -->
<div class="modal fade in" id="modal-new-image">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Nouvelle image</h4>
              </div>
              <div class="modal-body">
              <?php $form = ActiveForm::begin(['id'=>'new-image', 'options'=>['class'=>'form-horizontal']]); ?>

                <div class="row">

                      <div class="form-group col-md-12">                          
                          <?= $form->field($newImage, 'chemin')->fileInput(); ?>
                      </div>                    

                    <?= Html::submitButton('<i class="fa fa-plus"></i> Ajouter',['class'=>'btn btn-success btn btn-primary shadow px-5']) ?>
                    <?php ActiveForm::end(); ?>

                    
                  </div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

<!-- Nouvelle matière première -->
<div class="modal fade in" id="modal-new-matiere-premiere">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Nouvelle matière première</h4>
              </div>
              <div class="modal-body">
              <?php $form = ActiveForm::begin(['id'=>'new-matiere-premiere', 'options'=>['class'=>'form-horizontal']]); ?>

                <div class="row">

                      <div class="form-group col-md-6">
                        <?= $form->field($newMatiere, 'designation')->textInput(); ?>
                      </div>

                      <div class="form-group col-md-6">                          
                          <?= $form->field($newMatiere, 'reference')->textInput(); ?>
                      </div>

                      <div class="form-group col-md-12">
                        <?= $form->field($newMatiere, 'description')->textArea(['rows'=>3]); ?>
                      </div>                      

                      <div class="form-group col-md-6">                          
                          <?= $form->field($newMatiere, 'marque')->textInput(); ?>
                      </div>

                      <div class="form-group col-md-6">                          
                          <?= $form->field($newComposition, 'quantite')->textInput(); ?>
                      </div> 
                   
                      <div class="form-group col-md-6">                  

                            <?php
                            echo $form->field($newMatiere, 'id_categorie')->widget(Select2::classname(), [
                                'data' => $listeCategorie,
                                'language' => 'fr',
                                'theme' => 'krajee',
                                'options' => ['placeholder' => ''],
                                'pluginOptions' => ['allowClear' => true],
                            ]);             
                                         
                            ?>

                      </div>
                      <div class="form-group col-md-6">
                            <?php 
                              echo $form->field($newMatiere, 'id_sous_categorie')->widget(DepDrop::classname(), [
                                'options'=>['id'=>'produit-id_sous_categorie'],
                                'type' => DepDrop::TYPE_SELECT2,
                                'pluginOptions'=>[
                                  'depends'=>['produit-id_categorie'],
                                  'placeholder'=>'',
                                  'url'=>Url::to(['/produit/sous-categorie'])
                                ]
                              ]);
                            ?>
                        
                      </div>
                      <div class="form-group col-md-12">
                            <?php
                              echo $form->field($newMatiere, 'id_type')->widget(DepDrop::classname(), [
                                'options'=>['id'=>'produit-id_type'],
                                'type' => DepDrop::TYPE_SELECT2,
                                'pluginOptions'=>[
                                  'depends'=>['produit-id_categorie', 'produit-id_sous_categorie'],
                                  'placeholder'=>'',
                                  'url'=>Url::to(['/produit/type'])
                                ]
                              ]);             
                                         
                            ?>                
                      </div>
                                         

                    <?= Html::submitButton('<i class="fa fa-plus"></i> Ajouter',['class'=>'btn btn-success btn btn-primary shadow px-5']) ?>
                    <?php ActiveForm::end(); ?>

                    
                  </div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<?php } ?>




