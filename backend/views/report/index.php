<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Generate Report';

$csrf = \yii::$app->request->csrfParam;
$token = \yii::$app->request->csrfToken;

?>
<div class="report-view">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <div class="container text-center py-2 bg-secondary">
        <form id="form" action="report/index" method="POST">

            <?php echo Html::hiddenInput($csrf, $token); ?>
            <!-- No idea, but i need that.. -->

            <div class="container text-left">

                <div class="form-group mb-3">
                    <label>List of Reports</label>

                    <select required name="kynd_report" class="custom-select my-1 mr-sm-2 required">
                        <option value="">Choose one...</option>
                        <option value="first">First Example</option>
                        <option value="second">Second Example</option>
                    </select>
                </div>

            </div>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </form>
    </div>

</div>