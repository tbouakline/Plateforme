<?php

use yii\helpers\Html;

$this->title = 'Fiche de produit: ' . $produit->id_prod;
$this->params['breadcrumbs'][] = ['label' => 'Produits', 'url' => ['site/index']];
$this->params['breadcrumbs'][] = 'Fiche de produit';
?>

<div style="width:65%;">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card mb-3">
	  <div class="row no-gutters">
	    <div class="col-md-4">
	      

	    	<!--Carousel Wrapper-->
			<div id="slide_images" class="carousel slide carousel-fade" data-ride="carousel">
			  <!--Indicators-->
			  <ol class="carousel-indicators">
			  	<?php for($i=0;$i<COUNT($listeImages);$i++) { ?>
					    <li data-target="#slide_images" data-slide-to="<?= $i ?>" <?= ($i==0)?'class="active"':'' ?> ></li>
					<?php } ?>
			  </ol>
			  <!--/.Indicators-->
			  <!--Slides-->
			  <div class="carousel-inner" role="listbox">
			  	<?php for($i=0;$i<COUNT($listeImages);$i++) { ?>
					    <div class="carousel-item <?= ($i==0)?'active':'' ?>" data-interval="500">
					      <img class="d-block w-100" width="320" height="180" src="<?= $listeImages[$i]['chemin'] ?>">
					    </div>
					<?php } ?>
			  </div>
			  <!--/.Slides-->
			  <!--Controls-->
			  <a class="carousel-control-prev" href="#slide_images" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Précédent</span>
			  </a>
			  <a class="carousel-control-next" href="#slide_images" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Suivant</span>
			  </a>
			  <!--/.Controls-->
			</div>
			<!--/.Carousel Wrapper-->


	    </div>
	    <div class="col-md-8">
	      <div class="card-body">
	        <h5 class="card-title"><?= $produit->designation ?></h5>
	        <p class="card-text"><?= $produit->description ?></p>
	        <p class="card-text"><small class="text-muted"><?= $entreprise ?></small></p>
	      </div>
	    </div>
	  </div>
	</div>



</div>












