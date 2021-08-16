export const menuItems = [
  {
    label: 'Inicio',
    isTitle: true,
    roles: ''
  },
  {
    label: 'Dashboard',
    icon: 'uil-estate',
    link: '/admin',
    roles: ''
  },
  {
    label: 'Påginas útiles',
    isTitle: true,
    roles: ''
  },
  {
    label: 'Nosotros',
    icon: 'uil-users-alt',
    link: '/admin/utiles/nosotros',
    roles: ''
  },
  {
    label: 'Marco Legal',
    icon: 'uil-balance-scale',
    link: 'https://www.gob.pe/cenepred#normas-legales',
    roles: ''
  },

  // Paginas para el usuario usuario AdHoc
  {
    label: 'Registro y Postulación',
    isTitle: true,
    roles: 'USUARIO_ADHOC'
  },
  {
    label: 'Curriculum Vitae',
    icon: 'uil-layers',
    roles: 'USUARIO_ADHOC',
    subItems: [
      {
        label: 'Formación Académica',
        icon: 'uil-file-plus-alt',
        link: '/admin/adhoc/cv/formacion-academica',
        roles: 'USUARIO_ADHOC'
      },
      {
        label: 'Capacitaciones',
        icon: 'uil-file-plus-alt',
        link: '/admin/adhoc/cv/capacitaciones',
        roles: 'USUARIO_ADHOC'
      },
      {
        label: 'Experiencia Profesional',
        icon: 'uil-file-plus-alt',
        link: '/admin/adhoc/cv/experiencia-profesional',
        roles: 'USUARIO_ADHOC'
      },
      {
        label: 'Experiencia Como Inspector',
        icon: 'uil-file-plus-alt',
        link: '/admin/adhoc/cv/experiencia-inspector',
        roles: 'USUARIO_ADHOC'
      },
      {
        label: 'Verificaciones Realizadas',
        icon: 'uil-file-plus-alt',
        link: '/admin/adhoc/cv/verificaciones-realizadas',
        roles: 'USUARIO_ADHOC'
      },
      {
        label: 'Documentos',
        icon: 'uil-file-plus-alt',
        link: '/admin/adhoc/cv/documentos',
        roles: 'USUARIO_ADHOC'
      }
    ]
  },
  {
    label: 'Postulación',
    icon: 'uil-file-upload',
    link: '/admin/adhoc/postulacion',
    roles: 'USUARIO_ADHOC'
  },
  {
    label: 'Diligencia y Formulación del informe AdHoc',
    isTitle: true,
    roles: 'USUARIO_ADHOC'
  },
  {
    label: 'Expedientes AdHoc',
    icon: 'uil-file-plus-alt',
    link: '/admin/adhoc/expediente',
    roles: 'USUARIO_ADHOC'
  },

  // Paginas para el usuario Cenepred
  {
    label: 'Selección verificadores AdHoc',
    isTitle: true,
    roles: 'USUARIO_CENEPRED'
  },
  {
    label: 'Calificación',
    icon: 'uil-star',
    link: '/admin/cenepred/seleccion/calificacion',
    roles: 'USUARIO_CENEPRED'
  },
  {
    label: 'Pendientes',
    icon: 'uil-edit',
    link: '/admin/cenepred/seleccion/pendiente',
    roles: 'USUARIO_CENEPRED'
  },
  {
    label: 'Resultados',
    icon: 'uil-file-graph',
    link: '/admin/cenepred/seleccion/resultados',
    roles: 'USUARIO_CENEPRED'
  },
  {
    label: 'Acreditaciones',
    icon: 'uil-award',
    link: '/admin/cenepred/seleccion/acreditacion',
    roles: 'USUARIO_CENEPRED'
  },
  {
    label: 'Revisión expediente AdHoc',
    isTitle: true,
    roles: 'USUARIO_CENEPRED'
  },
  {
    label: 'Revisión Expediente AdHoc',
    icon: 'uil-file-plus-alt',
    link: '/admin/cenepred/expediente',
    roles: 'USUARIO_CENEPRED'
  },
  {
    label: 'Notificaciones',
    isTitle: true,
    roles: 'USUARIO_CENEPRED'
  },
  {
    label: 'Informe de Verificación AdHoc',
    icon: 'uil-file-plus-alt',
    link: '/admin/cenepred/informe-verificacion',
    roles: 'USUARIO_CENEPRED'
  },

  // Paginas para el Usuario Administrado
  {
    label: 'Registro de expediente AdHoc',
    isTitle: true,
    roles: 'USUARIO_ADMINISTRADO'
  },
  {
    label: 'Expediente AdHoc',
    icon: 'uil-file-plus-alt',
    link: '/admin/administrado/expediente',
    roles: 'USUARIO_ADMINISTRADO'
  },
  {
    label: 'Solicitar Nº Hoja de Trámite',
    icon: ' uil-telegram-alt',
    link: '/admin/administrado/solicitar-hoja-tramite',
    roles: 'USUARIO_ADMINISTRADO'
  },
  {
    label: 'Solicitar Verificación AdHoc',
    icon: ' uil-telegram-alt',
    link: '/admin/administrado/solicitar-verificacion-adhoc',
    roles: 'USUARIO_ADMINISTRADO'
  },

  // Paginas para el Administrador
  {
    label: 'Reportes',
    isTitle: true,
    roles: 'ADMINISTRADOR'
  },
  {
    label: 'Reportes',
    icon: 'uil-clipboard-alt',
    roles: 'ADMINISTRADOR',
    subItems: [
      {
        label: 'Listado de Reportes',
        icon: 'uil-file-plus-alt',
        link: '/admin/general/reporte/cuadro-meritos',
        roles: 'ADMINISTRADOR'
      }
    ]
  },
  {
    label: 'Configuración',
    isTitle: true,
    roles: 'ADMINISTRADOR'
  },
  {
    label: 'Usuarios',
    icon: 'uil-setting',
    link: '/admin/general/usuarios',
    roles: 'ADMINISTRADOR'
  },
  {
    label: 'Convocatorias',
    icon: 'uil-megaphone',
    link: '/admin/general/convocatorias',
    roles: 'ADMINISTRADOR'
  },
  {
    label: 'Grados',
    icon: 'uil-graduation-cap',
    link: '/admin/general/grados',
    roles: 'ADMINISTRADOR'
  },
  {
    label: 'Instituciones',
    icon: 'uil-building',
    link: '/admin/general/instituciones',
    roles: 'ADMINISTRADOR'
  },
  {
    label: 'Tipo de Instituciones',
    icon: 'uil-cog',
    link: '/admin/general/tipo-instituciones',
    roles: 'ADMINISTRADOR'
  },
  {
    label: 'Tipo de Documentos',
    icon: 'uil-cog',
    link: '/admin/general/tipo-documentos',
    roles: 'ADMINISTRADOR'
  },
  {
    label: 'Tipo de Capacitaciones',
    icon: 'uil-cog',
    link: '/admin/general/tipo-capacitaciones',
    roles: 'ADMINISTRADOR'
  }
]
