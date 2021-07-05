<?php

namespace App\Exports;

use App\Presupuesto;
use App\TipoConcepto;
use App\Pago;
use App\EstadoPago;
use App\GastoDetail;
use DB;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



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

use Illuminate\Http\Request;
use App\Repositories\PresupuestoRepository;
use App\Repositories\ConceptoRepository;
//use App\Repositories\TipoPresupuestoRepository;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;

use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


//class PresupuestoExport implements FromCollection, WithStrictNullComparison, WithEvents
//class PresupuestoExport implements FromView, WithStrictNullComparison, WithEvents
class PostulantesAdhocExport implements FromArray, WithEvents, WithColumnFormatting
{
    use Exportable;//, RegistersEventListeners;

    private $presupuestos;
    private $conceptos;
    private $request;

    private $mes = [
        '1' => 'ENE',
        '2' => 'FEB',
        '3' => 'MAR',
        '4' => 'ABR',
        '5' => 'MAY',
        '6' => 'JUN',
        '7' => 'JUL',
        '8' => 'AGO',
        '9' => 'SET',
        '10' => 'OCT',
        '11' => 'NOV',
        '12' => 'DIC',
    ];

    private $columna = [
        '1' => 'C',
        '2' => 'D',
        '3' => 'E',
        '4' => 'F',
        '5' => 'G',
        '6' => 'H',
        '7' => 'I',
        '8' => 'J',
        '9' => 'K',
        '10' => 'L',
        '11' => 'M',
        '12' => 'N',
    ];

    public function __construct(
        Request $request
        /*PresupuestoRepository $presupuestos,
        ConceptoRepository $conceptos*/
        //TipoPresupuestoRepository $tipo_presupuesto

    )
    {
        $this->request = $request;
//        $this->presupuestos = $presupuestos;
 //       $this->conceptos = $conceptos;
        //$this->tipo_presupuesto = $tipo_presupuesto;
    }
    public function view(): View
    {

        return view('exports.analytics', [
            'data' => $this->collection->toArray()
        ]);
    }
    public function array(): array
    {
        return [];
    }
    public function collection()
    {
        return $this->presupuestos->allForExcel($this->request);
    }

    public function description()
    {
        return 'Analytics Report';
    }

    private function getNameFromNumber($num) {
        $numeric = ($num - 1) % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval(($num - 1) / 26);

        if ($num2 > 0) {
            return $this->getNameFromNumber($num2) . $letter;
        } else {
            return $letter;
        }
    }
    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_00,
            'D' => NumberFormat::FORMAT_NUMBER_00,
            'E' => NumberFormat::FORMAT_NUMBER_00,
            'F' => NumberFormat::FORMAT_NUMBER_00,
            'G' => NumberFormat::FORMAT_NUMBER_00,
            'H' => NumberFormat::FORMAT_NUMBER_00,
            'I' => NumberFormat::FORMAT_NUMBER_00,
            'J' => NumberFormat::FORMAT_NUMBER_00,
            'K' => NumberFormat::FORMAT_NUMBER_00,
            'L' => NumberFormat::FORMAT_NUMBER_00,
            'M' => NumberFormat::FORMAT_NUMBER_00,
            'N' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
    public function getMes($index)
    {
        return $this->mes[$index];
    }
    public function getColumnaMes($index)
    {
        return $this->columna[$index];
    }
    public function getMeses()
    {
        return $this->mes;
    }

    //public static function afterSheet(AfterSheet $event)
    public function registerEvents(): array
    {
        return [
            //AfterSheet::class => [self::class, 'afterSheet']
            //BeforeSheet::class => new PostulantesAdhoc(),
            AfterSheet::class => new PostulantesAdhoc(),
        ];
    }

