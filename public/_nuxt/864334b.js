(window.webpackJsonp=window.webpackJsonp||[]).push([[97,37,38,39,40,41,68],{585:function(t,e,c){"use strict";c.r(e);var l={components:{},props:{title:{type:String,default:""},items:{type:Array,default:function(){return[]}}}},r=c(12),component=Object(r.a)(l,(function(){var t=this,e=t.$createElement,c=t._self._c||e;return c("div",{staticClass:"row mx-lg-4"},[c("div",{staticClass:"col-12"},[c("div",{staticClass:"page-title-box d-flex align-items-center justify-content-between"},[c("h4",{staticClass:"mb-0"},[t._v(t._s(t.title))]),t._v(" "),c("div",{staticClass:"page-title-right"},[c("b-breadcrumb",{staticClass:"m-0",attrs:{items:t.items}})],1)])])])}),[],!1,null,null,null);e.default=component.exports},593:function(t,e,c){"use strict";c.r(e);var l={props:{items:{type:Array,default:function(){return[]}}},data:function(){return{tableData:this.items,totalRows:this.items.length,currentPage:1,perPage:5,sortDesc:!1,sortBy:"fecha_expedicion",fields:[{label:"Especialidad",key:"especialidad",sortable:!0},{label:"F. Expedición",key:"fecha_expedicion",sortable:!0,class:"bs-date-col"},{label:"Ciudad",key:"ciudad",sortable:!0,class:"bs-nro-document-col"},{label:"Grado",key:"grado",sortable:!0,class:"bs-date-col"},{label:"Institución",key:"institucion",sortable:!0},{label:"Certificado",key:"archivo_titulo",sortable:!1,class:"bs-date-col"}]}}},r=c(12),component=Object(r.a)(l,(function(){var t=this,e=t.$createElement,c=t._self._c||e;return c("div",[c("div",{staticClass:"table-responsive mb-0"},[c("b-table",{ref:"table",class:"table-nowrap",attrs:{responsive:"true",items:t.tableData,fields:t.fields,"per-page":t.perPage,"current-page":t.currentPage,"sort-by":t.sortBy,"sort-desc":t.sortDesc,striped:"",borderless:""},on:{"update:sortBy":function(e){t.sortBy=e},"update:sort-by":function(e){t.sortBy=e},"update:sortDesc":function(e){t.sortDesc=e},"update:sort-desc":function(e){t.sortDesc=e}},scopedSlots:t._u([{key:"cell(archivo_titulo)",fn:function(data){return[c("a",{staticClass:"text-decoration",attrs:{href:"javascript:void(0);"},on:{click:function(e){return e.stopPropagation(),t.$downloadFile(data.value)}}},[c("i",{staticClass:"uil uil-file-info-alt font-size-18"}),t._v(" Archivo adjunto\n        ")])]}}])})],1),t._v(" "),c("div",{staticClass:"row"},[c("div",{staticClass:"col"},[c("div",{staticClass:"dataTables_paginate paging_simple_numbers float-end"},[c("ul",{staticClass:"pagination pagination-rounded mb-0"},[c("b-pagination",{attrs:{"total-rows":t.totalRows,"per-page":t.perPage},model:{value:t.currentPage,callback:function(e){t.currentPage=e},expression:"currentPage"}})],1)])])])])}),[],!1,null,null,null);e.default=component.exports},594:function(t,e,c){"use strict";c.r(e);var l={props:{items:{type:Array,default:function(){return[]}}},data:function(){return{tableData:this.items,totalRows:this.items.length,currentPage:1,perPage:5,sortDesc:!1,sortBy:"fecha_inicio",fields:[{label:"Nombre",key:"nombre",sortable:!0},{label:"F. Inicio",key:"fecha_inicio",sortable:!0,class:"bs-date-col"},{label:"F. Fin",key:"fecha_termino",sortable:!0,class:"bs-date-col"},{label:"Horas Lectivas",key:"horas_lectivas",sortable:!0,class:"bs-date-col"},{label:"Ciudad",key:"ciudad",sortable:!0,class:"bs-nro-document-col"},{label:"Tipo Capacitación",key:"tipo_capacitacion",sortable:!0},{label:"Institución",key:"institucion",sortable:!0},{label:"Certificado",key:"certificado",sortable:!1,class:"bs-date-col"}]}}},r=c(12),component=Object(r.a)(l,(function(){var t=this,e=t.$createElement,c=t._self._c||e;return c("div",[c("div",{staticClass:"table-responsive mb-0"},[c("b-table",{ref:"table",class:"table-nowrap",attrs:{responsive:"true",items:t.tableData,fields:t.fields,"per-page":t.perPage,"current-page":t.currentPage,"sort-by":t.sortBy,"sort-desc":t.sortDesc,striped:"",borderless:""},on:{"update:sortBy":function(e){t.sortBy=e},"update:sort-by":function(e){t.sortBy=e},"update:sortDesc":function(e){t.sortDesc=e},"update:sort-desc":function(e){t.sortDesc=e}},scopedSlots:t._u([{key:"cell(certificado)",fn:function(data){return[c("a",{staticClass:"text-decoration",attrs:{href:"javascript:void(0);"},on:{click:function(e){return e.stopPropagation(),t.$downloadFile(data.value)}}},[c("i",{staticClass:"uil uil-file-info-alt font-size-18"}),t._v(" Archivo adjunto\n        ")])]}}])})],1),t._v(" "),c("div",{staticClass:"row"},[c("div",{staticClass:"col"},[c("div",{staticClass:"dataTables_paginate paging_simple_numbers float-end"},[c("ul",{staticClass:"pagination pagination-rounded mb-0"},[c("b-pagination",{attrs:{"total-rows":t.totalRows,"per-page":t.perPage},model:{value:t.currentPage,callback:function(e){t.currentPage=e},expression:"currentPage"}})],1)])])])])}),[],!1,null,null,null);e.default=component.exports},595:function(t,e,c){"use strict";c.r(e);var l={props:{items:{type:Array,default:function(){return[]}}},data:function(){return{tableData:this.items,totalRows:this.items.length,currentPage:1,perPage:5,sortDesc:!1,sortBy:"fecha_inicio",fields:[{label:"Cargo",key:"cargo",sortable:!0},{label:"F. Inicio",key:"fecha_inicio",sortable:!0,class:"bs-date-col"},{label:"F. Fin",key:"fecha_fin",sortable:!0,class:"bs-date-col"},{label:"Tiempo (meses)",key:"tiempo_total",sortable:!0,class:"bs-date-col"},{label:"Institución",key:"institucion",sortable:!0},{label:"Constancia",key:"archivo_constancia",sortable:!1,class:"bs-date-col"}]}}},r=c(12),component=Object(r.a)(l,(function(){var t=this,e=t.$createElement,c=t._self._c||e;return c("div",[c("div",{staticClass:"table-responsive mb-0"},[c("b-table",{ref:"table",class:"table-nowrap",attrs:{responsive:"true",items:t.tableData,fields:t.fields,"per-page":t.perPage,"current-page":t.currentPage,"sort-by":t.sortBy,"sort-desc":t.sortDesc,striped:"",borderless:""},on:{"update:sortBy":function(e){t.sortBy=e},"update:sort-by":function(e){t.sortBy=e},"update:sortDesc":function(e){t.sortDesc=e},"update:sort-desc":function(e){t.sortDesc=e}},scopedSlots:t._u([{key:"cell(archivo_constancia)",fn:function(data){return[c("a",{staticClass:"text-decoration",attrs:{href:"javascript:void(0);"},on:{click:function(e){return e.stopPropagation(),t.$downloadFile(data.value)}}},[c("i",{staticClass:"uil uil-file-info-alt font-size-18"}),t._v(" Archivo adjunto\n        ")])]}}])})],1),t._v(" "),c("div",{staticClass:"row"},[c("div",{staticClass:"col"},[c("div",{staticClass:"dataTables_paginate paging_simple_numbers float-end"},[c("ul",{staticClass:"pagination pagination-rounded mb-0"},[c("b-pagination",{attrs:{"total-rows":t.totalRows,"per-page":t.perPage},model:{value:t.currentPage,callback:function(e){t.currentPage=e},expression:"currentPage"}})],1)])])])])}),[],!1,null,null,null);e.default=component.exports},596:function(t,e,c){"use strict";c.r(e);var l={props:{items:{type:Array,default:function(){return[]}}},data:function(){return{tableData:this.items,totalRows:this.items.length,currentPage:1,perPage:5,sortDesc:!1,sortBy:"fecha_inicio",fields:[{label:"Institución",key:"institucion",sortable:!0},{label:"F. Inicio",key:"fecha_inicio",sortable:!0,class:"bs-date-col"},{label:"F. Fin",key:"fecha_fin",sortable:!0,class:"bs-date-col"},{label:"Constancia",key:"archivo_constancia",sortable:!1,class:"bs-date-col"}]}}},r=c(12),component=Object(r.a)(l,(function(){var t=this,e=t.$createElement,c=t._self._c||e;return c("div",[c("div",{staticClass:"table-responsive mb-0"},[c("b-table",{ref:"table",class:"table-nowrap",attrs:{responsive:"true",items:t.tableData,fields:t.fields,"per-page":t.perPage,"current-page":t.currentPage,"sort-by":t.sortBy,"sort-desc":t.sortDesc,striped:"",borderless:""},on:{"update:sortBy":function(e){t.sortBy=e},"update:sort-by":function(e){t.sortBy=e},"update:sortDesc":function(e){t.sortDesc=e},"update:sort-desc":function(e){t.sortDesc=e}},scopedSlots:t._u([{key:"cell(archivo_constancia)",fn:function(data){return[c("a",{staticClass:"text-decoration",attrs:{href:"javascript:void(0);"},on:{click:function(e){return e.stopPropagation(),t.$downloadFile(data.value)}}},[c("i",{staticClass:"uil uil-file-info-alt font-size-18"}),t._v(" Archivo adjunto\n        ")])]}}])})],1),t._v(" "),c("div",{staticClass:"row"},[c("div",{staticClass:"col"},[c("div",{staticClass:"dataTables_paginate paging_simple_numbers float-end"},[c("ul",{staticClass:"pagination pagination-rounded mb-0"},[c("b-pagination",{attrs:{"total-rows":t.totalRows,"per-page":t.perPage},model:{value:t.currentPage,callback:function(e){t.currentPage=e},expression:"currentPage"}})],1)])])])])}),[],!1,null,null,null);e.default=component.exports},597:function(t,e,c){"use strict";c.r(e);var l={props:{items:{type:Array,default:function(){return[]}}},data:function(){return{tableData:this.items,totalRows:this.items.length,currentPage:1,perPage:5,sortDesc:!1,sortBy:"fecha",fields:[{label:"Institución",key:"institucion",sortable:!0},{label:"Nro. Expediente",key:"nro_expediente",sortable:!0,class:"bs-nro-document-col"},{label:"Nro. Informe",key:"nro_informe",sortable:!0,class:"bs-nro-document-col"},{label:"Fecha",key:"fecha",sortable:!0,class:"bs-date-col"}]}}},r=c(12),component=Object(r.a)(l,(function(){var t=this,e=t.$createElement,c=t._self._c||e;return c("div",[c("div",{staticClass:"table-responsive mb-0"},[c("b-table",{ref:"table",class:"table-nowrap",attrs:{responsive:"true",items:t.tableData,fields:t.fields,"per-page":t.perPage,"current-page":t.currentPage,"sort-by":t.sortBy,"sort-desc":t.sortDesc,striped:"",borderless:""},on:{"update:sortBy":function(e){t.sortBy=e},"update:sort-by":function(e){t.sortBy=e},"update:sortDesc":function(e){t.sortDesc=e},"update:sort-desc":function(e){t.sortDesc=e}}})],1),t._v(" "),c("div",{staticClass:"row"},[c("div",{staticClass:"col"},[c("div",{staticClass:"dataTables_paginate paging_simple_numbers float-end"},[c("ul",{staticClass:"pagination pagination-rounded mb-0"},[c("b-pagination",{attrs:{"total-rows":t.totalRows,"per-page":t.perPage},model:{value:t.currentPage,callback:function(e){t.currentPage=e},expression:"currentPage"}})],1)])])])])}),[],!1,null,null,null);e.default=component.exports},752:function(t,e,c){"use strict";c.r(e);var l=c(25),r=(c(15),c(64),{layout:"vertical",asyncData:function(t){return Object(l.a)(regeneratorRuntime.mark((function e(){var c,l,r;return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return c=t.params,l=t.redirect,c.id||l("/admin/cenepred/seleccion/calificacion"),r=c.id,e.abrupt("return",{id:r});case 4:case"end":return e.stop()}}),e)})))()},head:function(){return{title:"".concat(this.title," | CENEPRED")}},data:function(){return{title:"Calificación",items:[{text:"Admin"},{text:"Selección verificadores AdHoc"},{text:"Calificación",active:!0}],id:null,item:{},loading:!0,visibleFormaciones:!0,visibleCapacitaciones:!1,visibleExpgeneral:!1,visibleExpinspector:!1,visibleVerificaciones:!1}},mounted:function(){this.getAdhocData()},computed:{adhoc_fullname:function(){return this.item.usuario_nombres+" "+this.item.usuario_apellido_paterno+" "+this.item.usuario_apellido_materno},puntaje_formaciones:function(){var t=this.item.formaciones;return t.length&&t[0].puntaje||0},puntaje_capacitaciones:function(){var t=this.item.capacitaciones;return t.length&&t[0].puntaje||0},puntaje_experiencias_generales:function(){var t=this.item.experiencias_generales;return t.length&&t[0].puntaje||0},puntaje_experiencias_inspector:function(){var t=this.item.experiencias_inspector;return t.length&&t[0].puntaje||0},puntaje_verificaciones_realizadas:function(){var t=this.item.verificaciones_realizadas;return t.length&&t[0].puntaje||0},esta_calificado:function(){return this.item.esta_calificado||!1},collapseAll:function(){return this.visibleFormaciones&&this.visibleCapacitaciones&&this.visibleExpgeneral&&this.visibleExpinspector&&this.visibleVerificaciones}},methods:{requestCalificarItem:function(){this.$router.push("/admin/cenepred/seleccion/calificacion/".concat(this.id,"/calificar"))},expandAll:function(){var t=!this.collapseAll;this.visibleFormaciones=t,this.visibleCapacitaciones=t,this.visibleExpgeneral=t,this.visibleExpinspector=t,this.visibleVerificaciones=t},getAdhocData:function(){var t=this;return Object(l.a)(regeneratorRuntime.mark((function e(){var c;return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return c="/calificacion/"+t.id,e.next=3,t.$axios.get(c).then((function(e){e||t.$router.push("/admin/cenepred/seleccion/calificacion"),t.item=e.data.data})).finally((function(){t.loading=!1}));case 3:case"end":return e.stop()}}),e)})))()}},middleware:"us-cenepred"}),n=c(12),component=Object(n.a)(r,(function(){var t=this,e=t.$createElement,c=t._self._c||e;return c("div",[c("PageHeader",{attrs:{title:t.title,items:t.items}}),t._v(" "),t.loading?c("div",{staticClass:"row mx-lg-4"},[t._m(0)]):c("div",{staticClass:"row mx-lg-4"},[c("div",{staticClass:"col-lg-12"},[c("div",{staticClass:"card"},[c("div",{staticClass:"card-body"},[c("div",{staticClass:"row"},[c("div",{staticClass:"col-md-6"},[c("div",{staticClass:"mb-3"},[c("label",{staticClass:"form-label"},[t._v("Convocatoria:")]),t._v(" "),c("p",{staticClass:"text-muted m-0"},[t._v(t._s(t.item.convocatoria_nombre))])]),t._v(" "),c("div",{staticClass:"mb-3"},[c("label",{staticClass:"form-label"},[t._v("Postulante:")]),t._v(" "),c("p",{staticClass:"text-muted m-0"},[t._v("\n                  "+t._s(t.adhoc_fullname)+"\n                ")])])]),t._v(" "),c("div",{staticClass:"col-md-6"},[c("div",{staticClass:"mb-3"},[c("label",{staticClass:"form-label"},[t._v("Sede Registral:")]),t._v(" "),c("p",{staticClass:"text-muted m-0"},[t._v(t._s(t.item.sede_registral_nombre))])]),t._v(" "),c("div",{staticClass:"mb-3"},[c("label",{staticClass:"form-label"},[t._v("Puntaje Total:")]),t._v(" "),c("p",{staticClass:"text-info m-0"},[t._v(t._s(t.item.puntaje_total)+" puntos")])])])]),t._v(" "),c("div",{staticClass:"button-items"},[t.esta_calificado?t._e():c("b-button",{attrs:{variant:"success"},on:{click:t.requestCalificarItem}},[c("i",{staticClass:"far fa-star"}),t._v(" Calificar\n            ")]),t._v(" "),t.collapseAll?[c("b-button",{attrs:{variant:"light"},on:{click:t.expandAll}},[c("i",{staticClass:"fas fa-eye-slash"}),t._v(" Contraer todo")])]:[c("b-button",{attrs:{variant:"light"},on:{click:t.expandAll}},[c("i",{staticClass:"fas fa-eye"}),t._v(" Expandir todo")])]],2)])]),t._v(" "),c("div",{staticClass:"card"},[c("div",{staticClass:"card-header"},[t._m(1),t._v(" "),c("h2",{staticClass:"card-title"},[t._v("\n            Formaciones\n            "),c("span",{staticClass:"text-subsection text-info"},[t._v("\n              Puntaje: "),c("b",[t._v(t._s(t.puntaje_formaciones)+" puntos")])])]),t._v(" "),c("div",{staticClass:"card-options"},[t.esta_calificado?t._e():c("b-button",{staticClass:"w-sm",attrs:{size:"sm",variant:"success"},on:{click:t.requestCalificarItem}},[c("i",{staticClass:"far fa-star"}),t._v(" Calificar\n            ")]),t._v(" "),c("b-button",{directives:[{name:"b-toggle",rawName:"v-b-toggle.collapse-1",modifiers:{"collapse-1":!0}}],staticClass:"w-sm",attrs:{size:"sm",variant:"outline-light","data-toggle":"collapse"}},[t.visibleFormaciones?[c("i",{staticClass:"fas fa-chevron-up"}),t._v(" Contraer ")]:[c("i",{staticClass:"fas fa-chevron-down"}),t._v(" Expandir ")]],2)],1)]),t._v(" "),c("b-collapse",{attrs:{id:"collapse-1",visible:""},model:{value:t.visibleFormaciones,callback:function(e){t.visibleFormaciones=e},expression:"visibleFormaciones"}},[c("div",{staticClass:"card-body"},[c("CenepredSeleccionCalificacionesTablaFormaciones",{attrs:{items:t.item.formaciones}})],1)])],1),t._v(" "),c("div",{staticClass:"card"},[c("div",{staticClass:"card-header"},[t._m(2),t._v(" "),c("h2",{staticClass:"card-title"},[t._v("\n            Capacitaciones\n            "),c("span",{staticClass:"text-subsection text-info"},[t._v("\n              Puntaje: "),c("b",[t._v(t._s(t.puntaje_capacitaciones)+" puntos")])])]),t._v(" "),c("div",{staticClass:"card-options"},[t.esta_calificado?t._e():c("b-button",{staticClass:"w-sm",attrs:{size:"sm",variant:"success"},on:{click:t.requestCalificarItem}},[c("i",{staticClass:"far fa-star"}),t._v(" Calificar\n            ")]),t._v(" "),c("b-button",{directives:[{name:"b-toggle",rawName:"v-b-toggle.collapse-2",modifiers:{"collapse-2":!0}}],staticClass:"w-sm",attrs:{size:"sm",variant:"outline-light","data-toggle":"collapse"}},[t.visibleCapacitaciones?[c("i",{staticClass:"fas fa-chevron-up"}),t._v(" Contraer ")]:[c("i",{staticClass:"fas fa-chevron-down"}),t._v(" Expandir ")]],2)],1)]),t._v(" "),c("b-collapse",{attrs:{id:"collapse-2",visible:""},model:{value:t.visibleCapacitaciones,callback:function(e){t.visibleCapacitaciones=e},expression:"visibleCapacitaciones"}},[c("div",{staticClass:"card-body"},[c("CenepredSeleccionCalificacionesTablaCapacitaciones",{attrs:{items:t.item.capacitaciones}})],1)])],1),t._v(" "),c("div",{staticClass:"card"},[c("div",{staticClass:"card-header"},[t._m(3),t._v(" "),c("h2",{staticClass:"card-title"},[t._v("\n            Experiencia General\n            "),c("span",{staticClass:"text-subsection text-info"},[t._v("\n              Puntaje: "),c("b",[t._v(t._s(t.puntaje_experiencias_generales)+" puntos")])])]),t._v(" "),c("div",{staticClass:"card-options"},[t.esta_calificado?t._e():c("b-button",{staticClass:"w-sm",attrs:{size:"sm",variant:"success"},on:{click:t.requestCalificarItem}},[c("i",{staticClass:"far fa-star"}),t._v(" Calificar\n            ")]),t._v(" "),c("b-button",{directives:[{name:"b-toggle",rawName:"v-b-toggle.collapse-3",modifiers:{"collapse-3":!0}}],staticClass:"w-sm",attrs:{size:"sm",variant:"outline-light","data-toggle":"collapse"}},[t.visibleExpgeneral?[c("i",{staticClass:"fas fa-chevron-up"}),t._v(" Contraer ")]:[c("i",{staticClass:"fas fa-chevron-down"}),t._v(" Expandir ")]],2)],1)]),t._v(" "),c("b-collapse",{attrs:{id:"collapse-3",visible:""},model:{value:t.visibleExpgeneral,callback:function(e){t.visibleExpgeneral=e},expression:"visibleExpgeneral"}},[c("div",{staticClass:"card-body"},[c("CenepredSeleccionCalificacionesTablaExpgeneral",{attrs:{items:t.item.experiencias_generales}})],1)])],1),t._v(" "),c("div",{staticClass:"card"},[c("div",{staticClass:"card-header"},[t._m(4),t._v(" "),c("h2",{staticClass:"card-title"},[t._v("\n            Experiencia como Inspector\n            "),c("span",{staticClass:"text-subsection text-info"},[t._v("\n              Puntaje: "),c("b",[t._v(t._s(t.puntaje_experiencias_inspector)+" puntos")])])]),t._v(" "),c("div",{staticClass:"card-options"},[t.esta_calificado?t._e():c("b-button",{staticClass:"w-sm",attrs:{size:"sm",variant:"success"},on:{click:t.requestCalificarItem}},[c("i",{staticClass:"far fa-star"}),t._v(" Calificar\n            ")]),t._v(" "),c("b-button",{directives:[{name:"b-toggle",rawName:"v-b-toggle.collapse-4",modifiers:{"collapse-4":!0}}],staticClass:"w-sm",attrs:{size:"sm",variant:"outline-light","data-toggle":"collapse"}},[t.visibleExpinspector?[c("i",{staticClass:"fas fa-chevron-up"}),t._v(" Contraer ")]:[c("i",{staticClass:"fas fa-chevron-down"}),t._v(" Expandir ")]],2)],1)]),t._v(" "),c("b-collapse",{attrs:{id:"collapse-4",visible:""},model:{value:t.visibleExpinspector,callback:function(e){t.visibleExpinspector=e},expression:"visibleExpinspector"}},[c("div",{staticClass:"card-body"},[c("CenepredSeleccionCalificacionesTablaExpinspector",{attrs:{items:t.item.experiencias_inspector}})],1)])],1),t._v(" "),c("div",{staticClass:"card"},[c("div",{staticClass:"card-header"},[t._m(5),t._v(" "),c("h2",{staticClass:"card-title"},[t._v("\n            Verificaciones Realizadas\n            "),c("span",{staticClass:"text-subsection text-info"},[t._v("\n              Puntaje: "),c("b",[t._v(t._s(t.puntaje_verificaciones_realizadas)+" puntos")])])]),t._v(" "),c("div",{staticClass:"card-options"},[t.esta_calificado?t._e():c("b-button",{staticClass:"w-sm",attrs:{size:"sm",variant:"success"},on:{click:t.requestCalificarItem}},[c("i",{staticClass:"far fa-star"}),t._v(" Calificar\n            ")]),t._v(" "),c("b-button",{directives:[{name:"b-toggle",rawName:"v-b-toggle.collapse-5",modifiers:{"collapse-5":!0}}],staticClass:"w-sm",attrs:{size:"sm",variant:"outline-light","data-toggle":"collapse"}},[t.visibleVerificaciones?[c("i",{staticClass:"fas fa-chevron-up"}),t._v(" Contraer ")]:[c("i",{staticClass:"fas fa-chevron-down"}),t._v(" Expandir ")]],2)],1)]),t._v(" "),c("b-collapse",{attrs:{id:"collapse-5",visible:""},model:{value:t.visibleVerificaciones,callback:function(e){t.visibleVerificaciones=e},expression:"visibleVerificaciones"}},[c("div",{staticClass:"card-body"},[c("CenepredSeleccionCalificacionesTablaVerificaciones",{attrs:{items:t.item.verificaciones_realizadas}})],1)])],1)])])],1)}),[function(){var t=this,e=t.$createElement,c=t._self._c||e;return c("div",{staticClass:"col-lg-12"},[c("div",{staticClass:"card"},[c("div",{staticClass:"card-body"},[c("div",{staticClass:"text-center"},[c("div",{staticClass:"spinner-border text-secondary",attrs:{role:"status"}},[c("span",{staticClass:"sr-only"},[t._v("Cargando...")])])])])])])},function(){var t=this,e=t.$createElement,c=t._self._c||e;return c("div",{staticClass:"me-2"},[c("div",{staticClass:"avatar-xs"},[c("div",{staticClass:"avatar-title rounded-circle bg-soft-primary text-primary"},[t._v("01")])])])},function(){var t=this,e=t.$createElement,c=t._self._c||e;return c("div",{staticClass:"me-2"},[c("div",{staticClass:"avatar-xs"},[c("div",{staticClass:"avatar-title rounded-circle bg-soft-primary text-primary"},[t._v("02")])])])},function(){var t=this,e=t.$createElement,c=t._self._c||e;return c("div",{staticClass:"me-2"},[c("div",{staticClass:"avatar-xs"},[c("div",{staticClass:"avatar-title rounded-circle bg-soft-primary text-primary"},[t._v("03")])])])},function(){var t=this,e=t.$createElement,c=t._self._c||e;return c("div",{staticClass:"me-2"},[c("div",{staticClass:"avatar-xs"},[c("div",{staticClass:"avatar-title rounded-circle bg-soft-primary text-primary"},[t._v("04")])])])},function(){var t=this,e=t.$createElement,c=t._self._c||e;return c("div",{staticClass:"me-2"},[c("div",{staticClass:"avatar-xs"},[c("div",{staticClass:"avatar-title rounded-circle bg-soft-primary text-primary"},[t._v("05")])])])}],!1,null,null,null);e.default=component.exports;installComponents(component,{PageHeader:c(585).default,CenepredSeleccionCalificacionesTablaFormaciones:c(593).default,CenepredSeleccionCalificacionesTablaCapacitaciones:c(594).default,CenepredSeleccionCalificacionesTablaExpgeneral:c(595).default,CenepredSeleccionCalificacionesTablaExpinspector:c(596).default,CenepredSeleccionCalificacionesTablaVerificaciones:c(597).default})}}]);