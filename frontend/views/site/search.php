<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Produit;

$this->title = 'Recherche';




?>

<section id="inner-headline">
      <div class="container">
        <div class="row">
          <div class="span4">
            <div class="inner-heading">
              <h2>Nos Services</h2>
            </div>
          </div>
          <div class="span8">
            <ul class="breadcrumb">
              <li><a href="index.php"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>    
              <li class="active">Nos services</li>
            </ul>
          </div>
        </div>
      </div>
</section>

<section id="content">
      <div class="container">
        <div class="row">
          <div class="span4">
            <aside class="left-sidebar">
              <div class="widget">
                
    <?php $form = ActiveForm::begin([ 'action' => ['site/search'],'options' => ['method' => 'post']]) ?>

                <form class="form-search">
           
                     
                  <?= Html::input('text','nom_produit','', $options=['class'=>'input-medium search-query']) ?>

                    <?= Html::submitButton('Rechercher', ['class' => 'btn btn-square btn-theme']) ?>
             
                </form>
                <?php ActiveForm::end(); ?>
              </div>
              <div class="widget">
                
                <h5 class="widgetheading">Nos produits</h5>
                <ul class="cat">



              <?php $connection = \Yii::$app->db;
  
  $req="Select * from categories";
  $p = $connection->createCommand($req);
  $pr=$p->query();
    
    foreach($pr as $rwp)   {  ?>
                  <li><i class="icon-angle-right"></i><a href="index.php?r=site/service&id=<?php echo $rwp['id'];?>"><?php echo $rwp['categorie']; ?></a><span> </span></li>
                <?php } ?>
         
                </ul>
              </div>
              <div class="widget">
                <h5 class="widgetheading">Etude et installation</h5>
                <ul class="cat">
                  <li><i class="icon-angle-right"></i><a href="index.php?r=site/service">&Eacute;tude et installation </a> </li>
             
         
                </ul>
              </div>
           
              
            </aside>
          </div>
          <div class="span8">




    			<div class="row">
          <div class="span8">
           
            <h4 class="heading"> Résultats de la recherche</h4>
            <div class="row">
              <section id="projects">
                <ul id="thumbs" class="portfolio">
                  <!-- Item Project and Filter Name -->

              <?php 
         
                      if($model!=null){
                      foreach ($model as $mo){

               ?>
                  <li class="item-thumbs span3 design" data-id="id-0" data-type="web">
                  	<h6><?=$mo->nom_produit ?></h6>
                    <!-- Fancybox - Gallery Enabled - Title - Full Image -->
                    <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="<?=$mo->description ?>" href="<?="img/".$mo->image?>">
						<span class="overlay-img"></span>
						<span class="overlay-img-thumb font-icon-plus"></span>
						</a>
                    <!-- Thumb Image and Description -->
                    <img src="<?="img/".$mo['image'] ?>" alt="<?=$mo['nom_produit'] ?>">

            <?php }}else{
              echo "<h2> Aucun Résultat ne correspend </h2>";;
            } ?>
                  </li>
                  <!-- End Item Project -->
                </ul>
              </section>
            </div>
          </div>
        </div>
   
          </div>
        </div>
      </div>
    </section>