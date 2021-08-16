<?php
namespace App\Repositories\Reportes;
use App\Repositories\Reportes\Interfaces\ReporteRepositoryInterface;
/**
 * 
 */
class ReporteRepository implements ReporteRepositoryInterface
{
    public function anexo2Query( $request ){
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

            where ur.role_id = 3';
        $param = [];
        if ($request->has('sede_registral_id')) {
            $sql .= ' AND cal.sede_registral_id = ?';
            array_push($param, $request->sede_registral_id);
        }

        return \DB::select($sql,$param);
    }

    public function anexo3Query( $request )
    {
        $sql = "SELECT
                    u.nombres , u.apellido_paterno , u.numero_documento ,
                    u.profesion,
                    u.colegio_profesional , u.numero_colegiatura , 
                    coalesce( sum( p.puntaje ), 0)  as puntaje,
                    sr.nombre as sede_registral,
                    c.fecha as fecha_postulacion
                   
                from users u 
                left join calificaciones c on c.usuario_id  = u.id
                left join acreditaciones a on c.id = a.calificacion_id
                left join sedes_registrales sr on c.sede_registral_id = sr.id 
                left join puntajes p on c.id = p.calificacion_id 
                WHERE u.id is not null ";
        $param = [];
        if ($request->has('sede_registral_id')) {
            $sql .= ' AND c.sede_registral_id = ?';
            array_push($param, $request->sede_registral_id);
        }
        $sql .= " GROUP BY u.id, c.id , a.id , sr.id 
                  order by coalesce( sum( p.puntaje ), 0)  DESC ";
        return \DB::select($sql,$param);
    }
    public function requerimientoPagoQuery( $request )
    {
        $sql = "SELECT 
                    --ad hoc
                    adhoc.nombres,
                    adhoc.apellido_paterno ,
                    adhoc.apellido_materno ,
                    '' as ruc,
                    ea.ht as numero_hoja_tramite,
                    -- administrado
                    administrado.nombres,
                    administrado.apellido_paterno ,
                    administrado.apellido_materno ,
                    ea.numero_operacion,
                    ea.nombre_banco,
                    ea.agencia,
                    ea.fecha_operacion,
                    ea.monto
                        
                from expedientes_adhocs ea 
                left join users as adhoc on ea.usuario_revisor_id = adhoc.id
                left join users as administrado on ea.usuario_id = administrado.id
                left join calificaciones as c on adhoc.id = c.usuario_id
                WHERE ea.monto IS NOT NULL ";
        $param = [];
        if ($request->has('sede_registral_id')) {
            $sql .= ' AND c.sede_registral_id = ?';
            array_push($param, $request->sede_registral_id);
        }        
        return \DB::select($sql,$param);
    }
    public function anexo6Query( $request )
    {
        $sql = "SELECT 
                    --ad hoc
                    adhoc.nombres,
                    adhoc.apellido_paterno ,
                    adhoc.apellido_materno ,
                    '' as ruc,
                    ea.ht as numero_hoja_tramite,
                    -- administrado
                    administrado.nombres,
                    administrado.apellido_paterno ,
                    administrado.apellido_materno ,
                    ea.numero_operacion,
                    ea.nombre_banco,
                    ea.agencia,
                    ea.fecha_operacion,
                    ea.monto
                        
                from expedientes_adhocs ea 
                left join users as adhoc on ea.usuario_revisor_id = adhoc.id
                left join users as administrado on ea.usuario_id = administrado.id
                left join calificaciones as c on adhoc.id = c.usuario_id 
            
                WHERE ea.monto IS NOT NULL";

        $param = [];
        if ($request->has('sede_registral_id')) {
            $sql .= ' AND c.sede_registral_id = ?';
            array_push($param, $request->sede_registral_id);
        }
        return \DB::select($sql,$param);
    }
    public function anexo9Query( $request )
    {
        $sql = '
            SELECT
                ea.ht as numero_hoja_tramite,

                ea.nombre_comercial,
                ea.direccion,
                ea.area,
                d.nombre as distrito,
                administrado.telefono_fijo,
                administrado.celular,
                administrado.nombres as administrado_nombres,
                administrado.apellido_paterno as administrado_apellido_paterno,
                administrado.apellido_materno as administrado_apellido_materno,
                
                ea.numero_operacion,
                ea.nombre_banco,
                ea.agencia,
                ea.fecha_operacion,
                ea.monto,
                
                adhoc.nombres as adhoc_nombres,
                adhoc.apellido_paterno as adhoc_apellido_paterno ,
                adhoc.apellido_materno as adhoc_apellido_materno ,
                adhoc.profesion as adhoc_profesion,
                
                ea.created_at as fecha_regisitro_expediente,
                ea.fecha_ingreso_ht as fecha_ingreso_hoja_tramite,
                ea.fecha_solicitud_ht as fecha_solicitud_hoja_tramite,
                ee.fecha_entrega,
                ee.fecha_recepcion,
                
                d2.created_at as fecha_registro_diligencia,
                d2.fecha as fecha_programacion,
                
                ee2.nombre estado_expediente,
                
                cenepred.nombres as responsable_nombre,
                cenepred.apellido_paterno as responsable_apellido_paterno,
                cenepred.apellido_materno as responsable_apellido_materno
                    
            from expedientes_adhocs as ea 
            left join users as adhoc on ea.usuario_revisor_id = adhoc.id
            left join users as administrado on ea.usuario_id = administrado.id
            left join model_has_roles ur on ur.model_type = \'App\Models\Auth\User\' and adhoc.id = ur.model_id
            left join entregas_expedientes as ee on ea.id = ee.expediente_adhoc_id
            left join distritos as d on ea.distrito_id = d.id 
            left join diligencias as d2 on ee.id = d2.entrega_expediente_id 
            left join estado_expediente as ee2 on ea.estado_expediente_id = ee2.id 
            left join users as cenepred on ee.usuario_asignador_id = cenepred.id

            left join calificaciones as c on adhoc.id = c.usuario_id 
            WHERE ur.role_id = 3
        ';
        return \DB::select($sql);
    }
    public function cuadro1Query( $request )
    {
        $sql = '
            SELECT adhoc.nombres , adhoc.apellido_paterno , adhoc.apellido_materno ,
                   td.nombre ,
                   ea.nombre_comercial ,
                   d2.nombre as departamento,
                   sr.nombre as sede_registral,
                   ee.nombre as estado_expediente

            from users adhoc 
            left join model_has_roles ur on ur.model_type = \'App\Models\Auth\User\' and adhoc.id = ur.model_id
            left join tipos_documentos td on adhoc.tipo_documento_id = td.id
            left join expedientes_adhocs as ea on adhoc.id = ea.usuario_revisor_id
            left join distritos d on ea.distrito_id = d.id 
            left join provincias p on d.provincia_id = p.id 
            left join departamentos d2 on p.departamento_id = d2.id 
             
            left join calificaciones c on adhoc.id = c.usuario_id 
            left join acreditaciones a on c.id = a.calificacion_id
            left join sedes_registrales sr on c.sede_registral_id = sr.id 

            left join estado_expediente ee on ea.estado_expediente_id = ee.id 
            WHERE ur.role_id = 3 
        ';
        $param = [];
        if ($request->has('sede_registral_id')) {
            $sql .= ' AND c.sede_registral_id = ?';
            array_push($param, $request->sede_registral_id);
        }
        return \DB::select($sql,$param);
    }
    public function cuadro2Query( $request )
    {
        $sql = '
            SELECT adhoc.nombres , adhoc.apellido_paterno , adhoc.apellido_materno ,
                   td.nombre ,
                   ea.nombre_comercial ,
                   d2.nombre as departamento,
                   sr.nombre as sede_registral,
                   ee.nombre as estado_expediente

            from users adhoc 
            left join model_has_roles ur on ur.model_type = \'App\Models\Auth\User\' and adhoc.id = ur.model_id
            left join tipos_documentos td on adhoc.tipo_documento_id = td.id
            left join expedientes_adhocs as ea on adhoc.id = ea.usuario_revisor_id
            left join distritos d on ea.distrito_id = d.id 
            left join provincias p on d.provincia_id = p.id 
            left join departamentos d2 on p.departamento_id = d2.id 
             
            left join calificaciones c on adhoc.id = c.usuario_id 
            left join acreditaciones a on c.id = a.calificacion_id
            left join sedes_registrales sr on c.sede_registral_id = sr.id 

            left join estado_expediente ee on ea.estado_expediente_id = ee.id 
            WHERE ur.role_id = 3 ';
        $param = [];
        if ($request->has('sede_registral_id')) {
            $sql .= ' AND c.sede_registral_id = ?';
            array_push($param, $request->sede_registral_id);
        }
        return \DB::select($sql,$param);
    }
    public function cuadro3Query( $request )
    {
        $sql = '
            SELECT
                   td.nombre as tipo_documento,
                   administrado.numero_documento ,
                   administrado.nombres ,
                   administrado.apellido_paterno ,
                   administrado.apellido_materno ,
                   administrado.direccion ,
                   d2.nombre as departamento,
                   p.nombre as provincia,
                   d.nombre as distrito,
                   administrado.telefono_fijo,
                   administrado.celular,
                   administrado.email,
                   administrado.colegio_profesional , 
                   administrado.numero_colegiatura ,
                   ea.nombre_comercial,
                   ea.direccion,
                   ea.area,
                   ea.archivo_solicitud_ht as anexo5,
                   ea.recibo_pago,
                   ea.ht numero_hoja_tramite,
                   ea.fecha_solicitud_ht as fecha_solicitud_hoja_tramite,
                   ea.fecha_ingreso_ht as fecha_ingreso_hoja_tramite,
                   
                   sr.nombre as sede_registral
                   
                   
            from expedientes_adhocs as ea 
            left join users as administrado on ea.usuario_id = administrado.id
            left join model_has_roles ur on ur.model_type = \'App\Models\Auth\User\' and administrado.id = ur.model_id
            left join tipos_documentos td on administrado.tipo_documento_id = td.id
            left join distritos d ON administrado.distrito_id = d.id 
            left join provincias p on d.provincia_id = p.id 
            left join departamentos d2 on p.departamento_id = d2.id

            left join users adhoc on ea.usuario_revisor_id = adhoc.id
            left join calificaciones c on adhoc.id = c.usuario_id 
            left join sedes_registrales sr on c.sede_registral_id = sr.id
            WHERE ur.role_id = 1 
        ';
        $param = [];
        if ($request->has('sede_registral_id')) {
            $sql .= ' AND c.sede_registral_id = ?';
            array_push($param, $request->sede_registral_id);
        }
        return \DB::select($sql,$param);
    }
    public function cuadro4Query( $request )
    {
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

            where ur.role_id = 3';
        $param = [];
        if ($request->has('sede_registral_id')) {
            $sql .= ' AND cal.sede_registral_id = ?';
            array_push($param, $request->sede_registral_id);
        }

        return \DB::select($sql,$param);
    }

}