<?php 
   use backend\assets\AppAsset;
use yii\helpers\Html;

    ?>


<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Accueil</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fa fa-fw fa-user "></i>
        
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         
          <div class="dropdown-divider"></div>
          <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="<?= (!empty(Yii::$app->user->identity->photo))?'../../frontend/web/'.Yii::$app->user->identity->photo:'../../frontend/web/uploads/photo/no_image.jpg' ?>" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?= Yii::$app->user->identity->username ?></h3>

                <p class="text-muted text-center"><?= Yii::$app->user->identity->poste ?></p>
              </div>
          <div class="dropdown-divider"></div>
          <?= Html::a(
                                    'Changer le mot de passe',
                                    ['/site/change-password'],
                                    ['data-method' => 'post', 'class' => 'dropdown-item dropdown-footer']
                                ) ?>
          <?= Html::a(
                                    'D&eacute;connexion',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'dropdown-item dropdown-footer']
                                ) ?> 
         
        </div>
      </li>
    </ul>
  </nav>


