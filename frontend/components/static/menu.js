export const menuItems = [
  {
    label: 'Inicio',
    isTitle: true
  },
  {
    label: 'Dashboard',
    icon: 'uil-home-alt',
    link: '/admin/dashboard'
  },
  {
    label: 'Påginas útiles',
    isTitle: true
  },
  {
    label: 'Nosotros',
    icon: 'uil-users-alt',
    link: '/admin/utiles/nosotros'
  },
  {
    label: 'Marco Legal',
    icon: 'uil-balance-scale',
    link: '/admin/utiles/marco-legal'
  },
  // {
  //   label: 'Registro y Postulación Adhoc',
  //   isTitle: true,
  //   roles: 'USUARIO_ADHOC'
  // },
  {
    label: 'Curriculum Vitae',
    icon: 'uil-clipboard-alt',
    roles: 'USUARIO_ADHOC',
    subItems: [
      {
        label: 'Formación Académica',
        icon: 'uil-file-plus-alt',
        link: '/admin/cv/formacion-academica'
      },
      {
        label: 'Capacitaciones',
        icon: 'uil-file-plus-alt',
        link: '/admin/cv/capacitaciones'
      },
      {
        label: 'Experiencia Profesional',
        icon: 'uil-file-plus-alt',
        link: '/admin/cv/experiencia-profesional'
      },
      {
        label: 'Experiencia Como Inspector',
        icon: 'uil-file-plus-alt',
        link: '/admin/cv/experiencia-inspector'
      },
      {
        label: 'Verificaciones Realizadas',
        icon: 'uil-file-plus-alt',
        link: '/admin/cv/verificaciones-realizadas'
      },
      {
        label: 'Documentos',
        icon: 'uil-file-plus-alt',
        link: '/admin/cv/documentos'
      }
    ]
  },
  {
    label: 'Selección verificadores Adhoc',
    isTitle: true,
    roles: 'ADMINISTRADOR|USUARIO_CENEPRED'
  },
  {
    label: 'Registro de expediente Adhoc',
    isTitle: true,
    roles: 'ADMINISTRADOR|USUARIO_CENEPRED|USUARIO_ADMINISTRADO'
  },
  // {
  //   label: 'Diligencia y formulación del informe Adhoc',
  //   isTitle: true,
  //   roles: 'USUARIO_ADHOC'
  // },
  {
    label: 'Notificación del informe Adhoc',
    isTitle: true,
    roles: 'ADMINISTRADOR|USUARIO_CENEPRED'
  },
  {
    label: 'Recepcion y descarga del informe Adhoc',
    isTitle: true,
    roles: 'ADMINISTRADOR|USUARIO_CENEPRED'
  },
  {
    label: 'Reportes',
    icon: 'uil-clipboard-alt',
    roles: 'ADMINISTRADOR|USUARIO_CENEPRED',
    subItems: [
      {
        label: 'Cuadro de Méritos',
        icon: 'uil-file-plus-alt',
        link: '/admin/reporte/cuadro-meritos'
      }
    ]
  },
  {
    label: 'Mantenimiento',
    isTitle: true,
    roles: 'ADMINISTRADOR'
  },
  {
    label: 'Configuraciones',
    icon: 'uil-setting',
    link: '/admin/config/config',
    roles: 'ADMINISTRADOR'
  },
  {
    label: 'Convocatorias',
    icon: 'uil-megaphone',
    link: '/admin/config/convocatorias',
    roles: 'ADMINISTRADOR'
  },
  {
    label: 'Grados',
    icon: 'uil-graduation-cap',
    link: '/admin/config/grados',
    roles: 'ADMINISTRADOR'
  },
  {
    label: 'Instituciones',
    icon: 'uil-building',
    link: '/admin/config/instituciones',
    roles: 'ADMINISTRADOR'
  },
  {
    label: 'Tipo de Instituciones',
    icon: 'uil-cog',
    link: '/admin/config/tipo-instituciones',
    roles: 'ADMINISTRADOR'
  },
  {
    label: 'Tipo de Documentos',
    icon: 'uil-cog',
    link: '/admin/config/tipo-documentos',
    roles: 'ADMINISTRADOR'
  },
  {
    label: 'Tipo de Capacitaciones',
    icon: 'uil-cog',
    link: '/admin/config/tipo-capacitaciones',
    roles: 'ADMINISTRADOR'
  }

  // {
  //   label: 'Perfil',
  //   icon: 'uil-user',
  //   link: '/admin/config/perfil',
  //   permission: 'USER_IDEX'
  // },
  // {
  //   label: 'CV',
  //   icon: 'uil-user',
  //   link: '/admin/config/perfil'
  // }
]
