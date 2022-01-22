<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;

class ReportController extends Controller
{
    /**
     * Renders a view and applies layout if available
     */
    public function actionIndex()
    {
        if (isset($_POST) && $_POST) {
            $report = $this->getData($_POST['kynd_report']);
            return $this->render(
                'view',
                array(
                    'report' => $report,
                    'kynd_report' => $_POST['kynd_report']
                )
            );
        }

        return $this->render('index');
    }

    /**
     * Get data from BD (guarani) by report input selected
     */
    private function getData($kynd)
    {
        $data = json_decode('');
        $query = "select 
        --per.apellido,
        --per.nombres,
        pd.nro_documento,
        --co.nombre as comision,
        ma.codigo as materia,
        --ma.codigo,
        ad.cond_regularidad,
        case
        when (ad.resultado = 'A') then 'P'
        when (ad.resultado = 'R') then 'N'
        when (ad.resultado = 'U') then 'U'
        end as resultado,
        case 
        when (ad.nota = 'Ausente') then ''
        else ad.nota
        end as nota,
        to_char(ad.fecha, 'DD/MM/YYYY') as fecha,
        libro.nro_libro,
        acta.nro_acta,
        ad.folio,
        ad.renglon,
        acta.renglones_folio
        --acta.origen
        from sga_comisiones as co
        join sga_elementos as ma on co.elemento = ma.elemento
        join sga_actas as acta on co.comision = acta.comision
        left join sga_actas_detalle as ad on acta.id_acta = ad.id_acta
        join sga_actas_folios as af on acta.id_acta = af.id_acta and af.folio = ad.folio
        join sga_libros_tomos as lt on af.libro_tomo = lt.libro_tomo
        join sga_libros_actas as libro on lt.libro = libro.libro
        left join sga_cond_regularidad as cr on ad.cond_regularidad = cr.cond_regularidad
        left join sga_escalas_notas_resultado as enr on ad.resultado = enr.resultado
        join sga_alumnos as alu on ad.alumno = alu.alumno
        join mdp_personas as per on alu.persona = per.persona
        join mdp_personas_documentos as pd on alu.persona = pd.persona
        where co.periodo_lectivo = 189 and co.ubicacion = 1 and acta.origen = 'P'
        order by 1,3";

        switch ($kynd) {
            case 'first':
                $data = Yii::$app->db_guarani->createCommand($query)->queryAll();
                $data = json_decode(json_encode($data), FALSE);
                break;

            case 'second':
                $data = Yii::$app->db_guarani->createCommand($query)->queryAll();
                $data = json_decode(json_encode($data), FALSE);
                break;

            default:
                break;
        }
        return $data;
    }
}
