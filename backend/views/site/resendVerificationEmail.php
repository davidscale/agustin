<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Resend verification email';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-resend-verification-email">
    <div class="my-2 mx-auto p-1 offset-lg-3 col-lg-6">

        <img src="https://www.unlz.edu.ar/wp-content/uploads/2019/09/rectorado.jpg" class="img-thumbnail img-fluid" alt="img-log">
        
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>

        <div class="form-group">
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Send', ['class' => 'btn btn-primary btn-block', 'name' => 'resend-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>