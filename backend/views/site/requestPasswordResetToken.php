<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\PasswordResetRequestForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-request-password-reset">
    <div class="my-2 mx-auto p-1 offset-lg-3 col-lg-6">

        <img src="https://www.unlz.edu.ar/wp-content/uploads/2019/09/rectorado.jpg" class="img-thumbnail img-fluid" alt="img-log">
        
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'reset-form']); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Send', ['class' => 'btn btn-primary btn-block', 'name' => 'send-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>