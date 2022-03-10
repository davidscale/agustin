<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = Yii::t('app', $name);
?>

<style>
    .h-100{
        height: 100vh !important;
    }
</style>

<div class="site-error h-100 p-2 d-flex flex-column justify-content-between">

    <div class="bg-color text-center">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="">
        <div class="alert alert-danger text-center">
            <?= nl2br(Html::encode($message)) ?>
        </div>

        <div class="bg-color">
            <p>
                <?php echo Yii::t('app', 'The above error occurred while the Web server was processing your request') ?>
            </p>

            <p>
                <?php echo Yii::t('app', 'Please contact to') ?>
                <b>matiasrue@gmail.com</b>
                <?php echo Yii::t('app', 'if you think this is a server error. Thank you') ?>
            </p>
        </div>
    </div>

</div>