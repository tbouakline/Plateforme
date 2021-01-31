<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>

<div class="page-holder w-100 d-flex flex-wrap">
<div class="container-fluid px-xl-5">
<div class="row">
    <section class="py-5">
        <div class="col-lg-3"> </div>
<div class="col-lg-6 mb-4">
                <div class="card">
                  <div class="card-header">
                    <h6 class="text-uppercase mb-0">Erreur</h6>
                  </div>
                  <div class="card-body">
                  <p>
                <?= nl2br(Html::encode($message)) ?>
            </p>

            <p>
                La page demand&eacute;e n'est pas accessible .
                merci de nous contacter  si vous pensez que c'est une erreur.
                 <a href='<?= Yii::$app->homeUrl ?>'>retour à Accueil</a>
                .
            </p>
                  </div>
                </div>
              </div>
              </section>
            </div>
            </div>
        
        </div>