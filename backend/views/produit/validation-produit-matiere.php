<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EntrepriseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Validation des produits / matières premières';
?>
<div class="produit-index">    

    
<div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>     
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="box-body table-responsive">   

        <table class="table table-bordered table-striped">
                  <thead>
                    <tr>                                                
                      <th>Designation</th>
                      <th>Description</th>
                      <th>Marque</th>
                      <th>Référence</th>
                      <th>Produit fini / matière première</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($listeProduits as $produit) { ?>
                    <tr>                                                
                      <td><?= $produit["designation"] ?></td>                                                
                      <td><?= $produit["description"] ?></td>
                      <td><?= $produit["marque"] ?></td>
                      <td><?= $produit["reference"] ?></td>
                      <td><?= $produit["fini_matiere"] ?></td>
                      <td>
                        <a href="index.php?r=produit%2Fview&id=<?= $produit["id_prod"] ?>"><li class="fa fa-fw fa-eye"></li></a>
                      </td>     
                    </tr>
                    <?php } ?>
                  </tbody>                                       
                </table>         
      
      </div><!-- /.box-body -->
    </div>
</div><!-- /.box-body -->


</div>
