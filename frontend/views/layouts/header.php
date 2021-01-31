<?php 
  // use backend\assets\AppAsset;
use yii\helpers\Html;
use common\models\LoginForm;
use yii\bootstrap\ActiveForm;

$model = new LoginForm();
		

    ?>




              <header class="section-header">
<section class="header-main border-bottom">
	<div class="container">
<div class="row align-items-center">
	<div class="col-lg-3 col-sm-4 col-md-4 col-5">
	<a href="index.php" class="brand-wrap">
    <img class="logo" src="img/log.png">
    	<a  href="index.php">   <i class="fa  fa-landmark"></i> Accueil </a>
	</a> <!-- brand-wrap.// -->
	</div>
	<div class="col-lg-4 col-xl-5 col-sm-8 col-md-4 d-none d-md-block">
			<form action="#" class="search-wrap">
				<div class="input-group w-100">
				    
			    </div>
			</form> <!-- search-wrap .end// -->
	</div> <!-- col.// -->
	<div class="col-lg-5 col-xl-4 col-sm-8 col-md-4 col-7">
		<div class="widgets-wrap d-flex justify-content-end">
    <?php if (!Yii::$app->user->isGuest){?>
			<div class="widget-header">
				<a href="#" class="ml-4 icontext">
					<div class="icon"><i class="text-danger fa fa-lg fa-heart"></i></div>
					<div class="text">
						<small class="text-muted">Favorites</small> 
						<div>0 item</div>
					</div>
				</a>
			</div> <!-- widget .// -->
			<div class="widget-header">
				<a href="#" class="ml-4 icontext">
					<div class="icon"><i class="text-info fa fa-lg fa-shopping-cart"></i></div>
					<div class="text">
						<small class="text-muted">Cart</small> 
						<div>3 items</div>
					</div>
				</a>
      </div> <!-- widget .// -->
      
    <?php }?>

			<div class="widget-header dropdown">
      <?php if (!Yii::$app->user->isGuest){?>
				<a href="#" class="ml-4 icontext" data-toggle="dropdown" data-offset="20,10">
					<div class="icon"><i class="text-secondary fa fa-lg fa-user"></i></div>
					<div class="text"> 
            <small class="text-muted">Bonjour.</small> 
            <div>              
              <?= Yii::$app->user->identity->prenom ?>
              <i class="fa fa-caret-down"></i>
            </div>
            
					</div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="index.php?r=entreprise/view&id=<?= Yii::$app->user->identity->id_ent ?>"><i class="fa fa-fw fa-industry"></i>  Informations de l'entreprise </a>
					<a class="dropdown-item" href="index.php?r=produit"><i class="fa fa-fw fa-shopping-cart"></i> Mes produits</a>
					<hr class="dropdown-divider">
					<a class="dropdown-item" href="index.php?r=site%2Fchange-password"><i class="fa fa-fw fa-user"></i> Changer le mot de passe </a>
					<a class="dropdown-item" href="index.php?r=site%2Flogout"><i class="fa fa-fw fa-unlock"></i> Déconnexion</a>
		</div> <!--  dropdown-menu .// -->
        <?php } else{?>
          <a href="#" class="ml-4 icontext" data-toggle="dropdown" data-offset="20,10">
					<div class="icon"><i class="text-secondary fa fa-lg fa-user"></i></div>
					<div class="text"> 
            <div>              
              Compte
               <i class="fa fa-caret-down"></i>
            </div>
            
					</div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="#connexion" data-toggle="modal"><i class="fa fa-fw fa-lock"></i> Connexion</a>
					<a class="dropdown-item" href="index.php?r=site/signup"><i class="far fa-file-alt"></i> S'inscrire</a>
				</div>
              <?php }?>
				
			</div> <!-- widget  dropdown.// -->
		</div>	<!-- widgets-wrap.// -->
	</div> <!-- col.// -->
</div> <!-- row.// -->
	</div> <!-- container.// -->
</section> <!-- header-main .// -->




</header>













<div class="modal fade in" id="connexion">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Se connecter</h4>
              </div>
              <div class="modal-body">
              <?php $form = ActiveForm::begin(["action"=>["site/login"]]); ?>
            <div class="form-group">
              <label for="usrname"><i class="fa fa-fw fa-user"></i> Utilisateur</label>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder'=>"Nom d'utilisateur",'class'=>'form-control'])->label(false) ?>
             
            </div>
            <div class="form-group">
              <label for="psw"><i class="fa fa-fw fa-eye-slash"></i> Mot de passe</label>
            <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control','placeholder'=>"Mot de passe"]) ->label(false)?>
            </div>
            
            <div class="row">
	          <div class="col-6">
	            <div class="icheck-primary">
	            <?= $form->field($model, 'rememberMe')->checkbox() ?>
	            <p class="mb-1">
			    	<a href="index.php?r=site/reset-password-request">J'ai oublié le mot de passe</a>
			    </p>
	            </div>
	          </div>
	          <!-- /.col -->
	          <div class="col-6">
	          <?= Html::submitButton('<i class="fa fa-fw fa-unlock"></i> Connexion', ['class' => 'btn btn-primary btn-block shadow px-5', 'name' => 'login-button']) ?>
	              
	          </div>
	          <!-- /.col -->
	        </div>
             
            <?php ActiveForm::end(); ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


