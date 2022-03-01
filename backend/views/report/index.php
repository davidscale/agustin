<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \commond\models\ReportForm */

use app\models\SgaAniosAcademico;
use app\models\SgaPropuesta;
use app\models\SgaUbicacion;

use yii\helpers\ArrayHelper;

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = Yii::t('app', 'Search Report');

$this->params['breadcrumbs'][] = $this->title;

$propuestas = ArrayHelper::map(
    SgaPropuesta::find()
        ->where(['estado' => 'A'])
        ->all(),
    'propuesta',
    'nombre_abreviado'
);

$anios = ArrayHelper::map(
    SgaAniosAcademico::find()
        ->orderBy(['anio_academico' => SORT_DESC])
        ->all(),
    'anio_academico',
    'anio_academico'
);

$ubicaciones = ArrayHelper::map(
    SgaUbicacion::find()
        ->all(),
    'ubicacion',
    'nombre'
);

?>

<style type="text/css">
    @media (max-width: 769px) {
        .col {
            flex-basis: unset;
        }
    }
</style>

<div class="site-report d-flex flex-column justify-content-top">

    <div class="offset-lg-3 col-lg-6 bg-color">

        <h1 class="text-center mb-4"><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'report-form']); ?>

        <div class="d-flex">
            <div class="col w-50">
                <?= $form
                    ->field($model, 'report_name')->dropDownList($model->reports_name, [
                        'id' => 'report_name',
                        'onchange' => 'showInputsByForm(this.value)'
                    ]); ?>
            </div>

            <div class="col forms form-0 form-1 form-2 w-50">
                <?= $form->field($model, 'anio')
                    ->dropDownList(
                        $anios,
                        [
                            'prompt' => Yii::t('app', 'Select Academic Year'),
                            // 'required' => true,
                            'onchange' => 'getPeriodos(this.value,"' . Yii::$app->request->baseUrl . '")'
                        ]
                    ); ?>
            </div>
        </div>

        <div class="d-flex">
            <div class="col forms form-0 w-50">
                <?= $form->field($model, 'propuesta')->dropDownList($propuestas, ['prompt' => Yii::t('app', 'Select Proposal')]); ?>
            </div>

            <div class="col forms form-0 form-2 w-50">
                <?= $form->field($model, 'ubicacion')->dropDownList($ubicaciones); ?>
            </div>
        </div>

        <div class="d-flex w-50">
            <div class="col forms form-0 form-1 form-2 w-50">
                <?= $form->field($model, 'periodo')
                    ->dropDownList(
                        [],
                        [
                            'prompt' => Yii::t('app', 'Select Period'),
                            'id' => 'dropDownList_periodo',
                        ]
                    ); ?>
            </div>
        </div>

        <div class="form-group my-2 d-flex justify-content-around">
            <?= Html::submitButton(Yii::t('app', 'Preview'), ['class' => 'btn btn-primary', 'name' => 'btn-view', 'onClick' => 'showSpinner()']) ?>
            <?= Html::submitButton(Yii::t('app', 'Download'), ['class' => 'btn btn-success', 'name' => 'btn-excel', 'onClick' => 'changeAction()']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div id="spinner" class="d-flex align-items-center bg-color mt-2" style="display: none !important;">
        <strong><?= Yii::t('app', 'Loading') ?> ...</strong>
        <div class="spinner-border ml-auto mt-2" role="status" aria-hidden="true" style="width: 2rem; height: 2rem;"></div>
    </div>

</div>

<script type="text/javascript">
    function showInputsByForm(num) {
        if (!num) {
            num = 0;
        }

        let form = $('.forms');
        form.css("display", "none");

        switch (num) {
            case "0":
                form = $('.form-0');
                form.css("display", "inherit")
                break;

            case "1":
                form = $('.form-1');
                form.css("display", "inherit")
                break;

            case "2":
                form = $('.form-2');
                form.css("display", "inherit")
                break;
        }
    }

    function getPeriodos(year, url) {
        $.ajax({
            url: url + '/report/periodo',
            type: 'POST',
            data: {
                year: year
            },
            success: function(res) {
                $('#dropDownList_periodo').html(res);
            },
            error: function() {
                console.log("Error");
            }
        })
    }

    function getComisiones(comision, url) {
        $.ajax({
            url: url + '/report/comision',
            type: 'POST',
            data: {
                comision: comision
            },
            success: function(res) {
                $('#dropDownList_comision').html(res);
            },
            error: function() {
                console.log("Error");
            }
        })
    }

    function changeAction() {
        document.getElementById("report-form").action = 'report/generate';

        showSpinner();
        setTimeout("hideSpinner()", 3000); // after 3 secs
    }

    function showSpinner() {
        form = $('#spinner');
        form.css("display", "inherit");
    }

    function hideSpinner() {
        document.getElementById("spinner").style.visibility = "hidden";
    }
</script>