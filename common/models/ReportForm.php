<?php


/* TODO:: IN PROGRESSSSS */

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Report form
 */
class ReportForm extends Model
{
    public $report_name;
    public $propuesta;
    public $anio;
    public $ubicacion;
    public $periodo;
    public $more_info = false;

    private $_report;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['report_name', 'required', 'message' => 'Please choose a report.'],
            ['propuesta', 'required', 'message' => 'Please choose a propuesta.'],
            ['anio', 'required', 'message' => 'Please choose a year.'],
            ['ubicacion', 'required', 'message' => 'Please choose a ubication.'],
            ['periodo', 'required', 'message' => 'Please choose a período.'],
            ['more_info', 'required', 'message' => 'Please choose a username.'],
        ];
    }

    /**
     * Valid if fields are OK and return report
     *
     * @return Report|null
     */
    protected function generate()
    {
        if ($this->validate()) {
            return $this->getByName();
        }
        return null;
    }

    /**
     * Finds report by report selected
     *
     * @return Report|null
     */
    private function getByName()
    {
        if ($query = $this->getQuery()) {
            $data = Yii::$app->db_guarani->createCommand($query)->queryAll();
            $this->_report = json_decode(json_encode($data), FALSE);
        }
        return $this->_report;
    }

    private function getQuery()
    {
        $rta = null;

        switch ($this->report_name) {
            case 'first':
                $rta = "SELECT 
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
                $rta = "SELECT 
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
        }
        return $rta;
    }

    public static function getPropuestas()
    {
        $query = "SELECT * FROM sga_propuestas 
                  WHERE estado = 'A';";

        $data = Yii::$app->db_guarani->createCommand($query)->queryAll();
        // $r = json_decode(json_encode($data), FALSE);

        return $data;
    }
}