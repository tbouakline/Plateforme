<STYLE>

	

.mystyle{

width: 95%;
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

.card-header .fa {
  transition: .3s transform ease-in-out;
}
.card-header .collapsed .fa {
  transform: rotate(180deg);
}
</STYLE>

<?php

use yii\bootstrap\ActiveForm;
use \yii\db\Query;
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use kartik\select2\Select2;

use yii\helpers\Url;

use kartik\depdrop\DepDrop;
?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
  $(document).ready(function(){

    $('#accordionRecherche .collapse').on('shown.bs.collapse', function(){
    $(this).parent().find(".fa-plus").removeClass("fas fa-plus").addClass("fas fa-minus");
    }).on('hidden.bs.collapse', function(){
    $(this).parent().find(".fa-minus").removeClass("fas fa-minus").addClass("fas fa-plus");
    });

  	var source="<?= $source ?>";

  	if(source=="result")
  	{
  		$('#search_produit').val("<?= isset($filtres['search_produit'])?$filtres['search_produit']:'' ?>");
	    $('#search_entreprise').val("<?= isset($filtres['search_entreprise'])?$filtres['search_entreprise']:'' ?>");
	    $('#signupform-id_secteur').val("<?= isset($filtres['signupform-id_secteur'])?$filtres['signupform-id_secteur']:'' ?>");
	    $('#signupform-id_sous_secteur').val("<?= isset($filtres['signupform-id_sous_secteur'])?$filtres['signupform-id_sous_secteur']:'' ?>");
	    $('#signupform-id_activite').val("<?= isset($filtres['signupform-id_activite'])?$filtres['signupform-id_activite']:'' ?>");
	    $('#signupform-id_categorie').val("<?= isset($filtres['signupform-id_categorie'])?$filtres['signupform-id_categorie']:'' ?>");
	    $('#signupform-id_sous_categorie').val("<?= isset($filtres['signupform-id_sous_categorie'])?$filtres['signupform-id_sous_categorie']:'' ?>");
	    $('#signupform-id_type').val("<?= isset($filtres['signupform-id_type'])?$filtres['signupform-id_type']:'' ?>");
	    $('#signupform-id_wilaya').val("<?= isset($filtres['signupform-id_wilaya'])?$filtres['signupform-id_wilaya']:'' ?>");
	    $('#signupform-id_commune').val("<?= isset($filtres['signupform-id_commune'])?$filtres['signupform-id_commune']:'' ?>");
	    $('#search_prix_min').val("<?= isset($filtres['search_prix_min'])?$filtres['search_prix_min']:'' ?>");
	    $('#search_prix_max').val("<?= isset($filtres['search_prix_max'])?$filtres['search_prix_max']:'' ?>");

  		charger_donnees(1);
  	}

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
      if(source=="index")
      {
      	var form = $("#search_form");
    		form.attr("action", "index.php?r=site/result");
    		form.submit();
      }
      else
      {
      	charger_donnees(1);
      }
      
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



	<div class="card">
	<div class="card-body">
	<?= Html::beginForm(['#'], 'post', ['id' => 'search_form', 'enctype' => 'multipart/form-data']) ?>
		<div class="form-row">
		<div class="col-md-12">
			
				
			<div class="form-group col-md-12 input-group w-100">
			<?php                      
				echo Html::input('text', 'search_produit',null,['class' => 'mystyle','placeholder'=>"Produit", 'id'=>'search_produit', 'type'=>'text', 'list'=> 'liste_designations']);
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
  <div class="card border">

    <!-- Card header -->
    <div class="card-header" role="tab" id="headingPlusCriteres">
      <a data-toggle="collapse" data-parent="#accordionPlusCriteres" href="#collapsePlusCriteres" aria-expanded="true" aria-controls="collapsePlusCriteres" class="collapsed">
        <h6 class="mb-0 text-right">
        Recherche avancée <i class="fa fa-chevron-up pull-right"></i>
        </h6>
      </a>
    </div>

    <!-- Card body -->
    <div id="collapsePlusCriteres" class="collapse" role="tabpanel" aria-labelledby="headingPlusCriteres"
      data-parent="#accordionPlusCriteres">
      <div class="card-body">
        
        <div class="accordion md-accordion" id="accordionRecherche" role="tablist" aria-multiselectable="true">
        <div class="card mb-0">
            <div class="card-header bg-gray" role="tab" id="headingEntreprise">
                 <a data-toggle="collapse" data-parent="#accordionRecherche" href="#collapseEntreprise" aria-expanded="true" aria-controls="collapseEntreprise">
                    <h6 class="mb-0 text-left">
                    <i class="fas fa-plus"></i> Entreprise
                    </h6>
                </a>
            </div>
            <div id="collapseEntreprise" class="card-body collapse" role="tabpanel" aria-labelledby="headingEntreprise" data-parent="#accordionRecherche">
                <div class="form-row">
                  <!--Entreprise-->
                <div class="col-md-12 form-group">
              <label>Entreprise</label>
              <?php                      
                echo Html::input('text', 'search_entreprise',null,['class' => 'mystyle','placeholder'=>"Entreprise", 'id'=>'search_entreprise', 'type'=>'text',]);
              ?>  
            </div> <!-- form-group end.// -->
                  <!--Wilaya/Commune-->
                  <div class="col-md-6 form-group">
              <label>Wilaya</label>
              <?php 
              
              
              echo Select2::widget([
                'name' => 'signupform-id_wilaya',
                'data' => $wilayas,
                'language' => 'fr',
                            'theme' => 'krajee',
                            'options' => ['id' => 'signupform-id_wilaya','placeholder' => 'Wilaya'],
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
                              'placeholder'=>'Commune',
                              'url'=>Url::to(['/site/commune'])
                            ]
                          ]);
                        ?>
                  
            </div> <!-- form-group end.// -->
                  
               </div>
            </div>
          </div><!--card-->

          <div class="card mb-0">
            <div class="card-header bg-gray" role="tab" id="headingActivite">
                <a data-toggle="collapse" data-parent="#accordionRecherche" href="#collapseActivite" aria-expanded="true" aria-controls="collapseActivite">
                  <h6 class="mb-0 text-left">
                    <i class="fas fa-plus rotate-icon"></i> Activité de l'entreprise
                    </h6>
                </a>
            </div>
            <div id="collapseActivite" class="card-body collapse" role="tabpanel" aria-labelledby="headingActivite" data-parent="#accordionRecherche">
                <div class="form-row">
                  <!--Secteur/Sous secteur/Activité-->
                <div class="col-md-6 form-group">
              <label>Secteur d'activité</label>
              <?php 
              echo Select2::widget([
                'name' => 'signupform-id_secteur',
                'data' => $secteurs,
                'language' => 'fr',
                            'theme' => 'krajee',
                            'options' => ['id' => 'signupform-id_secteur','placeholder' => 'Secteur d\'activité'],
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
                              'placeholder'=>'Sous secteur d\'activité',
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
                              'placeholder'=>'Activité',
                              'url'=>Url::to(['/site/activite'])
                            ]
                          ]);             
                                     
                        ?>                
                  </div>
               </div>
            </div>
            </div><!--card-->

            <div class="card mb-0">
            <div class="card-header bg-gray" role="tab" id="headingType">
                <a data-toggle="collapse" data-parent="#accordionRecherche" href="#collapseType" aria-expanded="true" aria-controls="collapseType">
                  <h6 class="mb-0 text-left">
                    <i class="fas fa-plus rotate-icon"></i> Type du produit
                    </h6>
                </a>
            </div>
            <div id="collapseType" class="card-body collapse" role="tabpanel" aria-labelledby="headingType" data-parent="#accordionRecherche">
               <div class="form-row">
                  <!--Catégorie/Sous catégorie/Type produit-->
                  <div class="col-md-6 form-group">
              <label>Catégorie</label>
              <?php 
              
              
              echo Select2::widget([
                'name' => 'signupform-id_categorie',
                'data' => $categories,
                'language' => 'fr',
                            'theme' => 'krajee',
                            'options' => ['id' => 'signupform-id_categorie','placeholder' => 'Catégorie du produit'],
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
                              'placeholder'=>'Sous catégorie du produit',
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
                              'placeholder'=>'Type du produit',
                              'url'=>Url::to(['/site/type'])
                            ]
                          ]);             
                                     
                        ?>                
                  </div>
               </div> 
            </div>
            </div><!--card-->

            <div class="card mb-0">
            <div class="card-header bg-gray" role="tab" id="headingPrix">
                <a data-toggle="collapse" data-parent="#accordionRecherche" href="#collapsePrix" aria-expanded="true" aria-controls="collapsePrix">
                  <h6 class="mb-0 text-left">
                    <i class="fas fa-plus rotate-icon"></i> Prix
                    </h6>
                </a>
            </div>
            <div id="collapsePrix" class="card-body collapse" role="tabpanel" aria-labelledby="headingPrix" data-parent="#accordionRecherche">
               <div class="form-row">
                  <!--Prix-->
                <div class="col-md-6 form-group">
              <label>Prix (Minimum)</label>
              <?php                      
                echo Html::input('number', 'search_prix_min',null,['class' => 'mystyle','placeholder'=>"Prix (Minimum)", 'id'=>'search_prix_min',]);
              ?>  
            </div> <!-- form-group end.// -->
            <div class="col-md-6 form-group">
              <label>Prix (Maximum)</label>
              <?php                      
                echo Html::input('number', 'search_prix_max',null,['class' => 'mystyle','placeholder'=>"Prix (Maximum)", 'id'=>'search_prix_max',]);
              ?>  
            </div> <!-- form-group end.// -->
               </div> 
            </div>
        </div><!--card-->
    </div>
</div>
        
      </div>
    </div>

  </div>
  <!-- Accordion card -->

  


	</div> <!-- col.// -->
		</div> <!-- form-row.// -->
		<?= Html::endForm() ?> 
		<datalist id="liste_designations">
		  
		</datalist>
	</div> <!-- card-body.// -->
	</div> <!-- card .// -->






