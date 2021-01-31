<?php

/* @var $this yii\web\View */
//use kartik\typeahead\Typeahead;
$this->title = 'Résultat de la recherche';

?>

<div class="w-100">
	
	<?= $this->render( 'search_produit', [
										'secteurs'=>$secteurs,
                                        'categories'=>$categories,
                                        'wilayas'=>$wilayas,
                                        'source'=>$source,
                                        'filtres'=>$filtres,
									] );
	?>

	<br>

	<div id="resultat_recherche">


		
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






