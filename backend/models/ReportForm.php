<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\base\Model;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PHPOffice\PhpSpreadsheet\Style\Alignment;

require '../../vendor/autoload.php';

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
            ['more_info', 'required'],
        ];
    }

    /**
     * Valid if fields are OK and return report
     *
     * @return Report|null
     */
    public function generate()
    {
        if ($this->validate()) {

            $query = $this->getQuery();

            $data = (object) Yii::$app->db_guarani->createCommand($query)->queryAll();

            if ($data) {
                $this->_report = $data;
                return $this->_report;
            } else {
                $this->hasErrors('La búsqueda no encontró resultados');
            }
        }
        return null;
    }

    private function getQuery()
    {
        $rta = null;

        switch ($this->report_name) {
            case 'first':
                $rta = "SELECT 
                    per.apellido,
                    per.nombres,
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

                    WHERE co.periodo_lectivo = " . $this->periodo . "
                    AND co.ubicacion = " . $this->ubicacion . " AND acta.origen = 'P'
                    ORDER BY 1,3";
                break;

            case 'second':
                $rta = "SELECT 
                    per.apellido,
                    per.nombres,
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

                    WHERE co.periodo_lectivo = " . $this->periodo . "
                    AND co.ubicacion = " . $this->ubicacion . " AND acta.origen = 'P'
                    ORDER BY 1,3";
                break;
        }
        return $rta;
    }


    public function generateExcel(): void
    {
        // It will take unlimited memory usage of server, it's working fine.
        ini_set('memory_limit', '-1');

        if ($this->generate()) {

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $headerstyle = array(
                'font'  => array(
                    'bold'  => true,
                    'color' => array('rgb' => '000000'),
                    'size'  => 12,
                    'name'  => 'Verdana'
                ),
                'alignment' => array(
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                )
            );

            $company_name_style = array(
                'font'  => array(
                    'bold'  => true,
                    'color' => array('rgb' => '000000'),
                    'size'  => 10,
                    'name'  => 'Verdana'
                ),
                'alignment' => array(
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                )
            );

            $titlestyle = array(
                'font'  => array(
                    'bold'  => true,
                    'color' => array('rgb' => '000000'),
                    'size'  => 14,
                    'name'  => 'Verdana'
                ),
                'alignment' => array(
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                )
            );

            $titledatestyle = array(
                'font'  => array(
                    'bold'  => true,
                    'color' => array('rgb' => '000000'),
                    'size'  => 10,
                    'name'  => 'Verdana'
                ),
                'alignment' => array(
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                )
            );

            $titleborder = array(
                'borders' => array(
                    'allBorders' => array(
                        'borderStyle' => Border::BORDER_THIN, //BORDER_THIN BORDER_MEDIUM BORDER_HAIR
                        'color' => array('rgb' => '000000')
                    )
                )
            );

            $contentstyle = array(
                'alignment' => array(
                    'vertical' => Alignment::VERTICAL_TOP,
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                )
            );

            $counterdata = array(
                'font'  => array(
                    'bold'  => true,
                    'color' => array('rgb' => '000000'),
                    'size'  => 10,
                    'name'  => 'Verdana'
                ),
                'alignment' => array(
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                )
            );

            $min_word = 'A';
            $max_word = 'K';


            $sheet->mergeCells($min_word . '1:' . $max_word . '2');
            $sheet->mergeCells($min_word . '5:' . $max_word . '6');
            $sheet->mergeCells($min_word . '7:' . $max_word . '7');

            $sheet->setCellValue($min_word . '1', "KABUKLOD SA KAUNLARAN CREDIT, INC.");
            $sheet->setCellValue($min_word . '5', "REPORTE: " . strtoupper($this->report_name));
            $sheet->setCellValue($min_word . '7', date("d/m/Y H:i"));

            $sheet
                ->setCellValue($min_word . '9', 'Nro. Doc')
                ->setCellValue('B9', 'Cod. Materia')
                ->setCellValue('C9', 'Cond. Regularidad')
                ->setCellValue('D9', 'Resultado')
                ->setCellValue('E9', 'Nota')
                ->setCellValue('F9', 'Fecha')
                ->setCellValue('G9', 'Nro. Libro')
                ->setCellValue('H9', 'Nro. Acta')
                ->setCellValue('I9', 'Folio')
                ->setCellValue('J9', 'Renglón')
                ->setCellValue($max_word . '9', 'Renglones Folio');

            foreach (range($min_word, $max_word) as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }

            $counter = 10;
            foreach ($this->_report as $row) {
                $sheet
                    ->setCellValue($min_word . $counter, '' . $row['nro_documento'])
                    ->setCellValue('B' . $counter, '' . $row['materia'])
                    ->setCellValue('C' . $counter, '' . $row['cond_regularidad'])
                    ->setCellValue('D' . $counter, '' . $row['resultado'])
                    ->setCellValue('E' . $counter, '' . $row['nota'])
                    ->setCellValue('F' . $counter, '' . $row['fecha'])
                    ->setCellValue('G' . $counter, '' . $row['nro_libro'])
                    ->setCellValue('H' . $counter, '' . $row['nro_acta'])
                    ->setCellValue('I' . $counter, '' . $row['folio'])
                    ->setCellValue('J' . $counter, '' . $row['renglon'])
                    ->setCellValue($max_word . $counter, '' . $row['renglones_folio']);

                $counter++;
                if ($counter == 20) { break; }  /* TODO:: remove this */
            }

            $counter = $counter + 2;
            $sheet->mergeCells($min_word . $counter . ':' . $max_word . $counter);
            $sheet->setCellValue($min_word . $counter, '' . 'Total de Resultados: ' . ($counter - 12));

            $sheet->getColumnDimension($min_word)->setAutoSize(false);
            $sheet->getColumnDimension($max_word)->setAutoSize(true);

            $sheet->getStyle($min_word . '1')->applyFromArray($company_name_style);
            $sheet->getStyle($min_word . '9:' . $min_word . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
            $sheet->getStyle($min_word . '5')->applyFromArray($titlestyle);
            $sheet->getStyle($min_word . '7')->applyFromArray($titledatestyle);
            $sheet->getStyle($min_word . '5:' . $max_word . '7')->applyFromArray($titleborder);

            $sheet->getStyle('B5:' . $max_word . $sheet->getHighestRow())->applyFromArray($contentstyle);

            $sheet->getStyle($min_word . '9:' . $max_word . '9')->applyFromArray($headerstyle);
            $sheet->getStyle($min_word . '9:' . $max_word . '9')->getFont()->setBold(true);

            $sheet->getStyle($min_word . $counter)->applyFromArray($counterdata);

            $sheet->setShowGridLines(false);

            $spreadsheet->getActiveSheet()->setTitle('Reporte Guaraní');

            $spreadsheet->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $this->report_name . '.xlsx"');
            header('Cache-Control: max-age=0');
            header('Cache-Control: max-age=1');

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
            exit;
        }
    }
}
