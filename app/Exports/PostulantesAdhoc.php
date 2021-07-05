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

class PostulantesAdhoc
{
    public $request;
    public $query;

    public function __construct( $request  ) {
        $this->request = $request;
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
        foreach ($this->headings() as $key => $nombreHead) {
            $sheet->setCellValue($key.'3', $nombreHead );
            $sheet->getColumnDimension($key)->setAutoSize(true);
        }

        $fila = 4;//desde la fila 4 empiezan los valores

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
        $sql = '
            SELECT 
                u.id as usuario_id, 
                u.apellido_paterno as ape_paterno,
                u.apellido_materno as ape_materno,
                u.nombres as nombres,
                u.colegio_profesional as colegio_profesional,
                u.numero_colegiatura as numero_colegiatura,
                dep.nombre as departamento_postulacion,

                f.especialidad as especialidad,
                f.fecha_expedicion as fecha_expedicion,
                f.ciudad as f_ciudad,
                gf.nombre as f_grado,
                iff.nombre as f_institucion,

                c.nombre as capacitacion,
                c.fecha_inicio as c_fecha_inicio,
                c.fecha_termino as c_fecha_termino,
                c.horas_lectivas as horas_lectivas,
                c.ciudad as c_ciudad,
                tpc.nombre as c_tipo,
                ic.nombre as c_institucion,

                eg.cargo as cargo,
                eg.fecha_inicio as e_fecha_inicio,
                eg.fecha_fin as e_fecha_fin,
                eg.tiempo_total as tiempo_total,
                ieg.nombre as e_institucion,

                ei.fecha_inicio as i_fecha_inicio,
                ei.fecha_fin as i_fecha_fin,
                iei.nombre as i_institucion,

                vr.nro_expediente as nro_expediente,
                vr.fecha as v_fecha,
                vr.nro_informe as nro_informe,
                ivr.nombre as v_institucion,

                cal.fecha as c_fecha,
                srcal.nombre as sedes_registrales,
                con.nombre as convocatoria

            FROM users u

            left join model_has_roles ur on ur.model_type = \'App\Models\Auth\User\' and u.id = ur.model_id
            left join distritos dis on u.distrito_id = dis.id
            left join provincias pro on dis.provincia_id = pro.id 
            left join departamentos dep on pro.departamento_id = dep.id

            left join formaciones f on u.id = f.usuario_id
            left join grados gf on f.grado_id = gf.id
            left join instituciones iff on f.institucion_id= iff.id

            left join capacitaciones c on u.id = c.usuario_id
            left join tipos_capacitaciones tpc on c.tipo_capacitacion_id = tpc.id
            left join instituciones ic on c.institucion_id= ic.id

            left join experiencias_generales eg on u.id = eg.usuario_id
            left join instituciones ieg on eg.institucion_id= ieg.id

            left join experiencias_inspectores ei on u.id = ei.usuario_id
            left join instituciones iei on ei.institucion_id= iei.id

            left join verificacion_realizadas vr on u.id = vr.usuario_id
            left join instituciones ivr on vr.institucion_id= ivr.id

            left join calificaciones cal on u.id = cal.usuario_id
            left join convocatorias con on cal.convocatoria_id = con.id
            left join sedes_registrales srcal on cal.sede_registral_id = srcal.id

            where ur.role_id = 3 AND cal.sede_registral_id = ?';

        $sedeRegistralId = ($this->request->sede_registral_id)? $this->request->sede_registral_id:true;

        return \DB::select($sql,[$sedeRegistralId]);
    }

    public function getLetraDeColumna($index)
    {
        return array_search( $index, $this->headings() );
        return $this->headings()[$index];
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