    public static function afterSheet(AfterSheet $event) 
    {
       // return [
       //     AfterSheet::class => function(AfterSheet $event) {
                $request = $this->request;

                /*
                $monto = $totalConcepto = $totalRubro = $total = 0;
                $totalIngresos = $totalEgresos = $totalMes = [
                    '1' => 0,
                    '2' => 0,
                    '3' => 0,
                    '4' => 0,
                    '5' => 0,
                    '6' => 0,
                    '7' => 0,
                    '8' => 0,
                    '9' => 0,
                    '10' => 0,
                    '11' => 0,
                    '12' => 0,
                ];
                if (!isset($anio)) {
                    $anio = '2019';
                }
                $event->sheet->getStyle('C5:O100')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
                //$objPHPExcel->getActiveSheet()->getStyle('B4')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);

                $event->sheet->getDefaultRowDimension()->setRowHeight(15);
                $event->sheet->getDefaultColumnDimension()->setWidth(14);
                $event->sheet->getColumnDimension('B')->setWidth(50);
                $event->sheet->getParent()->getDefaultStyle()->applyFromArray([
                    'font' => [
                        'name' => 'Calibri',
                        'size' => 8
                    ]
                ]);
                $i = 1;
                $event->sheet->getStyle("A$i:O$i")->getFont()->setSize(11)->setBold(true);
                $event->sheet->setCellValue('A'.$i, 'COLEGIO MEDICO VETERINARIO')->getStyle('A'.$i)->getFont()->setBold(true);
                $i++;
                $event->sheet->getStyle("A$i:O$i")->getFont()->setSize(10)->setBold(true);
                $event->sheet->getStyle("A$i:O$i")->getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);
                $event->sheet->setCellValue('A'.$i, 'PRESUPUESTO ANUAL CMVP');
                $event->sheet->mergeCells("A$i:O$i");

                $i++;
                foreach ($this->getMeses() as $key => $mes) {
                    $event->sheet->setCellValue($this->getColumnaMes($key).$i, $this->getMes($key) );
                }

                $event->sheet->setCellValue('O'.$i, 'TOTAL');
                $i++;
                $event->sheet->setCellValue('A'.$i, 'INGRESOS')->getStyle('A'.$i)->getFont()->setBold(true);

                $i++;
                //Ingresos
                foreach ($this->conceptos->getIngresos() as $concepto) {
                    $event->sheet->setCellValue('A'.$i, $concepto->codigo);
                    $event->sheet->setCellValue('B'.$i, $concepto->name);
                    //recorrer meses
                    $totalConcepto = 0;
                    foreach ($this->getMeses() as $key => $mes) {
                        //recorrer ingresos en BD
                        $monto = Pago::where('concepto_id', $concepto->id)
                        ->where(DB::raw('MONTH(created_at)'), $key )
                        ->when($request->has('departamento_id'), function ($query) use ($request) {
                           return $query->where('departamento_id', $request->departamento_id );
                        })
                        ->when($request->has('anio'), function ($query) use ($request) {
                           return $query->where(DB::raw('YEAR(created_at)'), $request->anio );
                        })
                        ->where(function($query) {
                            $query->where('estado_pago_id', EstadoPago::COMPLETADA);
                            $query->orWhere('estado_pago_id', EstadoPago::ADELANTO);
                        })
                        ->where('is_fraccion', 0)
                        ->sum('monto');

                        $event->sheet->setCellValue($this->getColumnaMes($key).$i, $monto );
                        $totalConcepto += $monto;
                        $totalMes[$key] += $monto;
                    }
                    $event->sheet->setCellValue('O'.$i, $totalConcepto);

                    $i++;
                }
                $event->sheet->setCellValue('B'.$i, 'TOTAL RUBRO INGRESOS')->getStyle('B'.$i)->getFont()->setBold(true);
                //totales por mes
                $totalRubro = 0;
                foreach ($this->getMeses() as $key => $mes) {
                    $event->sheet->setCellValue($this->getColumnaMes($key).$i, $totalMes[$key] );
                    $totalRubro += $totalMes[$key];
                    $totalIngresos[$key] += $totalMes[$key];
                }
                $event->sheet->setCellValue('O'.$i, $totalRubro);

                $i += 2;

                //Egresos
                $event->sheet->setCellValue('A'.$i, 'EGRESOS')->getStyle('A'.$i)->getFont()->setBold(true);
                $i++;
                $tipoConceptos = TipoConcepto::where('id','<>','1')->get();
                foreach ($tipoConceptos as $key => $tipoConcepto) {
                    $monto = 0;
                    $event->sheet->setCellValue('A'.$i, $tipoConcepto->name)->getStyle('A'.$i)->getFont()->setBold(true);
                    $i++;
                    //setear total mes a cero
                    foreach ($this->getMeses() as $key => $mes) {
                        $totalMes[$key] = 0;
                    }
                    foreach ($this->conceptos->getEgresosByTipo($tipoConcepto->id) as $key => $concepto) {
                        $event->sheet->setCellValue('A'.$i, $concepto->codigo);
                        $event->sheet->setCellValue('B'.$i, $concepto->name);
                        $totalConcepto = 0;
                        //recorrer meses
                        foreach ($this->getMeses() as $key => $mes) {
                            //recorrer ingresos en BD
                            $monto = GastoDetail::join('gastos','gasto_detail.gasto_id','=','gastos.id')
                            ->where(DB::raw('MONTH(gasto_detail.created_at)'), $key )
                            ->when($request->has('departamento_id'), function ($query) use ($request) {
                               return $query->where('gastos.departamento_id', $request->departamento_id );
                            })
                            ->when($request->has('anio'), function ($query) use ($request) {
                               return $query->where(DB::raw('YEAR(gasto_detail.created_at)'), $request->anio );
                            })
                            ->where('gasto_detail.concepto_id', $concepto->id)
                            ->sum('gasto_detail.monto');
                            $totalMes[$key] += $monto;
                            $event->sheet->setCellValue($this->getColumnaMes($key).$i, $monto );

                            $totalConcepto += $monto;
                        }
                        $event->sheet->setCellValue('O'.$i, $totalConcepto);

                        $i++;
                    }
                    $totalRubro = 0;
                    $event->sheet->setCellValue('B'.$i, 'TOTAL RUBRO: ')->getStyle('B'.$i)->getFont()->setBold(true);
                    //totales por mes
                    foreach ($this->getMeses() as $key => $mes) {
                        $event->sheet->setCellValue($this->getColumnaMes($key).$i, $totalMes[$key] );
                        $totalRubro += $totalMes[$key];
                        $totalEgresos[$key] += $totalMes[$key];
                    }
                    $event->sheet->setCellValue('O'.$i, $totalRubro);

                    $i+=2;
                }

                $event->sheet->setCellValue('B'.$i, 'TOTAL EGRESOS')->getStyle('B'.$i)->getFont()->setBold(true);
                //totales por mes
                foreach ($this->getMeses() as $key => $mes) {
                    $event->sheet->setCellValue($this->getColumnaMes($key).$i, 0 );
                }
                $event->sheet->setCellValue('O'.$i, 0);
                $i += 2;
                $event->sheet->setCellValue('B'.$i, 'RESULTADO NETO')->getStyle('B'.$i)->getFont()->setBold(true);

                //totales por mes
                foreach ($this->getMeses() as $key => $mes) {
                    $total = $total + ($totalIngresos[$key] - $totalEgresos[$key]);
                    $event->sheet->setCellValue($this->getColumnaMes($key).$i, $totalIngresos[$key] - $totalEgresos[$key] );
                }
                //restar ingresos con egresos
                $event->sheet->setCellValue('O'.$i, $total);
                */
       //     }
        //];
    }

    
}