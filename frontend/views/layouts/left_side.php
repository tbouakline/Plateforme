


<?php
 if (!Yii::$app->user->isGuest) { 
	 ?>
	<aside class="col-md-3">
		<nav class="list-group">
			<a class="list-group-item"> <b>  NAVIGATION </b>  </a>
			<a class="list-group-item" href="index.php"> <i class="fa fa-fw fa-home"></i> Accueil </a>

			<a class="list-group-item" href="index.php?r=site/profil"> <i class="fa fa-fw fa-user"></i> Mon compte </a>

			<a  class="list-group-item" href="index.php?r=produit"><i class="fa fa-fw fa-shopping-cart"></i> Mes produits</a>
			<a class="list-group-item " href="index.php?r=entreprise"><i class="fa fa-fw fa-industry"></i>  Informations de l'entreprise </a>
			<a class="list-group-item" href="page-profile-seller.html"> <i class="fa fa-fw fa-calendar-check"></i> Mes commandes </a>
			<a class="list-group-item" href="page-profile-setting.html"> <i class="fa fa-fw fa-cart-arrow-down"></i> Panier </a>
			<a class="list-group-item" href="index.php?r=site%2Flogout"><i class="fa fa-fw fa-lock"></i> Déconnexion </a>
		</nav>
		<br>
		
	</aside> <!-- col.// -->
<?php
 }
 ?>