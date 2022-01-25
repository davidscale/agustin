<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login d-flex flex-column justify-content-center min-vh-100">
    <div class="offset-lg-3 col-lg-6">

        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <img src="<?php echo $pic; ?>" class="img-thumbnail img-fluid my-1" alt="img-log">

        <h3 class="text-center m-0"><?php echo $ubication; ?></h3>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>


        <div class="form-group">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>

        <div class="my-2 d-flex flex-row justify-content-between">
            <?= Html::a('Forgot your password?', ['site/request-password-reset']) ?>
            <?= Html::a("Don't have an account?", ['site/signup']) ?>
        </div>
        
        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>