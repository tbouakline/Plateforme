<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Secteur_economique;
use backend\models\Secteur;

use backend\models\Branche;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Entreprise */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $model1= new Secteur();
    $secteur = ArrayHelper::map(Secteur::find()->asArray()->all(), 'id_secteur', 'libelli');

?>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model1, 'id_secteur')->dropDownList(
     $secteur,
             ['prompt'=>'Select secteur',
              'onchange'=>'
                $.post( "index.php?r=entreprise/secteureco&id="+$(this).val(), function( data ) {
                  $( "select#id_secteur_eco" ).html( data );
                });'
            ])->label("Secteur"); ?>
    <?=$form->field($model, 'secteur_eco')->dropDownList(ArrayHelper::map(secteur_economique::find()->all(), 'id_secteur_eco', 'libelli'),['prompt'=>'','id'=>'id_secteur_eco']) ?>
    
    
    <?=$form->field($model, 'branche')->dropDownList(ArrayHelper::map(branche::find()->all(), 'branche','branche')) ?>
    
    <?= $form->field($model, 'taille')->dropDownList(['class'=>'custom-select'],[ 'Micro' => 'Micro', 'Très petite' => 'Très petite', 'Petite' => 'Petite', 'Moyenne' => 'Moyenne', 'Grande' => 'Grande', 'Groupe' => 'Groupe', 'Etendu' => 'Etendu', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'nom_entreprise')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'siege_social')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_admin')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


