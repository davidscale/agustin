<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
    @media (max-width: 769px) {
        .col {
            flex-basis: unset;
        }
    }
</style>

<div class="user-form d-flex flex-column">
    <div class="offset-lg-3 col-lg-6">

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            </div>

            <div class="col">
                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            </div>
        </div>

        <?php if (!$toUpdate) { ?>
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'password_hash')->passwordInput() ?>
                </div>

                <div class="col">
                    <?= $form->field($model, 're_password')->passwordInput() ?>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col">
                <?= $form->field($model, 'status')->dropDownList($model->arr_status); ?>
            </div>
        </div>

        <div class="form-group text-center">
            <?= Html::submitButton(Yii::t('app', Yii::t('app', 'Save')), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>