<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EntrepriseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Liste des comptes';
?>
<div class="entreprise-index">    

    <div class="box box-danger direct-chat direct-chat-danger">
          <div class="box-body">
            <div class="direct-chat-messages">
                <br><br>
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
            </div><!--/.direct-chat-messages-->
          </div><!-- /.box-body -->
        </div><!--/.direct-chat -->


</div>
