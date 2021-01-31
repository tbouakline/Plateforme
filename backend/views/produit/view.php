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

<div class="w-100 produit-view">

    <div class="card">
  <div class="card-body">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if($produit->status==0) { ?>
            <?= Html::a('<i class="fas fa-check"></i> Valider', ['valider-produit-matiere', 'id' => $produit->id_prod, 'status' => 10], ['class' => 'btn btn btn-success shadow px-5']) ?>

            <?= Html::a('<i class="fas fa-window-close"></i> Rejeter', ['valider-produit-matiere', 'id' => $produit->id_prod, 'status' => 12], ['class' => 'btn btn btn-danger shadow px-5']) ?>
        <?php } ?>

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
    <div class="tab-pane active" id="caracteristiques">
      <br><br>                        
      <div class="col-md-12">
        <div class="box box-danger direct-chat direct-chat-danger">
          <div class="box-header with-border">
            <h3 class="box-title"><strong>Caractéristiques</strong>  </h3>
          </div>
          <div class="box-body">
            <div class="direct-chat-messages">
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
                        <?php if($caracteristique->status==0) { ?>
                          <a href="index.php?r=caracteristique-produit%2Fvalider-caracteristique&id=<?= $caracteristique->id_caracteristique ?>&status=10"><li class="fa fa-fw fa-check"></li></a>
                          <a href="index.php?r=caracteristique-produit%2Fvalider-caracteristique&id=<?= $caracteristique->id_caracteristique ?>&status=12"><li class="fa fa-fw fa-window-close"></li></a>

                        <?php } ?>
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
    <div class="tab-pane" id="images">
      <br><br>                        
      <div class="col-md-12">
        <div class="box box-danger direct-chat direct-chat-danger">
          <div class="box-header with-border">
            <h3 class="box-title"><strong>Images</strong>  </h3>
          </div>
          <div class="box-body">
            <div class="direct-chat-messages">
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
                        <?= Html::img('../../frontend/web/'.$image->chemin, ['alt' => 'Image non trouvé','width'=>250,'height'=>250]); ?>
                        </td> 
                      <td>
                        <a href="index.php?r=produit%2Fdelete-image&id=<?= $image->id_image ?>"><li class="fa fa-fw fa-trash"></li></a>
                         <?php if($image->status==0) { ?>
                          <a href="index.php?r=produit%2Fvalider-image&id=<?= $image->id_image ?>&status=10"><li class="fa fa-fw fa-check"></li></a>
                          <a href="index.php?r=produit%2Fvalider-image&id=<?= $image->id_image ?>&status=12"><li class="fa fa-fw fa-window-close"></li></a>

                        <?php } ?>
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
    <div class="tab-pane" id="matieres_premieres">
      <br><br>                        
      <div class="col-md-12">
        <div class="box box-danger direct-chat direct-chat-danger">
          <div class="box-header with-border">
            <h3 class="box-title"><strong>Matières premières</strong>  </h3>
          </div>
          <div class="box-body">
            <div class="direct-chat-messages">
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



