<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \commond\models\SignupForm */

// DELEEEEEETE THIS FILE
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Register';

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Home'), 'url' => '/'];
$this->params['breadcrumbs'][] = $this->title;

?>

<style>
    @media (max-width: 769px) {
        .col {
            flex-basis: unset;
        }
    }
</style>

<div class="site-signup d-flex flex-column justify-content-center min-vh-100">
    <div class="offset-lg-3 col-lg-6">

        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <img src="<?php echo $pic; ?>" class="img-thumbnail img-fluid my-1" alt="img-log">

        <h3 class="text-center mt-1"><?php echo $ubication; ?></h3>

        <?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>

        <div class="row">
            <div class="col">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            </div>

            <div class="col">
                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>

            <div class="col">
                <?= $form->field($model, 're_password')->passwordInput() ?>
            </div>
        </div>

        <div class="my-2">
            <a href="/agustin/site/login">Do you have an account?</a>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary btn-block', 'name' => 'signup-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>