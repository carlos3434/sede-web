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


use Illuminate\Contrts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Illuminate\Contracts\Support\Responsable;

use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\WithTitle;

class PostulantesAdhocExport implements 
    FromArray, 
    Responsable , 
   // WithTitle,
   // WithHeadings,
    WithEvents
    //WithColumnFormatting
    //WithStrictNullComparison
    //FromCollection
    //FromView
    //FromQuery
{
    use Exportable, RegistersEventListeners;

    private $fileName = 'users.xlsx';

    public $request;
    public $query;

    public function __construct( Request $request )
    {
        $this->request = $request;
    }
    public function array(): array
    {
        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => new PostulantesAdhoc($this->request),
        ];
    }
}