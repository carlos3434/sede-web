<?php

namespace App\Repositories\Reportes\Interfaces;

interface ReporteRepositoryInterface 
{
    public function anexo2Query( $request );
    public function anexo3Query( $request );
    public function requerimientopagoQuery( $request );
    public function anexo6Query( $request );
    public function anexo9Query( $request );
    public function cuadro1Query( $request );
    public function cuadro2Query( $request );
    public function cuadro3Query( $request );
    public function cuadro4Query( $request );

}