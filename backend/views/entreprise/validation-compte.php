<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EntrepriseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Validation des comptes';
?>
<div class="entreprise-index">    

    

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
                      <th>Username</th>
                      <th>Entreprise</th>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($listeEntreprises as $entreprise) { ?>
                    <tr>                                                
                      <td><?= $entreprise["username"] ?></td>                                                
                      <td><?= $entreprise["nom_rs"] ?></td>
                      <td><?= $entreprise["nom"] ?></td>
                      <td><?= $entreprise["prenom"] ?></td>
                      <td>
                        <a href="index.php?r=entreprise%2Fview&id=<?= $entreprise["id_ent"] ?>"><li class="fa fa-fw fa-eye"></li></a>
                      </td>     
                    </tr>
                    <?php } ?>
                  </tbody>                                       
                </table>


      
      </div><!-- /.box-body -->
    </div>
</div><!-- /.box-body -->


</div>
