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

class Cuadro4
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

        $sheet->setCellValue('A1', 'CUADRO DE MÉRITOS DE POSTULANTES A VERIFICADORES AD HOC DEL CENEPRED')->getStyle('A1')->getFont()->setSize(14)->setBold(true);
        $sheet->mergeCells("A1:K1");
        $sheet->getStyle("A1:K1")->getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);

        //2
        
        $sheet->setCellValue('A2', 'N°' )->getStyle('A2')->getFont()->setSize(12)->setBold(true);
        $sheet->setCellValue('B2', 'Apellidos P' )->getStyle('A2')->getFont()->setSize(12)->setBold(true);
        $sheet->setCellValue('C2', 'Apellidos M' )->getStyle('A2')->getFont()->setSize(12)->setBold(true);
        $sheet->setCellValue('D2', 'Nombres' )->getStyle('A2')->getFont()->setSize(12)->setBold(true);
        $sheet->setCellValue('E2', 'Profesión' )->getStyle('A2')->getFont()->setSize(12)->setBold(true);
        $sheet->setCellValue('F2', 'Colegio' )->getStyle('A2')->getFont()->setSize(12)->setBold(true);
        $sheet->setCellValue('G2', 'N° Colegiatura' )->getStyle('A2')->getFont()->setSize(12)->setBold(true);
        $sheet->setCellValue('H2', 'Puntaje' )->getStyle('A2')->getFont()->setSize(12)->setBold(true);
        $sheet->setCellValue('I2', 'Orden de Merito' )->getStyle('A2')->getFont()->setSize(12)->setBold(true);
        $sheet->setCellValue('J2', 'Sede Registral' )->getStyle('A2')->getFont()->setSize(12)->setBold(true);
        $sheet->setCellValue('K2', 'Fecha de Postulacion' )->getStyle('A2')->getFont()->setSize(12)->setBold(true);

        //3
        $fila = 3;

        $n=1;
        $query = $this->getQuery();
        $count = count($query)+2;
                
        foreach( $query as $row)
        {
            foreach($row as $key => $col)
            {
                if($this->getLetraDeColumna($key))
                {
                    $sheet->setCellValue($this->getLetraDeColumna($key).$fila, $col);
                }
            }
            $sheet->setCellValue('A'.$fila, $n);
            $sheet->setCellValue('I'.$count, $n);
            $fila++;
            $count--;
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
            'A' => 'N°',
            'B' => 'apellido_paterno',
            'C' => 'apellido_materno',
            'D' => 'nombres',
            'E' => 'profesion',
            'F' => 'colegio_profesional',
            'G' => 'numero_colegiatura',
            'H' => 'puntaje',
            //'I' => 'order_merito',
            'J' => 'sede_registral',
            'K' => 'fecha_postulacion',
        ];
    }
}