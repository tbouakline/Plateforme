<?php
use common\models\SecteurActivite;
?>

		<article class="card card-body">
			<figure class="itemside">
				<div class="aside">
					
					<span class="rounded-circle icon-sm bg-secondary"><i class="far fa-clock white"></i></span>
				</div>
				<figcaption class="info">
					<h5 class="title">Suggestions </h5>
					<p>	<ul class="row">
					<?php  
						$secteurs=SecteurActivite::find()->limit(4)->all(); 
						foreach($secteurs as $secteur)
						{
							echo '<li><img src="img/item.png" style="width:10%" alt="">
									<a class="icontext" href="">
									<span>'.$secteur['designation'].'</span></a></li>';
						}
						?>
						<li class="col-md-4 col-lg-4"><a href="#" class="icontext"> <i class="mr-3 fa fa-ellipsis-h"></i> <span>Plus</span> </a></li>
					</ul> </p>
				</figcaption>
			</figure> <!-- iconbox // -->
		</article> <!-- panel-lg.// -->
<br>
		<aside>
			<div class="card card-banner-lg bg-dark">
				<img src="images/banners/banner4.jpg" class="card-img opacity">
				<div class="card-img-overlay text-white">
				  <h2 class="card-title">Espace publicitaire</h2>
				  <p class="card-text" style="max-width: 80%">Cela permet de faire des publicités sur mesure pour vos entreprises</p>
				  <a href="#" class="btn btn-light">Discover</a>
				</div>
			 </div>
		</aside>