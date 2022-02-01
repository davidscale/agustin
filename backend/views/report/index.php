<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \commond\models\ReportForm */

use app\models\SgaAniosAcademico;
use app\models\SgaPropuestas;
use app\models\SgaUbicacion;

use yii\helpers\ArrayHelper;

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Search Report';

$this->params['breadcrumbs'][] = $this->title;

$reports_name = ['first' => 'First Report', 'second' => 'Second Report'];

$propuestas = ArrayHelper::map(
    SgaPropuestas::find()
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

    .spinner-grow {
        left: 50%;
        top: 50%;

        display: none;
    }
</style>

<div class="site-report d-flex flex-column justify-content-top">
    <div class="offset-lg-3 col-lg-6">

        <h1 class="text-center mb-4"><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'report-form']); ?>

        <div class="spinner-grow text-success position-fixed" role="status">
            <span class="sr-only">Loading...</span>
        </div>

        <div class="row">
            <div class="col">
                <?= $form->field($model, 'report_name')->dropDownList($reports_name, ['prompt' => 'Seleccione Tipo']); ?>
            </div>

            <div class="col">
                <?= $form->field($model, 'propuesta')->dropDownList($propuestas, ['prompt' => 'Seleccione Propuesta']); ?>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <?= $form->field($model, 'anio')
                    ->dropDownList(
                        $anios,
                        [
                            'prompt' => 'Seleccione Año',
                            'onchange' => new \yii\web\JsExpression('getPeriodo(this.value,"' . Yii::$app->request->baseUrl . '")')
                        ]
                    ); ?>
            </div>

            <div class="col">
                <?= $form->field($model, 'ubicacion')->dropDownList($ubicaciones); ?>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <?= $form->field($model, 'periodo')
                    ->dropDownList(
                        [],
                        [
                            'prompt' => 'Seleccione Período',
                            'id' => 'dropDownList_periodo'
                        ]
                    ); ?>
            </div>

            <div class="col m-auto text-center form-group">
                <?= $form->field($model, 'more_info')->checkbox(['autofocus' => true]) ?>
            </div>
        </div>

        <div class="form-group my-2 d-flex justify-content-around">
            <?= Html::submitButton('Export', ['class' => 'btn btn-success', 'name' => 'export-button', 'onclick' => 'changeAction()']) ?>
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'name' => 'report-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<script type="text/javascript">
    function changeAction() {
        document.getElementById("report-form").action = 'generate';
    }

    function getPeriodo(year, url) {
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
</script>