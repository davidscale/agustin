<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Resend Verification';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-resend-verification-email d-flex flex-column justify-content-center min-vh-100">
    <div class="offset-lg-3 col-lg-6">

        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <img src="<?php echo Yii::$app->params['bg_url_img']; ?>" class="img-thumbnail img-fluid my-1" alt="img-log">

        <h3 class="text-center mb-2"><?php echo Yii::$app->params['facultad']; ?></h3>

        <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>

        <div class="form-group">
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
        </div>

        <div>
            <a href="/agustin/site/login">Go back?</a>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Send', ['class' => 'btn btn-primary btn-block', 'name' => 'resend-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>