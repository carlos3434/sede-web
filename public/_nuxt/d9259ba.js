(window.webpackJsonp=window.webpackJsonp||[]).push([[88,24,25,68],{585:function(e,t,n){"use strict";n.r(t);var r={components:{},props:{title:{type:String,default:""},items:{type:Array,default:function(){return[]}}}},o=n(12),component=Object(o.a)(r,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"row mx-lg-4"},[n("div",{staticClass:"col-12"},[n("div",{staticClass:"page-title-box d-flex align-items-center justify-content-between"},[n("h4",{staticClass:"mb-0"},[e._v(e._s(e.title))]),e._v(" "),n("div",{staticClass:"page-title-right"},[n("b-breadcrumb",{staticClass:"m-0",attrs:{items:e.items}})],1)])])])}),[],!1,null,null,null);t.default=component.exports},638:function(e,t,n){"use strict";n.r(t);n(15);var r={props:{title:{type:String,default:"Ingresar Nuevo Expediente"}},data:function(){return{modalId:"modal-add",openModalEvent:"open-add-modal",refreshTableEvent:"refresh-table",apiUrlPartial:"/expedienteadhoc",msgSuccess:"Expediente creado exitosamente!!!",isProcessing:!1,item:{id:null,nombre_comercial:"",direccion:"",area:""}}},created:function(){var e=this;this.$nuxt.$on(this.openModalEvent,(function(){e.showModal()}))},beforeDestroy:function(){this.$nuxt.$off(this.openModalEvent)},methods:{refreshTable:function(){this.$nuxt.$emit(this.refreshTableEvent)},showModal:function(){this.$bvModal.show(this.modalId)},hideModal:function(){this.$bvModal.hide(this.modalId)},resetModal:function(){this.resetFormValues()},resetFormValues:function(){this.item.nombre_comercial="",this.item.direccion="",this.item.area="",this.isProcessing=!1},handleOk:function(e){e.preventDefault(),this.onSubmit()},onSubmit:function(){var e=this;this.$refs.form.validate().then((function(t){t&&(e.isProcessing=!0,e.$axios.post(e.apiUrlPartial,e.item).then((function(t){e.$notify({type:"success",text:e.msgSuccess})})).finally((function(){e.refreshTable(),e.hideModal()})))}))}}},o=n(12),component=Object(o.a)(r,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("b-modal",{attrs:{id:e.modalId,title:e.title,size:"lg"},on:{ok:e.handleOk,hidden:e.resetModal},scopedSlots:e._u([{key:"modal-footer",fn:function(t){var r=t.ok,o=t.cancel;return[n("b-button",{attrs:{size:"md",variant:"link"},on:{click:function(e){return o()}}},[e._v(" Cancelar")]),e._v(" "),n("b-button",{attrs:{type:"submit",size:"md",variant:"primary",disabled:e.isProcessing},on:{click:function(e){return r()}}},[n("span",{directives:[{name:"show",rawName:"v-show",value:e.isProcessing,expression:"isProcessing"}],staticClass:"spinner-border spinner-border-sm"}),e._v(" "),n("i",{directives:[{name:"show",rawName:"v-show",value:!e.isProcessing,expression:"!isProcessing"}],staticClass:"fas fa-paper-plane"}),e._v(" Agregar\n      ")])]}}])},[n("ValidationObserver",{ref:"form",on:{submit:function(e){e.preventDefault()}},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.handleSubmit;return[n("b-form",{on:{submit:function(t){return t.preventDefault(),r(e.onSubmit)}}},[n("ValidationProvider",{attrs:{rules:"required|alpha_num_spaces",name:"Nombre"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.valid,o=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Nombre comercial:"}},[n("b-form-input",{attrs:{type:"text",state:!o[0]&&(!!r||null)},model:{value:e.item.nombre_comercial,callback:function(t){e.$set(e.item,"nombre_comercial",t)},expression:"item.nombre_comercial"}}),e._v(" "),n("b-form-invalid-feedback",[e._v(e._s(o[0]))])],1)]}}],null,!0)}),e._v(" "),n("ValidationProvider",{attrs:{rules:"required|alpha_num_spaces",name:"Dirección"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.valid,o=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Dirección comercial:"}},[n("b-form-input",{attrs:{type:"text",state:!o[0]&&(!!r||null)},model:{value:e.item.direccion,callback:function(t){e.$set(e.item,"direccion",t)},expression:"item.direccion"}}),e._v(" "),n("b-form-invalid-feedback",[e._v(e._s(o[0]))])],1)]}}],null,!0)}),e._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{rules:"required|numeric|integer",name:"Área"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.valid,o=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Área (m²) comercial"}},[n("b-form-input",{attrs:{type:"number",state:!o[0]&&(!!r||null)},model:{value:e.item.area,callback:function(t){e.$set(e.item,"area",t)},expression:"item.area"}}),e._v(" "),n("b-form-invalid-feedback",[e._v(e._s(o[0]))])],1)]}}],null,!0)})],1)])],1)]}}])})],1)],1)}),[],!1,null,null,null);t.default=component.exports},639:function(e,t,n){"use strict";n.r(t);n(15);var r={props:{title:{type:String,default:"Eliminar Expediente"}},data:function(){return{modalId:"modal-delete",openModalEvent:"open-delete-modal",refreshTableEvent:"refresh-table",apiUrlPartial:"/expedienteadhoc/",msgSuccess:"Expediente eliminado exitosamente!!!",isProcessing:!1,item:{id:null,text:""}}},created:function(){var e=this;this.$nuxt.$on(this.openModalEvent,(function(t){e.setItemValues(t),e.showModal()}))},beforeDestroy:function(){this.$nuxt.$off(this.openModalEvent)},computed:{apiUrl:function(){return this.apiUrlPartial+this.item.id}},methods:{refreshTable:function(){this.$nuxt.$emit(this.refreshTableEvent)},showModal:function(){this.$bvModal.show(this.modalId)},hideModal:function(){this.$bvModal.hide(this.modalId),this.resetFormValues()},setItemValues:function(e){this.item.id=e.id,this.item.text=e.nombre_comercial},resetFormValues:function(){this.item.id=null,this.item.text="",this.isProcessing=!1},handleOk:function(e){e.preventDefault(),this.onSubmit()},onSubmit:function(){var e=this;this.item.id&&(this.isProcessing=!0,this.$axios.delete(this.apiUrl).then((function(t){e.$notify({type:"success",text:e.msgSuccess})})).finally((function(){e.refreshTable(),e.hideModal()})))}}},o=n(12),component=Object(o.a)(r,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("b-modal",{attrs:{id:e.modalId,title:e.title},on:{ok:e.handleOk,hidden:e.hideModal},scopedSlots:e._u([{key:"modal-footer",fn:function(t){var r=t.ok,o=t.cancel;return[n("b-button",{attrs:{size:"md",variant:"link"},on:{click:function(e){return o()}}},[e._v(" Cancelar ")]),e._v(" "),n("b-button",{attrs:{type:"submit",size:"md",variant:"danger",disabled:e.isProcessing},on:{click:function(e){return r()}}},[n("span",{directives:[{name:"show",rawName:"v-show",value:e.isProcessing,expression:"isProcessing"}],staticClass:"spinner-border spinner-border-sm"}),e._v("\n        Eliminar\n      ")])]}}])},[n("p",[e._v("¿Está seguro que desea eliminar este registro?")]),e._v(" "),n("p",[n("b",[e._v(e._s(e.item.text))])])])],1)}),[],!1,null,null,null);t.default=component.exports},727:function(e,t,n){"use strict";n.r(t);var r={layout:"vertical",head:function(){return{title:"".concat(this.title," | CENEPRED")}},data:function(){return{title:"Registro de Expediente AdHoc",items:[{text:"Admin"},{text:"Curriculum Vitae"},{text:"Registro de Expediente AdHoc",active:!0}],urlTableData:"/expedienteadhoc",tableData:this.getItems,isBusy:!1,totalRows:1,currentPage:1,perPage:10,pageOptions:[10,25,50,100],filter:"",sortDesc:!0,sortBy:"created_at",fields:[{label:"Nombre Comercial",key:"nombre_comercial",sortable:!0},{label:"Dirección",key:"direccion",sortable:!0},{label:"Área (m²)",key:"area",sortable:!0,class:"bs-date-col"},{label:"Documentos Cargados",key:"estadisticas",sortable:!1,class:"bs-nro-document-col"},{label:"Estado",key:"estado_expediente_nombre",sortable:!1,class:"bs-nro-document-col"},{label:"Opciones",key:"opciones",sortable:!1,class:"bs-option-col",thClass:"bs-option-col-header"}]}},created:function(){var e=this;this.$nuxt.$on("refresh-table",(function(){e.refreshTable()}))},beforeDestroy:function(){this.$nuxt.$off("refresh-table")},methods:{requestDeleteItem:function(e){this.$nuxt.$emit("open-delete-modal",e)},requestAddItem:function(){this.$nuxt.$emit("open-add-modal")},refreshTable:function(){this.$refs.table.refresh()},getItems:function(e){var t=this,n=this.filtersTable(e);return this.$axios.get(this.urlTableData+n).then((function(e){var n=e.data.data;return t.currentPage=e.data.meta.current_page,t.totalRows=e.data.meta.total,t.isBusy=!1,n})).catch((function(e){return t.isBusy=!1,[]}))},filtersTable:function(e){var t=e.sortDesc?"DESC":"ASC",n="?page=".concat(e.currentPage);return n+="&per_page=".concat(e.perPage),n+=e.sortBy?"&sortBy=".concat(e.sortBy):"",n+="&direction=".concat(t)},checkStatusToEdit:function(e){var t=!1;switch(e.estado_expediente_nombre){case"CREADO":case"OBSERVADO":t=!0}return t},checkStatusToDelete:function(e){var t=!1;switch(e.estado_expediente_nombre){case"CREADO":t=!0}return t}},middleware:"us-administrado"},o=n(12),component=Object(o.a)(r,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("PageHeader",{attrs:{title:e.title,items:e.items}}),e._v(" "),n("AdministradoExpedienteAddModal"),e._v(" "),n("AdministradoExpedienteDeleteModal"),e._v(" "),n("div",{staticClass:"row mx-lg-4"},[e._m(0),e._v(" "),n("div",{staticClass:"col-12"},[n("div",{staticClass:"card"},[n("div",{staticClass:"card-header"},[n("h2",{staticClass:"card-title"},[e._v("Listado de expedientes existentes")]),e._v(" "),n("div",{directives:[{name:"permission",rawName:"v-permission",value:"EXPEDIENTE_ADHOC_CREATE",expression:"'EXPEDIENTE_ADHOC_CREATE'"}],staticClass:"card-options"},[n("b-button",{staticClass:"w-sm",attrs:{size:"sm",variant:"success"},on:{click:function(t){return e.requestAddItem()}}},[n("i",{staticClass:"fa fa-fw fa-plus"}),e._v(" Agregar\n            ")])],1)]),e._v(" "),n("div",{staticClass:"card-body"},[n("div",{staticClass:"row mt-4"},[n("div",{staticClass:"col-sm-12 col-md-6"},[n("div",{staticClass:"dataTables_length",attrs:{id:"tickets-table_length"}},[n("label",{staticClass:"d-inline-flex align-items-center"},[e._v("\n                  Mostrar \n                  "),n("b-form-select",{attrs:{size:"sm",options:e.pageOptions},model:{value:e.perPage,callback:function(t){e.perPage=t},expression:"perPage"}}),e._v("\n                   registros\n                ")],1)])])]),e._v(" "),n("div",{staticClass:"table-responsive mb-0"},[n("b-table",{ref:"table",class:"table-nowrap",attrs:{responsive:"sm",busy:e.isBusy,items:e.tableData,fields:e.fields,"per-page":e.perPage,"current-page":e.currentPage,"sort-by":e.sortBy,"sort-desc":e.sortDesc,filter:e.filter,striped:"","show-empty":""},on:{"update:busy":function(t){e.isBusy=t},"update:sortBy":function(t){e.sortBy=t},"update:sort-by":function(t){e.sortBy=t},"update:sortDesc":function(t){e.sortDesc=t},"update:sort-desc":function(t){e.sortDesc=t}},scopedSlots:e._u([{key:"empty",fn:function(){return[n("p",{staticClass:"text-center"},[e._v("No hay registros para mostrar")])]},proxy:!0},{key:"cell(estadisticas)",fn:function(data){return[n("span",{staticClass:"text-info text-truncate mb-0"},[n("b",[e._v(e._s(data.value.completados))]),e._v("\n                  de\n                  "),n("b",[e._v(e._s(data.value.total))])])]}},{key:"cell(estado_expediente_nombre)",fn:function(data){return["OBSERVADO"==data.value?[n("span",{staticClass:"badge bg-soft-danger fw-semibold"},[e._v("\n                    "+e._s(data.value)+"\n                  ")])]:"SOLICITUD VERIFICACION"==data.value?[n("span",{staticClass:"badge bg-soft-warning fw-semibold"},[e._v("\n                    "+e._s(data.value)+"\n                  ")])]:[n("span",{staticClass:"badge bg-soft-info fw-semibold"},[e._v("\n                    "+e._s(data.value)+"\n                  ")])]]}},{key:"cell(opciones)",fn:function(data){return[n("ul",{staticClass:"list-inline two-options mb-0"},[e.checkStatusToEdit(data.item)?e._e():n("li",{staticClass:"list-inline-item"},[n("nuxt-link",{directives:[{name:"b-tooltip",rawName:"v-b-tooltip.hover",modifiers:{hover:!0}}],staticClass:"px-1 text-success",attrs:{to:"/admin/administrado/expediente/"+data.item.id,title:"Ver Detalle"}},[n("i",{staticClass:"uil uil-eye font-size-18"})])],1),e._v(" "),e.checkStatusToEdit(data.item)?n("li",{directives:[{name:"permission",rawName:"v-permission",value:"EXPEDIENTE_ADHOC_EDIT",expression:"'EXPEDIENTE_ADHOC_EDIT'"}],staticClass:"list-inline-item"},[n("nuxt-link",{directives:[{name:"b-tooltip",rawName:"v-b-tooltip.hover",modifiers:{hover:!0}}],staticClass:"px-1 text-primary",attrs:{to:"/admin/administrado/expediente/"+data.item.id,title:"Editar"}},[n("i",{staticClass:"uil uil-pen font-size-18"})])],1):e._e(),e._v(" "),e.checkStatusToDelete(data.item)?n("li",{directives:[{name:"permission",rawName:"v-permission",value:"EXPEDIENTE_ADHOC_DESTROY",expression:"'EXPEDIENTE_ADHOC_DESTROY'"}],staticClass:"list-inline-item"},[n("a",{directives:[{name:"b-tooltip",rawName:"v-b-tooltip.hover",modifiers:{hover:!0}}],staticClass:"px-1 text-danger",attrs:{href:"javascript:void(0);",title:"Eliminar"},on:{click:function(t){return e.requestDeleteItem(data.item)}}},[n("i",{staticClass:"uil uil-trash-alt font-size-18"})])]):e._e()])]}}])})],1),e._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col"},[n("div",{staticClass:"dataTables_paginate paging_simple_numbers float-end"},[n("ul",{staticClass:"pagination pagination-rounded mb-0"},[n("b-pagination",{attrs:{"total-rows":e.totalRows,"per-page":e.perPage},model:{value:e.currentPage,callback:function(t){e.currentPage=t},expression:"currentPage"}})],1)])])])])])]),e._v(" "),e._m(1)])],1)}),[function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"col-12"},[n("div",{staticClass:"card"},[n("div",{staticClass:"card-body"},[n("div",{staticClass:"mb-4"},[n("a",{staticClass:"text-decoration",attrs:{href:"/anexos SISTEMA.pdf",download:""}},[n("i",{staticClass:"fas fa-download font-size-18"}),e._v(" Descargar Anexo Nro. 5 y Nro 6\n            ")])]),e._v(" "),n("div",{staticClass:"alert alert-warning m-0",attrs:{role:"alert"}},[e._v("\n            Despues de "),n("b",[e._v("Agregar")]),e._v(" ("),n("b",[n("i",{staticClass:"fa fa-fw fa-plus"})]),e._v(") un nuevo expediente sírvase a ingresar\n            toda la documentación haciendo click en el boton "),n("b",[e._v("Editar")]),e._v(" (\n            "),n("b",[n("i",{staticClass:"uil uil-pen font-size-18"})]),e._v(")\n            "),n("br"),e._v(" "),n("b",[e._v("Nota:")]),e._v(" No puede editar expedientes en proceso de solicitud de hoja tramite o verificación AdHoc\n          ")])])])])},function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"col-12"},[n("div",{staticClass:"card"},[n("div",{staticClass:"card-body"},[n("div",{staticClass:"alert alert-info m-0"},[e._v("\n            Si desea realizar alguna consulta comuníquese con nosotros:\n            "),n("br"),n("br"),e._v(" "),n("i",{staticClass:"far fa-envelope"}),e._v(" "),n("a",{staticClass:"text-decoration",attrs:{href:"mailto:SoporteAdHoc@cenepred.gob.pe"}},[e._v("SoporteAdHoc@cenepred.gob.pe")]),e._v(" "),n("br"),e._v(" "),n("i",{staticClass:"far fa-envelope"}),e._v(" "),n("a",{staticClass:"text-decoration",attrs:{href:"mailto:mesadepartes@cenepred.gob.pe"}},[e._v("mesadepartes@cenepred.gob.pe")]),e._v(" "),n("br"),e._v(" "),n("i",{staticClass:"fas fa-phone"}),e._v(" "),n("a",{staticClass:"text-decoration",attrs:{href:"tel:01 2013550"}},[e._v("(+51) 2013550")])])])])])}],!1,null,null,null);t.default=component.exports;installComponents(component,{PageHeader:n(585).default,AdministradoExpedienteAddModal:n(638).default,AdministradoExpedienteDeleteModal:n(639).default})}}]);