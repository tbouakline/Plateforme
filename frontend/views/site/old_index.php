
<style>

	

.mystyle{

width: 70%;
display: block;

height: calc(1.5em + 0.9rem + 2px);
padding: 0.45rem 0.85rem;
font-size: 1rem;
font-weight: 400;
line-height: 1.5;
color: #495057;
background-color: #fff;
background-clip: padding-box;
border: 1px solid #ced4da;
border-radius: 0.37rem;

}

input::-webkit-calendar-picker-indicator {
     display: none;
}

</style>
<?php

/* @var $this yii\web\View */
//use kartik\typeahead\Typeahead;
$this->title = 'Accueil';
$this->blocks['content-header']='Tableau de bord';
use yii\bootstrap\ActiveForm;
use \yii\db\Query;
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use kartik\select2\Select2;

use yii\helpers\Url;

use kartik\depdrop\DepDrop;
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script>
  $(document).ready(function(){

    
    charger_donnees(-1);
     

    function charger_donnees(num_page)
    {
      var designation = $('#search_produit').val();
      var entreprise = $('#search_entreprise').val();
      var secteur = $('#signupform-id_secteur').val();
      var sous_secteur = $('#signupform-id_sous_secteur').val();
      var activite = $('#signupform-id_activite').val();
      var categorie = $('#signupform-id_categorie').val();
      var sous_categorie = $('#signupform-id_sous_categorie').val();
      var type = $('#signupform-id_type').val();
      var wilaya = $('#signupform-id_wilaya').val();
      var commune = $('#signupform-id_commune').val();
      var prix_min = $('#search_prix_min').val();
      var prix_max = $('#search_prix_max').val();

      $('#modal-chargement').modal('show');
      $.ajax({
        url:"index.php?r=site/charger-donnees",
        method:"POST",
        data:{"num_page":num_page, "designation":designation, "entreprise":entreprise, "secteur":secteur, "sous_secteur":sous_secteur, "activite":activite, "categorie":categorie, "sous_categorie":sous_categorie, "type":type, "wilaya":wilaya, "commune":commune, "prix_min":prix_min, "prix_max":prix_max,},
        success:function(data)
        {          
          $('#resultat_recherche').html(data);
          $('#modal-chargement').modal('hide');
        },
        error: function (xhr, ajaxOptions, thrownError) {
        $('#resultat_recherche').html("Erreur de chargement des données.");
        $('#modal-chargement').modal('hide');
      }

      });      
    }

    function auto_complete(designation ='')
    {
      $.ajax({
        url:"index.php?r=site/auto-complete",
        method:"POST",
        data:{"designation":designation},
        success:function(data)
        {          
          $('#liste_designations').html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
        	alert(xhr.responseText);
      }

      });      
    }

    $(document).on('click', '.page-link', function(){
      var num_page = $(this).data('num_page');      

      charger_donnees(num_page);
    });

    $('#search_button').click(function(){      
      charger_donnees(1);
    });

    $('#search_produit').keyup(function(){
      var designation = $('#search_produit').val();
      auto_complete(designation);
    });

    $(document).on('click', '.option', function(){
      $('#search_produit').val()=$(this).val();
    });

  });
</script>


