<?php

namespace App\Exports;

use Illuminate\Http\Request;

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

use App\Repositories\Reportes\Interfaces\ReporteRepositoryInterface;
class RequerimientoPagoExport implements 
    FromArray, 
    Responsable , 
    WithEvents

{
    use Exportable, RegistersEventListeners;

    private $query;

    public function __construct( $query  )
    {
        $this->query = $query;
    }

    public function array(): array
    {
        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => new RequerimientoPago(  $this->query  ),
        ];
    }
}