<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Reset Password';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-reset-password d-flex flex-column justify-content-center min-vh-100">
    <div class="offset-lg-3 col-lg-6">
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <img src="<?php echo $pic; ?>" class="img-thumbnail img-fluid my-1" alt="img-log">

        <h3 class="text-center mt-1"><?php echo $ubication; ?></h3>

        <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

        <div class="row">
            <div class="col">
                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
            </div>

            <div class="col">
                <?= $form->field($model, 're_password')->passwordInput(['autofocus' => true]) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-block', 'name' => 'reset-button']) ?>
        </div>

        <div>
            <a href="/agustin/site/login">Go back?</a>
        </div>
    </div>
</div>