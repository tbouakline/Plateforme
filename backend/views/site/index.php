<?php

/* @var $this yii\web\View */

$this->title = 'Tableau de bord';
?>
  
<div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            

            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fas fa-user"></i></span>

                <div class="info-box-content text-right">
                  <h4 class="mb-0">
                    <a href="index.php?r=entreprise/validation-compte">COMPTES A VALIDER</a>
                  </h4>
                  <h4 class="mb-0">
                    <span class="info-box-number"><?= number_format($users,0,""," ") ?></span>
                  </h4>              
                </div>
            </div>


            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fas fa-cart-arrow-down"></i></span>

                <div class="info-box-content text-right">
                  <h4 class="mb-0">
                    <a href="index.php?r=produit/validation-produit-matiere">PRODUITS A VALIDER</a>
                  </h4>
                  <h4 class="mb-0">
                    <span class="info-box-number"><?= number_format($produits,0,""," ") ?></span>
                  </h4>              
                </div>
            </div>

            
           </div>


          <div class="col-lg-6">
            
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fas fa-image"></i></span>

                <div class="info-box-content text-right">
                  <h4 class="mb-0">
                    <a href="index.php?r=produit/validation-image">IMAGES A VALIDER</a>
                  </h4>
                  <h4 class="mb-0">
                    <span class="info-box-number"><?= number_format($images,0,""," ") ?></span>
                  </h4>              
                </div>
            </div>

            <div class="info-box">
                <span class="info-box-icon bg-pink"><i class="fas fa-file-alt"></i></span>

                <div class="info-box-content text-right">
                  <h4 class="mb-0">
                    <a href="index.php?r=caracteristique-produit/validation-caracteristique">CARACTERISTIQUES A VALIDER</a>
                  </h4>
                  <h4 class="mb-0">
                    <span class="info-box-number"><?= number_format($caracteristiques,0,""," ") ?></span>
                  </h4>              
                </div>
            </div>
            
          </div>
          
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>