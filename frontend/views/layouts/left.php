<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
			<?php
	$filenamejpeg = 'uploads/profile/'.Yii::$app->user->identity->id.'.jpeg';
	$filenamejpg = 'uploads/profile/'.Yii::$app->user->identity->id.'.jpg';
	$filenamebmp = 'uploads/profile/'.Yii::$app->user->identity->id.'.bmp';
	$filenamepng = 'uploads/profile/'.Yii::$app->user->identity->id.'.png';
	$filename='';
	if (file_exists($filenamejpeg)) $filename=$filenamejpeg;
	if (file_exists($filenamejpg)) $filename=$filenamejpg;
	if (file_exists($filenamebmp)) $filename=$filenamebmp;
	if (file_exists($filenamepng)) $filename=$filenamepng;
	if ($filename=='') $filename="img/logo.png";?>
                <img src="<?= $filename ?>"  style="    height: 35px; width:35px;    border-radius: 50%" alt=""/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->nom ?></p>

                <a href="#"><?= Yii::$app->user->identity->prenom ?></a>
            </div>
        </div>
		
		
		<ul class="sidebar-menu" data-widget="tree">
		<li >
          <a href="index.php?r=site/index">
            <i class="fa fa-dashboard"></i> <span>Tableau de bord</span>
          </a>
        </li>
		<li class="treeview">
              <a href="#">
                <i class="fa fa-paint-brush"></i>
                <span>Nouvelle Demande</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">				
						
						<li >
                            <a href="index.php?r=conge/new1">
                                <i class="fa fa-hourglass-half"></i>
                                <span>Demande de Récupération</span>
                            </a>
                        </li>
						 <li >
							  <a href="index.php?r=conge/new">
								<i class="fa fa-dashboard"></i> <span>Demande de congé</span>
							  </a>
						</li>
						 <?php if (Yii::$app->user->identity->type!='COLLABORATEUR'){ ?>
						<li>
                            <a href="index.php?r=missions%2Fcreate">
                                <i class="fa fa-truck"></i> <span>Demande de mission</span> 
                            </a>
                        </li>
						<li >
                            <a href="index.php?r=recuperation%2Fcreate">
                                <i class="fa fa-files-o"></i>
                                <span>Demande de réquisition</span>
                            </a>
                        </li>
						 <?php } ?>
				</ul>
		</li>
		<?php if ((Yii::$app->user->identity->type=='DG')) { ?>
				<li><a href="index.php?r=conge/demandesvaliderdg"><i class="fa fa-circle-o text-red"></i> <span>Cong&eacute;s A valider  </span></a></li>
		<?php } ?>
        <li class="header">Gestion des r&eacute;cup&eacute;rations</li>

					   
						
						
		<li class="treeview <?php if ((Yii::$app->controller->id=='recuperation')) echo 'active' ?>">
              <a href="#">
                <i class="fa fa-plug"></i>
                <span>R&eacute;quisitions</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php?r=recuperation/"><i class="fa fa-circle-o text-red"></i> <span>Requisitions en cours</span></a></li>
				<li><a href="index.php?r=recuperation/annule"><i class="fa fa-circle-o text-yellow"></i> <span>Requisitions rejetées</span></a></li>
				<li><a href="index.php?r=recuperation/accepte"><i class="fa fa-circle-o text-aqua"></i> <span>Requisitions acceptées </span></a></li>
				<?php if ((Yii::$app->user->identity->type=='RH')||(Yii::$app->user->identity->type=='DG')) {?>
				<li><a href="index.php?r=recuperation/indext"><i class="fa fa-circle-o text-aqua"></i> <span>Requisitions a traiter  </span></a></li>
				
				<?php }?>
				<?php if ((Yii::$app->user->identity->type=='DG')) {?>
				<li><a href="index.php?r=recuperation/acceptet"><i class="fa fa-circle-o text-aqua"></i> <span>Requisitions valid&eacute;es  </span></a></li>
				<?php }?>
              </ul>
            </li>
		<?php if ((Yii::$app->user->identity->type=='STRUCTURE')||(Yii::$app->user->identity->type=='RH')) {?>	
		<li class="treeview <?php if ((Yii::$app->controller->id=='recuperation')) echo 'active' ?>">
              <a href="#">
                
                <span>R&eacute;quisitions/Collaborateurs</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php?r=recuperation/indexc"><i class="fa fa-circle-o text-red"></i> <span>Requisitions en cours</span></a></li>
				<li><a href="index.php?r=recuperation/annulec"><i class="fa fa-circle-o text-yellow"></i> <span>Requisitions rejetées</span></a></li>
				<li><a href="index.php?r=recuperation/acceptec"><i class="fa fa-circle-o text-aqua"></i> <span>Requisitions acceptées </span></a></li>
              </ul>
            </li>
			<?php }?>
		<?php if (Yii::$app->user->identity->type=='RH') {?>	
		<li class="treeview <?php if ((Yii::$app->controller->id=='recuperation')) echo 'active' ?>">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>R&eacute;quisitions AE</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php?r=recuperation/indext"><i class="fa fa-circle-o text-red"></i> <span>Requisitions en cours</span></a></li>
				<li><a href="index.php?r=recuperation/annulet"><i class="fa fa-circle-o text-yellow"></i> <span>Requisitions rejetées</span></a></li>
				<li><a href="index.php?r=recuperation/acceptet"><i class="fa fa-circle-o text-aqua"></i> <span>Requisitions acceptées </span></a></li>
              </ul>
            </li>
			<?php }?>
		<li class="header">Gestion des congés</li>
       
		<li><a href="index.php?r=conge/index"><i class="fa fa-ship"></i> Mes Demandes de congé</a></li>
		<?php if (Yii::$app->user->identity->type!='COLLABORATEUR') {?>
						
                       <li>
                            <a href="index.php?r=conge/collaborateur">
                                <i class="fa fa-share text-red"></i> <span>Demandes des collaborateurs</span>
                            </a>
                       </li>
		<?php }?>
		<?php if (Yii::$app->user->identity->type=='RH') {?>
						
                       <li>
                            <a href="index.php?r=conge/demandesvalider">
                                <i class="fa fa-share text-blue"></i> <span>Demandes A valider</span>
                            </a>
                       </li>
					    <li>
                            <a href="index.php?r=conge/historique">
                                <i class="fa fa-paw text-blue"></i> <span>Historique congés</span>
                            </a>
                       </li>
					    <li>
                            <a href="index.php?r=recrutement">
                                <i class="fa fa-paw text-blue"></i> <span>Annonces Recrutement</span>
                            </a>
                       </li>
		<?php }?>
		<?php if ((Yii::$app->user->identity->type=='RH') ||(Yii::$app->user->identity->type=='DG')){?>	
		<li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>&Eacute;tats</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php?r=conge/etat1"><i class="fa fa-circle-o text-red"></i> <span>&Eacute;tat des cong&eacute;s</span></a></li>
				<li><a href="index.php?r=conge/etat2"><i class="fa fa-circle-o text-red"></i> <span>&Eacute;tat des r&eacute;cup&eacute;ration</span></a></li>
				<li><a href="index.php?r=conge/hs"><i class="fa fa-circle-o text-blue"></i> <span>Heures Supp</span></a></li>
				<li><a href="index.php?r=users/rh"><i class="fa fa-circle-o text-blue"></i> <span>Utilisateurs</span></a></li>
				
              </ul>
            </li>
			<?php }?>
			
			<?php if (Yii::$app->user->identity->type=='RH'){?>	
		<li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Evaluations RH</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php?r=rhevaluation"><i class="fa fa-circle-o text-red"></i> <span>Gestion des &eacute;valuations</span></a></li>
				
              </ul>
            </li>
			<?php }?>
		
		 	<li>
                <a href="index.php?r=rhevaluation/mesevaluation">
                <i class="fa fa-dashboard"></i> <span>Mes évaluations</span>
                </a>
            </li>
			<?php if ((Yii::$app->user->identity->id=='202019')||(Yii::$app->user->identity->id=='202277')){?>	
			<li>
                <a href="index.php?r=rhevaluation/rh">
                <i class="fa fa-dashboard"></i> <span>évaluations Globale</span>
                </a>
            </li>
				<?php }?>
			<li>
                <a href="index.php?r=rhevaluation/indexe">
                <i class="fa fa-dashboard"></i> <span>évaluations collaborateurs</span>
                </a>
            </li>
			<li>
                <a href="index.php?r=ticket/reclamations">
                <i class="fa fa-dashboard"></i> R&eacute;clamations RH<span></span>
                </a>
            </li>
     
		<li class="header">Gestion des missions</li>
                        
			<li class="treeview <?php if (Yii::$app->controller->id=='missions') echo 'active'?>" >
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Historique Missions</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
						<li>
                            <a href="index.php?r=missions/index">
                                <i class="fa fa-circle-o text-green"></i> <span>Missions en cours</span> 
                            </a>
                        </li>
						<li>
                            <a href="index.php?r=missions/encloture">
                                <i class="fa fa-circle-o text-yellow"></i> <span>Missions en Cloture...</span> 
                            </a>
                        </li>
						<li>
                            <a href="index.php?r=missions/termine">
                                <i class="fa fa-circle-o text-aqua"></i> <span>Missions Avec Rapport</span> 
                            </a>
                        </li>
						<li>
                            <a href="index.php?r=missions/cloture">
                                <i class="fa fa-circle-o text-bleu"></i> <span>Missions clotur&eacute;s</span> 
                            </a>
                        </li>
						<li>
                            <a href="index.php?r=missions/annule">
                                <i class="fa fa-circle-o text-red"></i> <span>Missions Annul&eacute;es</span> 
                            </a>
                        </li>
						<li>
                            <a href="index.php?r=missions/notification">
                                <i class="fa fa-edit"></i> <span>Notifications</span>
                            </a>
                        </li>
						</ul>
					</li>
                     <li class="header">Param&eacute;trage</li> 
						 <?php if (Yii::$app->user->identity->isAdmin==1) {?>
                       <li>
                            <a href="index.php?r=users">
                                <i class="fa fa-circle-o text-red"></i> <span>Utilisateurs</span>
                            </a>
                       </li>
					   <li>
                            <a href="index.php?r=recrutement">
                                <i class="fa fa-paw text-blue"></i> <span>Annonces Recrutement</span>
                            </a>
                       </li>
						 <?php }
						 if ((Yii::$app->user->identity->id=='201649')||(Yii::$app->user->identity->id=='202099')) {
						 ?>
						  <li>
                            <a href="index.php?r=events">
                                <i class="fa fa-paw text-blue"></i> <span>Evenements</span>
                            </a>
                       		</li>
						 
						 <?php }if ((Yii::$app->user->identity->isAdmin==1)||(Yii::$app->user->identity->type=='RH')||(Yii::$app->user->identity->type=='DG')) {?>
					   <li >
                            <a href="index.php?r=employe">
                                <i class="fa fa-users"></i>
                                <span>Gestion des Employ&eacute;s</span>
                            </a>
                        </li>
						<?php } ?>
		
	  
	  
	  </ul>
	 

                       
                    
        

        
    </section>

</aside>
