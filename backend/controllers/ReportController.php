<?php

namespace backend\controllers;

use app\models\SgaPeriodo;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use backend\models\ReportForm;
use yii\helpers\ArrayHelper;

class ReportController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['view', 'index', 'periodo', 'generate'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Renders a view and applies layout if available
     */
    public function actionIndex()
    {
        $model = new ReportForm();
        if ($model->load(Yii::$app->request->post())) {
            return $this->actionView($model);
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionView($model)
    {
        if ($data = $model->generate()) {

            Yii::$app->session->setFlash(
                'warning',
                'Nota: sólo se le muestran los primeros 10 (diez) resultados. Al generar Excel se le generará el resultado completo'
            );

            return $this->render('view', [
                'model' => $model,
                'data' => $data
            ]);
        }

        return $this->actionIndex();
    }

    public function actionGenerate(){

        $model = new ReportForm();
        if ($model->load(Yii::$app->request->post()) && $model->generateExcel()) {

            $model->generateExcel();

            Yii::$app->session->setFlash(
                'success',
                'Excel generado con éxito'
            );
        }
        return $this->actionIndex();
    }

    public function actionPeriodo()
    {
        if ($_POST['year']) {
            $periodos = SgaPeriodo::find()
                ->where(['anio_academico' => $_POST['year']])
                ->all();

            $myEcho = '<option value="">Seleccione Período</option>';
            foreach ($periodos as $p) {
                $myEcho .= '<option value="' . $p->periodo . '"> ' . utf8_encode($p->nombre) . '</option>';
            }

            echo $myEcho;
        }
    }
}
