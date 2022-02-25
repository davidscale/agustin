<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>

<style type="text/css">
    .translate {
        top: 90vh;
        right: 1vw !important;
    }
</style>

<div class="site-login d-flex flex-column justify-content-center min-vh-100">
    <div class="offset-lg-3 col-lg-6 bg-color">

        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <img src="<?php echo Yii::$app->params['bg_url_img']; ?>" class="img-thumbnail img-fluid my-1" alt="img-log">

        <h3 class="text-center mb-2"><?php echo Yii::$app->params['facultad']; ?></h3>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <div class="form-group">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => Yii::t('app', 'Email or Username'), 'value' => 'admin@admin.com'])->label(false) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true, 'placeholder' => Yii::t('app', 'Password'), 'value' => 'Dev_2021'])->label(false) ?>
        </div>

        <div class="my-2 d-flex flex-row justify-content-end">
            <?= Html::a(Yii::t('app', 'Forgot your password?'), ['site/request-password-reset']) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Log'), ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <div class="position-absolute translate">
        <select class="form-control" onchange="changeLang(this.value)">
            <option value="es"><?php echo Yii::t('app', 'Espanish') ?></option>
            <option value="en"><?php echo Yii::t('app', 'English') ?></option>
        </select>
    </div>

</div>
<script type="text/javascript">
    function changeLang(lang) {
        $.ajax({
            url: '<?= Yii::$app->request->baseUrl ?>/site/changelanguage',
            type: "POST",
            data: {
                lang: lang
            },
            success: function(result) {
                // location.reload();
            },
        });
    }
</script>