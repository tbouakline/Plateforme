<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Nos Services';




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


            <?php if (!isset($_GET['id'])) {
              
             ?>
            <article>
              <div class="row">
               <div class="span8">
            <h4>Prot&egrave;gez vous contre la foudre</h4>
            <div class="accordion" id="accordion2">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
              1. Ce que nous faisons </a>
                </div>
                <div id="collapseOne" class="accordion-body collapse" style="height: 0px;">
                  <div class="accordion-inner">
                    <p>
                    <span class="pullquote-right margintop10">STARKELEC INDUSTRIES spécialisé dans le domaine de PARATONNERRE. Nous sommes les experts de la protection contre la
          foudre, des structures et de leurs installations de réseau
          (électriques, communications).  
          </span>
          </p>
          <p>
            <span class="pullquote-left">
          La composition et l'installation d'un système de protection
          contre la foudre dépend de multiples facteurs incluant notamment les caractéristiques des bâtiments à protéger et
          leur environnement. 
          </span>
          </p>
          <p>
           <span class="pullquote-right margintop10">
          Pour répondre à la norme <strong>NFC 17-102</strong> et vous procurer une
          protection efficace, chaque installation doit faire l'objet d'une étude préalable.
          Notre équipe et là pour réaliser cette étude et vous apporter ainsi les conditions nécessaires pour assurer
          votre sécurité et la préservation de votre garantie.
          </span>
                              </p>
                  </div>
                </div>
              </div>
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
              2. Domaine d'activit&eacute; </a>
                </div>
                <div id="collapseTwo" class="accordion-body collapse" style="height: 0px;">
                  <div class="accordion-inner">
                    <p>
                      <dl>
              <dt>ETUDE ET INSTLLATION DE PARATONNERRE.</dt>
              <dd></dd>
              <dt>MESURE DE TERRE.</dt>
              <dd></dd>
              <dt>MISE A LA TERRE</dt>
              <dd></dd>
              <dt>VERIFICATION DES INSTLLATIONS.</dt>
            </dl>
                    </p>
                  </div>
                </div>
              </div>
             
 
            </div>
          </div>
          </div>     
        
            
          
            </article>
 <?php }else{ 
    
 $connection = \Yii::$app->db;
  
  $req="Select * from categories  where id='".$_GET['id']."'";
  $p = $connection->createCommand($req);
  $pr=$p->query();?>

          <div class="row">
          <div class="span8">
            <?php foreach ($pr as $r)      ?>
            <h4 class="heading"><?php echo $r['categorie']?></h4>
            <div class="row">
              <section id="projects">
                <ul id="thumbs" class="portfolio">
                  <!-- Item Project and Filter Name -->

              <?php 
  $req1="Select * from produit  where id_categorie='".$_GET['id']."'";
 $p1 = $connection->createCommand($req1);
  $pr1=$p1->query();
foreach ($pr1 as $r1){

               ?>
                  <li class="item-thumbs span3 design" data-id="id-0" data-type="web">
                    <h6><?=$r1['nom_produit'] ?></h6>
                    <!-- Fancybox - Gallery Enabled - Title - Full Image -->
                    <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="<?=$r1['description'] ?>" href="<?="img/".$r1['image']?>">
            <span class="overlay-img"></span>
            <span class="overlay-img-thumb font-icon-plus"></span>
            </a>
                    <!-- Thumb Image and Description -->
                    <img src="<?="img/".$r1['image'] ?>" alt="<?=$r1['nom_produit'] ?>">

            <?php } ?>
                  </li>
                  <!-- End Item Project -->
                </ul>
              </section>
            </div>
          </div>
        </div>
    <?php } ?>
          </div>
        </div>
      </div>
    </section>