<div>
	<div class="card">
	<div class="card-body">
	<?= Html::beginForm(['#', 'id' => 'search_form'], 'post', ['enctype' => 'multipart/form-data']) ?>
		<div class="form-row">
		<div class="col-md-12">
			
				
			<div class="form-group col-md-12 input-group w-100">
			<?php                      
				echo Html::input('text', 'search_produit',null,['class' => 'mystyle','placeholder'=>"Taper vos recherches", 'id'=>'search_produit', 'type'=>'text', 'list'=> 'liste_designations']);
			?>
				
				
					<div class="input-group-append">
						<?= "<br>". Html::button('<i class="fa fa-search"></i>', ['class' => 'btn btn-primary', 'id' => 'search_button']) ; ?>

					
					</div>
			</div>
			
		
		</div> <!-- col.// -->
		<div class="col-md-12">
		<!--Accordion wrapper-->
		<div class="accordion md-accordion" id="accordionPlusCriteres" role="tablist" aria-multiselectable="true">

		  <!-- Accordion card -->
		  <div class="card">

		    <!-- Card header -->
		    <div class="card-header" role="tab" id="headingPlusCriteres">
		      <a class="collapsed" data-toggle="collapse" data-parent="#accordionPlusCriteres" href="#collapsePlusCriteres"
		        aria-expanded="true" aria-controls="collapsePlusCriteres">
		        <h6 class="mb-0 text-right">
		          Plus de critères <i class="fas fa-angle-down rotate-icon"></i>
		        </h6>
		      </a>
		    </div>

		    <!-- Card body -->
		    <div id="collapsePlusCriteres" class="collapse" role="tabpanel" aria-labelledby="headingPlusCriteres"
		      data-parent="#accordionPlusCriteres">
		      <div class="card-body">
		        <div class="form-row">


		        <!--Entreprise-->
		      	<div class="col-md-12 form-group">
					<label>Entreprise</label>
					<?php                      
						echo Html::input('text', 'search_entreprise',null,['class' => 'mystyle','placeholder'=>"", 'id'=>'search_entreprise', 'type'=>'text',]);
					?>  
				</div> <!-- form-group end.// -->	
		  		

		  		<!--Secteur/Sous secteur/Activité-->
		      	<div class="col-md-6 form-group">
					<label>Secteur d'activité</label>
					<?php 
					echo Select2::widget([
				    'name' => 'signupform-id_secteur',
				    'data' => $secteurs,
				    'language' => 'fr',
                        'theme' => 'krajee',
                        'options' => ['id' => 'signupform-id_secteur','placeholder' => 'Sélectionner le secteur'],
                        'pluginOptions' => ['allowClear' => true],
				]);              
					?>  
				</div> <!-- form-group end.// -->
				<div class="col-md-6 form-group">
					<label>Sous secteur</label>
					<?php 
                      echo DepDrop::widget([
                      	'name' => 'signupform-id_sous_secteur',
                        'options'=>['id'=>'signupform-id_sous_secteur'],
                        'type' => DepDrop::TYPE_SELECT2,
                        'pluginOptions'=>[
                          'depends'=>['signupform-id_secteur'],
                          'placeholder'=>'',
                          'url'=>Url::to(['/site/sous-secteur'])
                        ]
                      ]);
                    ?>
					    
				</div> <!-- form-group end.// -->
				<div class="form-group col-md-12">
					<label>Activité</label>
                    <?php
                      echo DepDrop::widget([
                      	'name' => 'signupform-id_activite',
                        'options'=>['id'=>'signupform-id_activite'],
                        'type' => DepDrop::TYPE_SELECT2,
                        'pluginOptions'=>[
                          'depends'=>['signupform-id_secteur', 'signupform-id_sous_secteur'],
                          'placeholder'=>'',
                          'url'=>Url::to(['/site/activite'])
                        ]
                      ]);             
                                 
                    ?>                
              </div>



              <!--Catégorie/Sous catégorie/Type produit-->
              <div class="col-md-6 form-group">
					<label>Catégorie</label>
					<?php 
					
					
					echo Select2::widget([
				    'name' => 'signupform-id_categorie',
				    'data' => $categories,
				    'language' => 'fr',
                        'theme' => 'krajee',
                        'options' => ['id' => 'signupform-id_categorie','placeholder' => 'Sélectionner la catégorie'],
                        'pluginOptions' => ['allowClear' => true],
				]);              
					?>  
				</div> <!-- form-group end.// -->
				<div class="col-md-6 form-group">
					<label>Sous catégorie</label>
					<?php 
                      echo DepDrop::widget([
                      	'name' => 'signupform-id_sous_categorie',
                        'options'=>['id'=>'signupform-id_sous_categorie'],
                        'type' => DepDrop::TYPE_SELECT2,
                        'pluginOptions'=>[
                          'depends'=>['signupform-id_categorie'],
                          'placeholder'=>'',
                          'url'=>Url::to(['/site/sous-categorie'])
                        ]
                      ]);
                    ?>
					    
				</div> <!-- form-group end.// -->
				<div class="form-group col-md-12">
					<label>Type</label>
                    <?php
                      echo DepDrop::widget([
                      	'name' => 'signupform-id_type',
                        'options'=>['id'=>'signupform-id_type'],
                        'type' => DepDrop::TYPE_SELECT2,
                        'pluginOptions'=>[
                          'depends'=>['signupform-id_categorie', 'signupform-id_sous_categorie'],
                          'placeholder'=>'',
                          'url'=>Url::to(['/site/type'])
                        ]
                      ]);             
                                 
                    ?>                
              </div>


              <!--Wilaya/Commune-->
              <div class="col-md-6 form-group">
					<label>Wilaya</label>
					<?php 
					
					
					echo Select2::widget([
				    'name' => 'signupform-id_wilaya',
				    'data' => $wilayas,
				    'language' => 'fr',
                        'theme' => 'krajee',
                        'options' => ['id' => 'signupform-id_wilaya','placeholder' => 'Sélectionner la wilaya'],
                        'pluginOptions' => ['allowClear' => true],
				]);              
					?>  
				</div> <!-- form-group end.// -->
				<div class="col-md-6 form-group">
					<label>Commune</label>
					<?php 
                      echo DepDrop::widget([
                      	'name' => 'signupform-id_commune',
                        'options'=>['id'=>'signupform-id_commune'],
                        'type' => DepDrop::TYPE_SELECT2,
                        'pluginOptions'=>[
                          'depends'=>['signupform-id_wilaya'],
                          'placeholder'=>'',
                          'url'=>Url::to(['/site/commune'])
                        ]
                      ]);
                    ?>
					    
				</div> <!-- form-group end.// -->



				<!--Prix-->
		      	<div class="col-md-6 form-group">
					<label>Prix (Minimum)</label>
					<?php                      
						echo Html::input('number', 'search_prix_min',null,['class' => 'mystyle','placeholder'=>"", 'id'=>'search_prix_min',]);
					?>  
				</div> <!-- form-group end.// -->
				<div class="col-md-6 form-group">
					<label>Prix (Maximum)</label>
					<?php                      
						echo Html::input('number', 'search_prix_max',null,['class' => 'mystyle','placeholder'=>"", 'id'=>'search_prix_max',]);
					?>  
				</div> <!-- form-group end.// -->

          	</div>

		      </div>
		    </div>

		  </div>
		  <!-- Accordion card --> 

		</div>
		<!-- Accordion wrapper -->
	</div> <!-- col.// -->
		</div> <!-- form-row.// -->
		<?= Html::endForm() ?> 
		<datalist id="liste_designations">
		  
		</datalist>
	</div> <!-- card-body.// -->
	</div> <!-- card .// -->

	<br>

	<div id="resultat_recherche">


		
	</div>
	
