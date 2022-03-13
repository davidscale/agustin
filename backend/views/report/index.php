<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \commond\models\ReportForm */

use app\models\SgaAniosAcademico;
use app\models\SgaPropuesta;
use app\models\SgaUbicacion;
use backend\models\SgaElemento;
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
    /* @media (min-width: 769px) {
        #report-form {
            display: flex;
            flex-wrap: wrap;
        }
    } */
</style>

<div class="site-report">

    <div class="offset-lg-3 col-lg-6 bg-color text-center px-1 py-2">

        <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin([
            'id' => 'report-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-4',
                    'offset' => 'offset-sm-4',
                    'wrapper' => 'col-sm-8',
                    'error' => '',
                    'hint' => '',
                ],
            ],
        ]); ?>

        <!-- <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"> -->
        <?= $form
            ->field($model, 'report_name')->dropDownList($model->reports_name, [
                'id' => 'report_name',
                'onchange' => 'showInputsByForm(this.value)'
            ]); ?>
        <!-- </div> -->

        <div class="forms form-0 form-1 form-2">
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

        <div class="forms form-0">
            <?= $form->field($model, 'propuesta')->dropDownList($propuestas, ['prompt' => Yii::t('app', 'Select Proposal')]); ?>
        </div>

        <div class="forms form-0 form-2">
            <?= $form->field($model, 'ubicacion')->dropDownList($ubicaciones); ?>
        </div>

        <div class="forms form-0 form-1 form-2">
            <?= $form->field($model, 'periodo')
                ->dropDownList(
                    [],
                    [
                        'prompt' => Yii::t('app', 'Select Period'),
                        'id' => 'dropDownList_periodo',
                        'onchange' => 'getElementos(this.value,"' . Yii::$app->request->baseUrl . '")'
                    ]
                ); ?>
        </div>

        <!-- Modal -->
        <div class="modal fade bs-example-modal-lg-add" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <div class="modal-header alert-warning">
                        <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('app', 'Select Subjects to Remove'); ?></h4>

                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body text-center">

                        <label id="lbl-no-element"><?php echo Yii::t('app', 'Please, first select a Period'); ?></label>

                        <?= $form
                            ->field($model, 'elements')
                            ->label(false)
                            ->inline()
                            ->checkboxList(
                                [],
                                ['id' => 'checkboxList_element']
                            ); ?>
                    </div>

                </div>

            </div>
        </div>
        <!-- /Modal -->

        <div class="form-group my-2 d-flex justify-content-around w-100">
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".bs-example-modal-lg-add">
                <?php echo Yii::t('app', 'Remove'); ?>
            </button>

            <?= Html::submitButton(Yii::t('app', 'Preview'), ['class' => 'btn btn-primary', 'name' => 'btn-view', 'onClick' => 'showSpinner()']) ?>
            <?= Html::submitButton(Yii::t('app', 'Download'), ['class' => 'btn btn-success', 'name' => 'btn-excel', 'onClick' => 'changeAction("' . Yii::$app->request->baseUrl . '")']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <div id="spinner" class="d-flex align-items-center bg-color mt-2" style="display: none !important;">
        <strong><?= Yii::t('app', 'Loading') ?> ...</strong>
        <div class="spinner-border ml-auto mt-2" role="status" aria-hidden="true" style="width: 2rem; height: 2rem;"></div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        showInputsByForm();
    });

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

    function getElementos(periodo, url) {
        $.ajax({
            url: url + '/report/elemento',
            type: 'POST',
            data: {
                periodo: periodo
            },
            success: function(res) {
                res = JSON.parse(res);
                html = '';
                count = 0;

                res.forEach(r => {
                    html += '<div class="custom-control custom-checkbox custom-control-inline">';
                    html += '<input type="checkbox" id="i' + count + '" class="custom-control-input" name="ReportForm[elements][]" value="' + r.codigo + '">';
                    html += '<label class="custom-control-label" for="i' + count + '"> ' + r.nombre + '</label>';
                    html += '</div>';
                    count++;
                });
                
                $('#lbl-no-element').hide();
                $('#checkboxList_element').html(html);
            },
            error: function() {
                console.log("Error");
            }
        })
    }

    function changeAction(url) {
        url += '/report/generate';
        document.getElementById("report-form").action = url;

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