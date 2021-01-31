<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\CaracteristiqueProduit */
/* @var $form yii\widgets\ActiveForm */
?>

<script>
function show_hide_carac()
{
  ddlType= document.getElementById("caracteristiqueproduit-id_type");

  if(ddlType.options[ddlType.selectedIndex].text=="AUTRES")
  {
    document.getElementById("div_designation_type").style.display="block";
    document.getElementById("caracteristiqueproduit-designation").value="";
  }
  else
  {
    document.getElementById("div_designation_type").style.display="none";
    document.getElementById("caracteristiqueproduit-designation").value=ddlType.options[ddlType.selectedIndex].text;
  }
}
</script>

<div class="caracteristique-produit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
      echo $form->field($model, 'id_type')->widget(Select2::classname(), [
          'data' => $listeTypeCaracteristique,
          'language' => 'fr',
          'theme' => 'krajee',
          'options' => ['onchange'=>'js:show_hide_carac();','placeholder' => '','multiple' => false,  'allowClear' => true],
          'pluginOptions' => ['allowClear' => true],
      ]);      
    ?>

    <div id="div_designation_type" style="display:<?= ($type=='AUTRES')?'block':'none'; ?>">
      <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>
    </div>

    <?= $form->field($model, 'valeur')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-save"></i> Enregistrer',['class'=>'btn btn btn-primary shadow px-5']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
