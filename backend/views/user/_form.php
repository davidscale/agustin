<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
    .help-block {
        color: #F44336 !important;
    }
</style>


<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group mb-3">
        <?= $form->field($model, 'username')->input('name') ?>
    </div>

    <div class="form-group mb-3">
        <?= $form->field($model, 'email')->input('email') ?>
    </div>

    <?php if (!$toUpdate) { ?>
        <div class="form-group mb-3">
            <?= $form->field($model, 'password_hash')->passwordInput()->label('Password') ?>
        </div>
    <?php } ?>

    <div class="form-group mb-3">
        <?= $form->field($model, 'status')->dropDownList([10 => 'Active', 9 => 'Inactive']/* , ['prompt' => 'Seleccione Uno'] */) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>