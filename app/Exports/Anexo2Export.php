<?php

namespace App\Exports;

use Illuminate\Http\Request;

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
/*
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contrts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\WithTitle;
*/
class Anexo2Export implements 
    FromArray, 
    Responsable , 
    WithEvents
   // WithTitle,
   // WithHeadings,
    //WithColumnFormatting
    //WithStrictNullComparison
    //FromCollection
    //FromView
    //FromQuery
{
    use Exportable, RegistersEventListeners;

   //private $fileName = 'users.xlsx';

    //private $request;
    //private $repository;
    private $query;

    public function __construct( $query )
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
            AfterSheet::class => new Anexo2( $this->query ),
        ];
    }
}