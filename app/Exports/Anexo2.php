<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class Anexo2
{
    private $query;

    public function __construct( $query ) {
        $this->query = $query;
    }

    public function __invoke( $event )
    {
        $sheet = $event->sheet;
        $sheet->getDefaultRowDimension()->setRowHeight(15);

        $sheet->getParent()->getDefaultStyle()->applyFromArray([
            'font' => [
                'name' => 'Calibri',
                'size' => 11
            ]
        ]);

        $sheet->setCellValue('A1', 'Postulantes al proceso de seleccion verificadores Ad HOC')->getStyle('A1')->getFont()->setSize(14)->setBold(true);
        $sheet->mergeCells("A1:AH1");
        $sheet->getStyle("A1:AH1")->getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);

        //2
        $sheet->setCellValue('A2', 'Postulante' )->getStyle('A2')->getFont()->setSize(12)->setBold(true);
        $sheet->mergeCells("A2:G2");
        $sheet->getStyle("A2:G2")->getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);

        $sheet->setCellValue('H2', 'Formacion' )->getStyle('H2')->getFont()->setSize(12)->setBold(true);
        $sheet->mergeCells("H2:L2");
        $sheet->getStyle("H2:L2")->getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);

        $sheet->setCellValue('M2', 'Capacitacion' )->getStyle('M2')->getFont()->setSize(12)->setBold(true);
        $sheet->mergeCells("M2:S2");
        $sheet->getStyle("M2:S2")->getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);

        $sheet->setCellValue('T2', 'Experiencias Generales' )->getStyle('T2')->getFont()->setSize(12)->setBold(true);
        $sheet->mergeCells("T2:X2");
        $sheet->getStyle("T2:X2")->getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);

        $sheet->setCellValue('Y2', 'Experiencias Inspectores' )->getStyle('Y2')->getFont()->setSize(12)->setBold(true);
        $sheet->mergeCells("Y2:AA2");
        $sheet->getStyle("Y2:AA2")->getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);

        $sheet->setCellValue('AB2', 'Verificaciones Realizadas' )->getStyle('AB2')->getFont()->setSize(12)->setBold(true);
        $sheet->mergeCells("AB2:AE2");
        $sheet->getStyle("AB2:AE2")->getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);

        $sheet->setCellValue('AF2', 'Calificaciones' )->getStyle('AF2')->getFont()->setSize(12)->setBold(true);
        $sheet->mergeCells("AF2:AH2");
        $sheet->getStyle("AF2:AH2")->getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);

        //3 
        /*
        foreach ($this->headings() as $key => $nombreHead) {
            $sheet->setCellValue($key.'3', $nombreHead );
            $sheet->getColumnDimension($key)->setAutoSize(true);
        }*/

        $fila = 3;//desde la fila 4 empiezan los valores

        $n=1;
        $query = $this->getQuery();
        $count = count($query)+3;
        $event->sheet->getStyle('I4:I'.$count)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD);
        $event->sheet->getStyle('N4:N'.$count)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD);
        $event->sheet->getStyle('O4:O'.$count)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD);
        $event->sheet->getStyle('U4:U'.$count)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD);
        $event->sheet->getStyle('V4:V'.$count)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD);
        $event->sheet->getStyle('Y4:Y'.$count)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD);
        $event->sheet->getStyle('Z4:Z'.$count)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD);
        $event->sheet->getStyle('AC4:AC'.$count)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD);
        $event->sheet->getStyle('AF4:AF'.$count)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD);

        foreach( $query as $row){

            foreach($row as $key => $col){
                if($this->getLetraDeColumna($key))
                {
                    $sheet->setCellValue($this->getLetraDeColumna($key).$fila, $col);
                }
            }
            $sheet->setCellValue('A'.$fila, $n);
            $fila++;
            $n++;
        }
    }
    public function getQuery () {
        return $this->query;
    }

    public function getLetraDeColumna($index)
    {
        return array_search( $index, $this->headings() );
    }

    public function headings(): array
    {
        return [
            'A' => 'N',
            'B' => 'ape_paterno',
            'C' => 'ape_materno',
            'D' => 'nombres',
            'E' => 'colegio_profesional',
            'F' => 'numero_colegiatura',
            'G' => 'departamento_postulacion',
            //formacion
            'H' => 'especialidad',
            'I' => 'fecha_expedicion',
            'J' => 'f_ciudad',
            'K' => 'f_grado',
            'L' => 'f_institucion',
            //capacitacion
            'M' => 'capacitacion',
            'N' => 'c_fecha_inicio',
            'O' => 'c_fecha_termino',
            'P' => 'horas_lectivas',
            'Q' => 'c_ciudad',
            'R' => 'c_tipo',
            'S' => 'c_institucion',
            //experiencias_generales
            'T' => 'cargo',
            'U' => 'e_fecha_inicio',
            'V' => 'e_fecha_fin',
            'W' => 'tiempo_total',
            'X' => 'e_institucion',
            //experiencias_inspectores
            'Y' => 'i_fecha_inicio',
            'Z' => 'i_fecha_fin',
            'AA' => 'i_institucion',
            //verificacion_realizadas
            'AB' => 'nro_expediente',
            'AC' => 'v_fecha',
            'AD' => 'nro_informe',
            'AE' => 'v_institucion',
            //calificaciones
            'AF' => 'c_fecha',
            'AG' => 'sedes_registrales',
            'AH' => 'convocatoria',
        ];
    }
}