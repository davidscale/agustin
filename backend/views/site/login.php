<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login">
    <div class="my-2 mx-auto p-1 offset-lg-3 col-lg-6">

        <img src="https://www.unlz.edu.ar/wp-content/uploads/2019/09/rectorado.jpg" class="img-thumbnail img-fluid" alt="img-log">

        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>


        <div class="form-group">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <div class="mt-2">
            <?= Html::a('Forgot your password?', ['site/request-password-reset']) ?>
            <br>
            <?= Html::a('Need verification email?', ['site/resend-verification-email']) ?>
            <br>
            <?= Html::a("Don't have an account?", ['site/signup']) ?>
        </div>
    </div>
</div>