<div class="row">

<div class="container">

	
<!-- =============== SECTION 2 =============== -->
<section class="padding-bottom">

	<header class="section-heading mb-4">
		<h3 class="title-section">Coin des bonnes affaires</h3>
	</header>

	<div class="row row-sm">
		<div class="col-xl-2 col-lg-3 col-md-4 col-6">
			<div href="#" class="card card-sm card-product-grid">
				<a href="#" class="img-wrap"> 
					<b class="badge badge-danger mr-1">10% OFF</b>
					<img src="images/items/9.jpg"> 
				</a>
				<figcaption class="info-wrap">
					<a href="#" class="title">Just another product name</a>
					<div class="price-wrap">
						<span class="price">$45</span>
						<del class="price-old">$90</del>
					</div> <!-- price-wrap.// -->
				</figcaption>
			</div>
		</div> <!-- col.// -->
		<div class="col-xl-2 col-lg-3 col-md-4 col-6">
			<div href="#" class="card card-sm card-product-grid">
				<a href="#" class="img-wrap"> 
					<b class="badge badge-danger mr-1">85% OFF</b>
					<img src="images/items/10.jpg">
				</a>
				<figcaption class="info-wrap">
					<a href="#" class="title">Some item name here</a>
					<div class="price-wrap">
						<span class="price">$45</span>
						<del class="price-old">$90</del>
					</div> <!-- price-wrap.// -->
				</figcaption>
			</div>
		</div> <!-- col.// -->
		<div class="col-xl-2 col-lg-3 col-md-4 col-6">
			<div href="#" class="card card-sm card-product-grid">
				<a href="#" class="img-wrap"> 
					<b class="badge badge-danger mr-1">10% OFF</b>
					<img src="images/items/11.jpg">
				</a>
				<figcaption class="info-wrap">
					<a href="#" class="title">Great product name here</a>
					<div class="price-wrap">
						<span class="price">$45</span>
						<del class="price-old">$90</del>
					</div> <!-- price-wrap.// -->
				</figcaption>
			</div>
		</div> <!-- col.// -->
		<div class="col-xl-2 col-lg-3 col-md-4 col-6">
			<div href="#" class="card card-sm card-product-grid">
				<a href="#" class="img-wrap"> 
					<b class="badge badge-danger mr-1">90% OFF</b>
					<img src="images/items/12.jpg"> 
				</a>
				<figcaption class="info-wrap">
					<a href="#" class="title">Just another product name</a>
					<div class="price-wrap">
						<span class="price">$45</span>
						<del class="price-old">$90</del>
					</div> <!-- price-wrap.// -->
				</figcaption>
			</div>
		</div> <!-- col.// -->
		<div class="col-xl-2 col-lg-3 col-md-4 col-6">
			<div href="#" class="card card-sm card-product-grid">
				<a href="#" class="img-wrap"> 
					<b class="badge badge-danger mr-1">20% OFF</b>
					<img src="images/items/5.jpg"> 
				</a>
				<figcaption class="info-wrap">
					<a href="#" class="title">Just another product name</a>
					<div class="price-wrap">
						<span class="price">$45</span>
						<del class="price-old">$90</del>
					</div> <!-- price-wrap.// -->
				</figcaption>
			</div>
		</div> <!-- col.// -->
		<div class="col-xl-2 col-lg-3 col-md-4 col-6">
			<div href="#" class="card card-sm card-product-grid">
				<a href="#" class="img-wrap"> 
					<b class="badge badge-danger mr-1">20% OFF</b>
					<img src="images/items/6.jpg">
				</a>
				<figcaption class="info-wrap">
					<a href="#" class="title">Some item name here</a>
					<div class="price-wrap">
						<span class="price">$45</span>
						<del class="price-old">$90</del>
					</div> <!-- price-wrap.// -->
				</figcaption>
			</div>
		</div> <!-- col.// -->
	</div> <!-- row.// -->
</section>
<!-- =============== SECTION 2 END =============== -->
</div>
</div>
</div>

<!-- Progress bar -->
<div class="modal" id="modal-chargement" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        
        <div class="progress">
			  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
		</div>

      </div>
    </div>
  </div>
</div>






