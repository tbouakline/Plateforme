<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<section id="inner-headline">
      <div class="container">
        <div class="row">
          <div class="span4">
            <div class="inner-heading">
              <h2>Nous contacter</h2>
            </div>
          </div>
          <div class="span8">
            <ul class="breadcrumb">
              <li><a href="index.php"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
              <li class="active">Contact</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
<section id="content">

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3196.5141592994632!2d3.2271747147106344!3d36.75823117776179!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128e4f46cf1c63e3%3A0x15f57bf2f93be1b3!2sSTARKELEC%20INDUSTRIES!5e0!3m2!1sfr!2sdz!4v1567885087180!5m2!1sfr!2sdz" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen=""></iframe>


<section id="content">
      <div class="container">
        <div class="row">
          <div class="span12">
            <h2 class="aligncenter"> Prendre <strong>Contact</strong></h2>
          </div>
        </div>
<div class="row">

<div class="span6">
                <div class="wrapper">
                  <div class="testimonial">
                    
                      <div class="author">
                      <img src="img/dummies/testimonial-author1.png" class="img-circle bordered" alt="">
                      <p class="name">
                      <span class="font-icon-email"></span>
                        Prendre contact:
                      </p>
                      <span class="info">Nous envoyer un mail <a href="mailto:contact@starkelec-industries.com"> contact@starkelec-industries.com  </a></span>
                    </div>
                </div>
                </div>
  </div>    
  <div class="span6"> 
           <div class="wrapper">
                  <div class="testimonial">
                    
                    <div class="author">
                      <img src="img/dummies/testimonial-author1.png" class="img-circle bordered" alt="">
                      <p class="name">
                      <span class="font-icon-question-sign"></span>
                        Pour plus d'informations:
                      </p>
                      <span class="info">Nous envoyer un mail <a href="mailto:info@starkelec-industries.com"> info@starkelec-industries.com  </a></span>
                    </div>
                      </div>
                </div>

</div>
</div>
<div class="row">
  <div class="span6">
                 <div class="wrapper">
                  <div class="testimonial">
                    
                    <div class="author">
                      <img src="img/dummies/testimonial-author1.png" class="img-circle bordered" alt="">
                      <p class="name">
                      <span class="font-icon-barcode"></span>
                        Service commercial:
                      </p>
                      <span class="info">Nous envoyer un mail <a href="mailto:commercial@starkelec-industries.com"> commercial@starkelec-industries.com  </a></span>
                    </div>
              </div>
                </div>
  </div>
<div class="span6">

                    <div class="wrapper">
                  <div class="testimonial">
                    
                    <div class="author">
                      <img src="img/dummies/testimonial-author1.png" class="img-circle bordered" alt="">
                      <p class="name">
                      <span class="font-icon-calendar"></span>
                        Secrétariat :
                      </p>
                      <span class="info">Nous envoyer un mail <a href="mailto:secrétariat@starkelec-industries.com">  secrétariat@starkelec-industries.com</a></span>
                    </div>
                  
                  </div>
                </div>
  </div>


</div>
             




            
        </div>




    </section>
    <!--  
      <div class="container">
        <div class="row">
          <div class="span12">
            <h4>Si vous avez des questions, vous pouvez nous contacter  <strong> par ce formulaire</strong></h4>
              <?php if(Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissable" role="alert">
        <i class="fa fa-check"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
<?php if(Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger" role="alert">
        <i class="fa fa-warning"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
              <div id="sendmessage">Your message has been sent. Thank you!</div>
              <div id="errormessage"></div>

              <div class="row">
                <div class="span4 form-group">
                  <?= $form->field($model, 'name')->textInput(['autofocus' => true ,'maxlength' => 200, 'class' => 'span4 form-group']) ?>
                </div>
              </div>
              <div class="row">
                <div class="span4 form-group">
                   <?= $form->field($model, 'email')->textInput(['maxlength' => 200, 'class' => 'span4 form-group']) ?>
                </div>

              </div>
              <div class="row">
                <div class="span4 form-group">
               
                 <?= $form->field($model, 'subject')->textInput(['maxlength' => 200, 'class' => 'span4 form-group']) ?>
                </div>
                </div>
              <div class="row">
                <div class="span8 margintop10 form-group">
                     <?= $form->field($model, 'body')->textarea(['rows' => 6,'maxlength' => 1500, 'class' => 'span7 margintop10 form-group']) ?>
                </div> 
                </div>
              <div class="row">
                 <div class="span4 form-group">
                  <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="span4 form-group">{image}</div><div class="span4 form-group">{input}</div></div>',
                ]) ?>

                 </div>

            </div>
                  <div class="row">
                 
                   <div class="span4 form-group">  
                  
                     </div>
                
                 <div class="span4 form-group">
                    <?= Html::submitButton('Envoyer', ['class' => 'btn btn-large btn-theme margintop10', 'name' => 'contact-button']) ?>
                </div>
              </div>
            <?php ActiveForm::end(); ?>
          </div>
        </div>
      </div>
    </section>-->
   


