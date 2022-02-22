<?php

namespace backend\controllers;

use app\models\SgaActa;
use app\models\SgaComision;
use app\models\SgaPeriodo;

use backend\models\ReportForm;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

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
                        'actions' => [
                            'view',
                            'index',
                            'periodo',
                            'comision',
                            'acta',
                            'generate'
                        ],
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
            'model' => new ReportForm()
        ]);
    }

    /**
     * Renders a view and applies layout if available
     * @param ReportForm $model
     */
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

    public function actionGenerate()
    {
        $model = new ReportForm();
        if ($model->load(Yii::$app->request->post()) && $model->generate()) {

            $model->generateExcel();

            Yii::$app->session->setFlash(
                'success',
                'Excel generado con éxito'
            );
        } else {
            Yii::$app->session->setFlash(
                'error',
                'Error al momento de generar excel'
            );
        }
        return $this->actionIndex();
    }

    public function actionPeriodo()
    {
        if ($_POST['year']) {
            $data = SgaPeriodo::find()
                ->where(['anio_academico' => $_POST['year']])
                ->all();

            $rta = '<option value="">Seleccione Período</option>';
            foreach ($data as $p) {
                $rta .= '<option value="' . $p->periodo . '"> ' . utf8_encode($p->nombre) . '</option>';
            }

            echo $rta;
        }
    }

    public function actionComision()
    {
        if ($_POST['comision']) {
            $data = SgaComision::find()
                ->where(['periodo_lectivo' => $_POST['comision']])
                ->all();

            $rta = '<option value="">Seleccione Comision</option>';
            foreach ($data as $p) {
                $rta .= '<option value="' . $p->comision . '"> ' . utf8_encode($p->nombre) . '</option>';
            }

            echo $rta;
        }
    }

    public function actionActa()
    {
        if ($_POST['comision']) {
            $data = SgaActa::find()
                ->where([
                    'comision' => $_POST['comision'],
                    'origen' => 'P'
                ])
                ->all();

            $rta = '<option value="">Seleccione Acta</option>';
            foreach ($data as $p) {
                $rta .= '<option value="' . $p->nro_acta . '"> ' . utf8_encode($p->nro_acta) . '</option>';
            }

            echo $rta;
        }
    }
}
