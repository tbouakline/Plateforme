<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="UTF-8">
<?php 
if (Yii::$app->controller->action->id === 'signups') { 
  ?>    
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="asset/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="asset/css/bootstrap.min.css">
  <link rel="stylesheet" href="asset/css/bd-wizard.css">
    <?php
}else{ 
  ?>
  <link href="css/bootstrap3661.css?v=2.0" rel="stylesheet" type="text/css"/>

<!-- Font awesome 5 -->
<link href="fonts/fontawesome/css/all.min.css" type="text/css" rel="stylesheet">

<!-- custom style -->
<link href="css/ui3661.css?v=2.0" rel="stylesheet" type="text/css"/>
<link href="css/responsive3661.css?v=2.0" rel="stylesheet" type="text/css" />
  <?php
    } 
  ?>    
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<?php $this->beginBody() ?>
<?php 
if (Yii::$app->controller->action->id === 'logins') { 
  ?>
    <body class="hold-transition sidebar-mini">

<div class="wrapper">
    <?= $content ?>
</div>
<?php
}else if (Yii::$app->controller->action->id === 'signups') { 
  ?>
    <body>
    <?= $content ?>
<?php
}else

{ 
?> 
<?php   if (!Yii::$app->user->isGuest) { ?>
<body >
<?php  } else { ?>
<body>
<?php } ?>

 


    <?php echo $this->render('header.php') ?>   


    <section class="section-content padding-y">
      <div class="container">
      
          
              <?php
                $id_controller=Yii::$app->controller->id;
                $id_action=Yii::$app->controller->action->id;
                if(
                  (($id_controller==='site')&&(($id_action==='index')||($id_action==='login')||($id_action==='signup')||($id_action==='reset-password-request')||($id_action==='reset-password')))
                )
                {
                  $class='class="col-md-12 d-flex justify-content-center"';

                  if($id_action!='signup')
                  {
                    $style='style="height:60vh;"';
                  }
                  else
                  {
                    $style='';
                  }
                  
                  $show_right_side=false;
                }
                else
                {
                  $class='class="col-md-9 d-flex justify-content-center"';
                  $style='';
                  $show_right_side=true;
                }
              ?>
              
              <main>
                <div class="row">
                  <div <?= $class ?> <?= $style ?>>
                    <?= $content ?>
                  </div>

                  <?php if ($show_right_side) { ?>
                    <div class="col-md-3">
                      <?php echo $this->render('right_side.php') ?>
                    </div>
                  <?php } ?>
                </div> <!-- row -->
              </main>

              
            
          
       </div> <!-- container -->
    </section>
  

   


  <?php }?>

    <?php 
if (Yii::$app->controller->action->id === 'signups') { 
  ?>    
<script src="asset/js/jquery-3.4.1.min.js"></script>
  <script src="asset/js/popper.min.js"></script>
  <script src="asset/js/bootstrap.min.js"></script>
  <script src="asset/js/jquery.steps.min.js"></script>
  <script src="asset/js/bd-wizard.js"></script>
  <?php 
}else{
  ?>
  <script src="js/jquery-2.0.0.min.js" type="text/javascript"></script>

<!-- Bootstrap4 files-->
<script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="js/script3661.js?v=2.0" type="text/javascript"></script>



<?php
}
  ?>
<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>


