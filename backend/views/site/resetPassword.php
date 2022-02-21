<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\ResetPasswordForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Reset Password';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-reset-password d-flex flex-column justify-content-center min-vh-100">
    <div class="offset-lg-3 col-lg-6">

        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <img src="<?php echo Yii::$app->params['bg_url_img']; ?>" class="img-thumbnail img-fluid my-1" alt="img-log">

        <h3 class="text-center mb-2"><?php echo Yii::$app->params['facultad']; ?></h3>

        <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

        <div class="form-group">
            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true, 'placeholder' => 'Password..'])->label(false) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 're_password')->passwordInput(['autofocus' => true, 'placeholder' => 'Repeat Password..'])->label(false) ?>
        </div>

        <div class="form-group">
        </div>

        <div class="my-2">
            <a href="/agustin/site/login">Go back?</a>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-block', 'name' => 'reset-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>