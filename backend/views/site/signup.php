<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \commond\models\SignupForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'SignupForm';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-signup">
    <div class="my-2 mx-auto p-1 offset-lg-3 col-lg-6">

        <img src="https://www.unlz.edu.ar/wp-content/uploads/2019/09/rectorado.jpg" class="img-thumbnail img-fluid" alt="img-log">

        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>

        <div class="form-group">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 're_password')->passwordInput() ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary btn-block', 'name' => 'signup-button']) ?>
        </div>

        <div>
            <a href="/agustin/site/login">Do you have an account?</a>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>