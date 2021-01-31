<?php

$this->title = 'Accueil';
$this->blocks['content-header']='Accueil';
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>



<div style="width:70%; margin-top: auto; margin-bottom: auto;">
    <?= $this->render( 'search_produit', [
										'secteurs'=>$secteurs,
                                        'categories'=>$categories,
                                        'wilayas'=>$wilayas,
                                        'source'=>$source,
                                        'filtres'=>$filtres,
									] ); 
	?>
</div>
