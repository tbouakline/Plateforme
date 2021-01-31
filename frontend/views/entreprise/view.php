<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\Wilaya;
use common\models\Commune;

use common\models\CategorieEntreprise;
use common\models\FormeJuridique;
use common\models\SecteurActivite;
use common\models\SousSecteurActivite;
use common\models\Activite;

/* @var $this yii\web\View */
/* @var $model frontend\models\Entreprise */

$this->title = $model->nom_rs;
$this->params['breadcrumbs'][] = ['label' => 'Entreprises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="entreprise-view w-100">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-edit"></i> Modifier', ['update', 'id' => $model->id_ent], ['class' => 'btn btn btn-primary shadow px-5']) ?>
    </p>

        <div class="card mb-3">
          <div class="card-header text-white bg-info">Utilisateur</div>
          <div class="card-body">
            
            <?= DetailView::widget([
                'model' => $user,
                'attributes' => [
                    'username',
                    'nom',
                    'prenom',
                    'date_naissance',
                    'lieu_naissance',
                    'tel',
                    'fax',
                    'email:email',
                    'poste',
                    [
                    'label'  => 'Statut',
                    'value'  => function ($data) {
                        switch($data->status)
                        {
                            case 0 :
                                $status="En attente de validation par Email";
                                break;
                            case 9 :
                                $status="En attente de validation par l'administrateur";
                                break;
                            case 10 :
                                $status="Validé";
                                break;
                            case 12 :
                                $status="Bloqué";
                                break;
                        } 

                        return $status;               
                      },
                    ],
                    [
                        'attribute' => 'Photo',
                        'value' => $user->photo,
                        'format' => ['image', ['width' => '100', 'height' => '100']]
                    ],
                ],
            ]) ?>

          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header text-white bg-info">Identité / Contact / Localisation</div>
          <div class="card-body">
            
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'nom_rs',
                    'adresse',
                    [
                    'label'  => 'Commune',
                    'value'  => function ($data) {
                        $commune=Commune::findOne($data->id_commune);
                        return (!empty($commune)?$commune->nom:'');                
                      },
                    ],
                    [
                    'label'  => 'Wilaya',
                    'value'  => function ($data) {
                        $wilaya=Wilaya::findOne($data->id_wilaya);
                        return (!empty($wilaya)?$wilaya->nom:'');                
                      },
                    ],
                    'tel',
                    'fax',
                    'email:email',
                    'longitude',
                    'latitude',
                ],
            ]) ?>

          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header text-white bg-info">Identifications</div>
          <div class="card-body">
            
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'num_rc',
                    'article_impo',
                    'code_nis',
                    'code_nif',
                ],
            ]) ?>

          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header text-white bg-info">Catégorie / Forme juridique / Activité</div>
          <div class="card-body">
            
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                    'label'  => 'Catégorie',
                    'value'  => function ($data) {
                        $categorie=CategorieEntreprise::findOne($data->id_categorie);
                        return (!empty($categorie)?$categorie->designation_courte:'');                
                      },
                    ],
                    [
                    'label'  => 'Forme juridique',
                    'value'  => function ($data) {
                        $forme=FormeJuridique::findOne($data->id_forme_juridique);
                        return (!empty($forme)?$forme->designation_courte:'');                
                      },
                    ],
                    [
                    'label'  => 'Secteur d\'activité',
                    'value'  => function ($data) {
                        $secteur=SecteurActivite::findOne($data->id_secteur);
                        return (!empty($secteur)?$secteur->designation:'');                
                      },
                    ],
                    [
                    'label'  => 'Sous secteur d\'activité',
                    'value'  => function ($data) {
                        $sous_secteur=SousSecteurActivite::findOne($data->id_sous_secteur);
                        return (!empty($sous_secteur)?$sous_secteur->designation:'');                
                      },
                    ],
                    [
                    'label'  => 'Activité',
                    'value'  => function ($data) {
                        $activite=Activite::findOne($data->id_activite);
                        return (!empty($activite)?$activite->designation:'');                
                      },
                    ],
                ],
            ]) ?>

          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header text-white bg-info">Autres</div>
          <div class="card-body">
            
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                    'label'  => 'Capital',
                    'value'  => function ($data) {
                        return number_format($data->capital,2,',',' ');                
                      },
                    ],
                    [
                    'label'  => 'Effectif',
                    'value'  => function ($data) {
                        return number_format($data->effectif,0,',',' ');                
                      },
                    ],                   
                    [
                    'label'  => 'ISO 9001',
                    'value'  => function ($data) {
                        return ($data->iso_9001==1)?'OUI':'NON';                
                      },
                    ],
                    [
                    'label'  => 'ISO 14001',
                    'value'  => function ($data) {
                        return ($data->iso_14001==1)?'OUI':'NON';                
                      },
                    ],
                    [
                    'label'  => 'ISO 2200',
                    'value'  => function ($data) {
                        return ($data->iso_2200==1)?'OUI':'NON';                
                      },
                    ],
                    [
                    'label'  => 'ISO OHSAS 18001',
                    'value'  => function ($data) {
                        return ($data->iso_ohsas_18001==1)?'OUI':'NON';                
                      },
                    ],
                    [
                        'attribute' => 'Logo',
                        'value' => $model->logo,
                        'format' => ['image', ['width' => '100', 'height' => '100']]
                    ],
                ],
            ]) ?>

          </div>
        </div>

</div>
