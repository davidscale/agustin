<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \commond\models\ReportForm */

use app\models\SgaActa;
use app\models\SgaAniosAcademico;
use app\models\SgaPropuesta;
use app\models\SgaUbicacion;

use yii\helpers\ArrayHelper;

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Search Report';

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

        <div class="col">
            <?= $form
                ->field($model, 'report_name')->dropDownList($model->reports_name, [
                    'id' => 'report_name',
                    'onchange' => 'showInputsByForm(this.value)'
                ]); ?>
        </div>

        <div class="col forms first-form second-form">
            <?= $form->field($model, 'anio')
                ->dropDownList(
                    $anios,
                    [
                        'prompt' => 'Seleccione Año Académico',
                        // 'required' => true,
                        'onchange' => 'getPeriodos(this.value,"' . Yii::$app->request->baseUrl . '")'
                    ]
                ); ?>
        </div>

        <div class="col forms first-form">
            <?= $form->field($model, 'propuesta')->dropDownList($propuestas, ['prompt' => 'Seleccione Propuesta']); ?>
        </div>

        <div class="col forms first-form">
            <?= $form->field($model, 'ubicacion')->dropDownList($ubicaciones); ?>
        </div>

        <div class="col forms first-form second-form">
            <?= $form->field($model, 'periodo')
                ->dropDownList(
                    [],
                    [
                        'prompt' => 'Seleccione Período',
                        'id' => 'dropDownList_periodo',
                    ]
                ); ?>
        </div>
        
        <div class="form-group my-2 d-flex justify-content-around">
            <?= Html::submitButton('View', ['class' => 'btn btn-primary', 'name' => 'btn-view', 'onClick' => 'showSpinner()']) ?>
            <?= Html::submitButton('Excel', ['class' => 'btn btn-success', 'name' => 'btn-excel', 'onClick' => 'changeAction()']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div id="spinner" class="d-flex align-items-center" style="display: none !important;">
        <strong>Cargando...</strong>
        <div class="spinner-border ml-auto" role="status" aria-hidden="true" style="width: 2rem; height: 2rem;"></div>
    </div>

</div>

<script type="text/javascript">
    function showInputsByForm(num) {
        if (!num) {
            return;
        }

        let form = $('.forms');
        form.css("display", "none");

        switch (num) {
            case "0":
                form = $('.first-form');
                form.css("display", "inherit")
                break;

            case "1":
                form = $('.second-form');
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
        // TODO:: sometimes have problems.. (check in incognit)
        document.getElementById("report-form").action = '';
        document.getElementById("report-form").action = 'report/generate';

        showSpinner();
    }

    function showSpinner() {

        form = $('#spinner');
        form.css("display", "inherit");

        setTimeout(function() {
            form.css("display", "none");
        }, 3000);

    }
</script>