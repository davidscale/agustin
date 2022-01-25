<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use kartik\grid\GridView;

class ReportController extends Controller
{
    /**
     * Renders a view and applies layout if available
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView()
    {
        if (isset($_POST) && $_POST) {

            if ($query = $this->getQueryByKynd($_POST['kynd_report'])) {
                $data = Yii::$app->db_guarani->createCommand($query)->queryAll();
                $data = json_decode(json_encode($data), FALSE);

                if (count($data) > 0) {
                    return $this->render(
                        'view',
                        array(
                            'data' => $data,
                            'kynd_report' => $_POST['kynd_report']
                        )
                    );
                } else {
                    // empty..
                }
            }
        }
        return $this->actionIndex();    // If something is wrong, back to form of reports
    }

    private function getQueryByKynd($kynd)
    {
        $query = NULL;
        switch ($kynd) {
            case 'first':
                $query = "SELECT 
                    --per.apellido,
                    --per.nombres,
                    pd.nro_documento,
                    co.nombre AS comision,
                    ma.codigo AS materia,
                    ad.cond_regularidad,
                    CASE
                        WHEN (ad.resultado = 'A') THEN 'P'
                        WHEN (ad.resultado = 'R') THEN 'N'
                        WHEN (ad.resultado = 'U') THEN 'U'
                        END AS resultado,
                    CASE 
                        WHEN (ad.nota = 'Ausente') THEN ''
                        ELSE ad.nota
                        END AS nota,
                    to_char(ad.fecha, 'DD/MM/YYYY') AS fecha,
                    libro.nro_libro,
                    acta.nro_acta,
                    ad.folio,
                    ad.renglon,
                    acta.renglones_folio,
                    acta.origen
                    FROM sga_comisiones AS co
                    JOIN sga_elementos AS ma ON co.elemento = ma.elemento
                    JOIN sga_actas AS acta ON co.comision = acta.comision
                    LEFT JOIN sga_actas_detalle AS ad ON acta.id_acta = ad.id_acta
                    JOIN sga_actas_folios AS af ON acta.id_acta = af.id_acta AND af.folio = ad.folio
                    JOIN sga_libros_tomos AS lt ON af.libro_tomo = lt.libro_tomo
                    JOIN sga_libros_actas AS libro ON lt.libro = libro.libro
                    LEFT JOIN sga_cond_regularidad AS cr ON ad.cond_regularidad = cr.cond_regularidad
                    LEFT JOIN sga_escalas_notas_resultado AS enr ON ad.resultado = enr.resultado
                    JOIN sga_alumnos AS alu ON ad.alumno = alu.alumno
                    JOIN mdp_personas AS per ON alu.persona = per.persona
                    JOIN mdp_personas_documentos AS pd ON alu.persona = pd.persona
                    WHERE co.periodo_lectivo = 189 AND co.ubicacion = 1 AND acta.origen = 'P'
                    ORDER BY 1,3";
                break;

            case 'second':
                $query = "SELECT 
                    --per.apellido,
                    --per.nombres,
                    pd.nro_documento,
                    co.nombre AS comision,
                    ma.codigo AS materia,
                    ad.cond_regularidad,
                    CASE
                        WHEN (ad.resultado = 'A') THEN 'P'
                        WHEN (ad.resultado = 'R') THEN 'N'
                        WHEN (ad.resultado = 'U') THEN 'U'
                        END AS resultado,
                    CASE 
                        WHEN (ad.nota = 'Ausente') THEN ''
                        ELSE ad.nota
                        END AS nota,
                    to_char(ad.fecha, 'DD/MM/YYYY') AS fecha,
                    libro.nro_libro,
                    acta.nro_acta,
                    ad.folio,
                    ad.renglon,
                    acta.renglones_folio,
                    acta.origen
                    FROM sga_comisiones AS co
                    JOIN sga_elementos AS ma ON co.elemento = ma.elemento
                    JOIN sga_actas AS acta ON co.comision = acta.comision
                    LEFT JOIN sga_actas_detalle AS ad ON acta.id_acta = ad.id_acta
                    JOIN sga_actas_folios AS af ON acta.id_acta = af.id_acta AND af.folio = ad.folio
                    JOIN sga_libros_tomos AS lt ON af.libro_tomo = lt.libro_tomo
                    JOIN sga_libros_actas AS libro ON lt.libro = libro.libro
                    LEFT JOIN sga_cond_regularidad AS cr ON ad.cond_regularidad = cr.cond_regularidad
                    LEFT JOIN sga_escalas_notas_resultado AS enr ON ad.resultado = enr.resultado
                    JOIN sga_alumnos AS alu ON ad.alumno = alu.alumno
                    JOIN mdp_personas AS per ON alu.persona = per.persona
                    JOIN mdp_personas_documentos AS pd ON alu.persona = pd.persona
                    WHERE co.periodo_lectivo = 189 AND co.ubicacion = 1 AND acta.origen = 'P'
                    ORDER BY 1,3";
                break;

            default:
                break;
        }
        return $query;
    }

    public function actionExport()
    {
        if (isset($_POST) && $_POST) {

            if ($query = $this->getQueryByKynd($_POST['kynd_report'])) {
                $data = Yii::$app->db_guarani->createCommand($query)->queryAll();
                $data = json_decode(json_encode($data), FALSE);

                if (count($data) > 0) {
                    $this->generateExcel($data);
                } else {
                    // empty..
                }

                return $this->render(
                    'view',
                    array(
                        'data' => $data,
                        'kynd_report' => $_POST['kynd_report']
                    )
                );
            }
        }
        return $this->actionIndex();    // If something is wrong, back to form of reports
    }

    private function generateExcel($data)
    {
        // https://demos.krajee.com/grid-excel-export-demo/1

        var_dump("acá comenzará EXCEL");
        die();

        foreach ($data as $row) {
            // $row->nro_documento
            // $row->materia
            // $row->cond_regularidad
            // $row->resultado
            // $row->nota
            // $row->fecha
            // $row->nro_libro
            // $row->nro_acta
            // $row->folio
            // $row->renglon
            // $row->renglones_folio
            // $row->origen
        }
    }
}
