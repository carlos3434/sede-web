(window.webpackJsonp=window.webpackJsonp||[]).push([[101,43,44,45,68],{585:function(e,t,n){"use strict";n.r(t);var o={components:{},props:{title:{type:String,default:""},items:{type:Array,default:function(){return[]}}}},r=n(12),component=Object(r.a)(o,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"row mx-lg-4"},[n("div",{staticClass:"col-12"},[n("div",{staticClass:"page-title-box d-flex align-items-center justify-content-between"},[n("h4",{staticClass:"mb-0"},[e._v(e._s(e.title))]),e._v(" "),n("div",{staticClass:"page-title-right"},[n("b-breadcrumb",{staticClass:"m-0",attrs:{items:e.items}})],1)])])])}),[],!1,null,null,null);t.default=component.exports},644:function(e,t,n){"use strict";n.r(t);n(15);var o=n(586),r=(n(587),n(588),{components:{DatePicker:o.default},props:{title:{type:String,default:"Agregar Convocatoria"}},data:function(){return{modalId:"modal-add",openModalEvent:"open-add-modal",refreshTableEvent:"refresh-table",apiUrlPartial:"/convocatorias",msgSuccess:"Convocatoria creada exitosamente!!!",isProcessing:!1,item:{id:null,nombre:"",activo:!1,fecha_inicio:"",fecha_final:""}}},created:function(){var e=this;this.$nuxt.$on(this.openModalEvent,(function(){e.showModal()}))},beforeDestroy:function(){this.$nuxt.$off(this.openModalEvent)},computed:{apiUrl:function(){return this.apiUrlPartial}},methods:{refreshTable:function(){this.$nuxt.$emit(this.refreshTableEvent)},showModal:function(){this.$bvModal.show(this.modalId)},hideModal:function(){this.$bvModal.hide(this.modalId)},resetModal:function(){this.resetFormValues()},resetFormValues:function(){this.item.nombre="",this.item.activo=!1,this.item.fecha_inicio="",this.item.fecha_final="",this.isProcessing=!1},handleOk:function(e){e.preventDefault(),this.onSubmit()},onSubmit:function(){var e=this;this.$refs.form.validate().then((function(t){t&&(e.isProcessing=!0,e.$axios.post(e.apiUrl,e.item).then((function(t){e.$notify({type:"success",text:e.msgSuccess})})).finally((function(){e.refreshTable(),e.hideModal()})))}))}}}),l=n(12),component=Object(l.a)(r,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("b-modal",{attrs:{id:e.modalId,title:e.title,size:"lg"},on:{ok:e.handleOk,hidden:e.resetModal},scopedSlots:e._u([{key:"modal-footer",fn:function(t){var o=t.ok,r=t.cancel;return[n("b-button",{attrs:{size:"md",variant:"link"},on:{click:function(e){return r()}}},[e._v(" Cancelar")]),e._v(" "),n("b-button",{attrs:{type:"submit",size:"md",variant:"primary",disabled:e.isProcessing},on:{click:function(e){return o()}}},[n("span",{directives:[{name:"show",rawName:"v-show",value:e.isProcessing,expression:"isProcessing"}],staticClass:"spinner-border spinner-border-sm"}),e._v(" "),n("i",{directives:[{name:"show",rawName:"v-show",value:!e.isProcessing,expression:"!isProcessing"}],staticClass:"fas fa-paper-plane"}),e._v(" Agregar\n      ")])]}}])},[n("ValidationObserver",{ref:"form",on:{submit:function(e){e.preventDefault()}},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.handleSubmit;return[n("b-form",{on:{submit:function(t){return t.preventDefault(),o(e.onSubmit)}}},[n("div",{staticClass:"row"},[n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{rules:"required|alpha_num_spaces",name:"Nombre"},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.valid,r=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Nombre:"}},[n("b-form-input",{attrs:{type:"text",state:!r[0]&&(!!o||null)},model:{value:e.item.nombre,callback:function(t){e.$set(e.item,"nombre",t)},expression:"item.nombre"}}),e._v(" "),n("b-form-invalid-feedback",[e._v(e._s(r[0]))])],1)]}}],null,!0)})],1),e._v(" "),n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{name:"Activo"},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.valid,r=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Activo:"}},[n("b-form-checkbox",{attrs:{value:"true","unchecked-value":"false",state:!r[0]&&(!!o||null)},model:{value:e.item.activo,callback:function(t){e.$set(e.item,"activo",t)},expression:"item.activo"}}),e._v(" "),n("b-form-invalid-feedback",[e._v(e._s(r[0]))])],1)]}}],null,!0)})],1)]),e._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{rules:"required|before_or_equal:@target_fecha_final",name:"Fecha Inicio"},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.valid,r=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Fecha Inicio:"}},[n("date-picker",{class:r[0]?"is-invalid":o?"is-valid":"",attrs:{"first-day-of-week":1,lang:"es",format:"YYYY-MM-DD",valueType:"format"},model:{value:e.item.fecha_inicio,callback:function(t){e.$set(e.item,"fecha_inicio",t)},expression:"item.fecha_inicio"}}),e._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:r.length,expression:"errors.length"}],staticClass:"invalid-feedback",staticStyle:{display:"block"}},[e._v("\n                  "+e._s(r[0])+"\n                ")])],1)]}}],null,!0)})],1),e._v(" "),n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{vid:"target_fecha_final",rules:"required",name:"Fecha Fin"},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.valid,r=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Fecha Final:"}},[n("date-picker",{class:r[0]?"is-invalid":o?"is-valid":"",attrs:{"first-day-of-week":1,lang:"es",format:"YYYY-MM-DD",valueType:"format"},model:{value:e.item.fecha_final,callback:function(t){e.$set(e.item,"fecha_final",t)},expression:"item.fecha_final"}}),e._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:r.length,expression:"errors.length"}],staticClass:"invalid-feedback",staticStyle:{display:"block"}},[e._v("\n                  "+e._s(r[0])+"\n                ")])],1)]}}],null,!0)})],1)])])]}}])})],1)],1)}),[],!1,null,null,null);t.default=component.exports},645:function(e,t,n){"use strict";n.r(t);n(15);var o=n(586),r=(n(587),n(588),{components:{DatePicker:o.default},props:{title:{type:String,default:"Editar Convocatoria"}},data:function(){return{modalId:"modal-edit",openModalEvent:"open-edit-modal",refreshTableEvent:"refresh-table",apiUrlPartial:"/convocatorias/",msgSuccess:"Convocatoria actualizada exitosamente!!!",isProcessing:!1,item:{id:null,nombre:"",activo:!1,fecha_inicio:"",fecha_final:""}}},created:function(){var e=this;this.$nuxt.$on(this.openModalEvent,(function(t){e.setItemValues(t),e.showModal()}))},beforeDestroy:function(){this.$nuxt.$off(this.openModalEvent)},computed:{apiUrl:function(){return this.apiUrlPartial+this.item.id}},methods:{refreshTable:function(){this.$nuxt.$emit(this.refreshTableEvent)},showModal:function(){this.$bvModal.show(this.modalId)},hideModal:function(){this.$bvModal.hide(this.modalId)},resetModal:function(){this.resetFormValues()},setItemValues:function(e){this.item.id=e.id,this.item.nombre=e.nombre,this.item.activo=e.activo,this.item.fecha_inicio=e.fecha_inicio,this.item.fecha_final=e.fecha_final},resetFormValues:function(){this.item.id="",this.item.nombre="",this.item.activo=!1,this.item.fecha_inicio="",this.item.fecha_final="",this.isProcessing=!1},handleOk:function(e){e.preventDefault(),this.onSubmit()},onSubmit:function(){var e=this;this.item.id&&this.$refs.form.validate().then((function(t){t&&(e.isProcessing=!0,e.$axios.put(e.apiUrl,e.item).then((function(t){e.$notify({type:"success",text:e.msgSuccess})})).finally((function(){e.refreshTable(),e.hideModal()})))}))}}}),l=n(12),component=Object(l.a)(r,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("b-modal",{attrs:{id:e.modalId,title:e.title,size:"lg"},on:{ok:e.handleOk,hidden:e.resetModal},scopedSlots:e._u([{key:"modal-footer",fn:function(t){var o=t.ok,r=t.cancel;return[n("b-button",{attrs:{size:"md",variant:"link"},on:{click:function(e){return r()}}},[e._v(" Cancelar")]),e._v(" "),n("b-button",{attrs:{type:"submit",size:"md",variant:"primary",disabled:e.isProcessing},on:{click:function(e){return o()}}},[n("span",{directives:[{name:"show",rawName:"v-show",value:e.isProcessing,expression:"isProcessing"}],staticClass:"spinner-border spinner-border-sm"}),e._v(" "),n("i",{directives:[{name:"show",rawName:"v-show",value:!e.isProcessing,expression:"!isProcessing"}],staticClass:"fas fa-edit"}),e._v(" Actualizar\n      ")])]}}])},[n("ValidationObserver",{ref:"form",on:{submit:function(e){e.preventDefault()}},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.handleSubmit;return[n("b-form",{on:{submit:function(t){return t.preventDefault(),o(e.onSubmit)}}},[n("div",{staticClass:"row"},[n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{mode:"eager",rules:"required|alpha_num_spaces",name:"Nombre"},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.validated,r=t.valid,l=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Nombre:"}},[n("b-form-input",{attrs:{type:"text",state:!(!o||!r)||!l[0]&&null},model:{value:e.item.nombre,callback:function(t){e.$set(e.item,"nombre",t)},expression:"item.nombre"}}),e._v(" "),n("b-form-invalid-feedback",[e._v(e._s(l[0]))])],1)]}}],null,!0)})],1),e._v(" "),n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{name:"Activo"},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.valid,r=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Activo:"}},[n("b-form-checkbox",{attrs:{value:"true","unchecked-value":"false",state:!r[0]&&(!!o||null)},model:{value:e.item.activo,callback:function(t){e.$set(e.item,"activo",t)},expression:"item.activo"}}),e._v(" "),n("b-form-invalid-feedback",[e._v(e._s(r[0]))])],1)]}}],null,!0)})],1)]),e._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{mode:"eager",rules:"required|before_or_equal:@target_fecha_final",name:"Fecha Inicio"},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.validated,r=t.valid,l=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Fecha Inicio:"}},[n("date-picker",{class:o&&r?"is-valid":l[0]?"is-invalid":"",attrs:{"first-day-of-week":1,lang:"es",format:"YYYY-MM-DD",valueType:"format"},model:{value:e.item.fecha_inicio,callback:function(t){e.$set(e.item,"fecha_inicio",t)},expression:"item.fecha_inicio"}}),e._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:l.length,expression:"errors.length"}],staticClass:"invalid-feedback",staticStyle:{display:"block"}},[e._v("\n                  "+e._s(l[0])+"\n                ")])],1)]}}],null,!0)})],1),e._v(" "),n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{mode:"eager",vid:"target_fecha_final",rules:"required",name:"Fecha Fin"},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.validated,r=t.valid,l=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Fecha Final:"}},[n("date-picker",{class:o&&r?"is-valid":l[0]?"is-invalid":"",attrs:{"first-day-of-week":1,lang:"es",format:"YYYY-MM-DD",valueType:"format"},model:{value:e.item.fecha_final,callback:function(t){e.$set(e.item,"fecha_final",t)},expression:"item.fecha_final"}}),e._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:l.length,expression:"errors.length"}],staticClass:"invalid-feedback",staticStyle:{display:"block"}},[e._v("\n                  "+e._s(l[0])+"\n                ")])],1)]}}],null,!0)})],1)])])]}}])})],1)],1)}),[],!1,null,null,null);t.default=component.exports},646:function(e,t,n){"use strict";n.r(t);n(15);var o={props:{title:{type:String,default:"Eliminar Convocatoria"}},data:function(){return{modalId:"modal-delete",openModalEvent:"open-delete-modal",refreshTableEvent:"refresh-table",apiUrlPartial:"/convocatorias/",msgSuccess:"Convocatoria eliminada exitosamente!!!",isProcessing:!1,item:{id:null,text:""}}},created:function(){var e=this;this.$nuxt.$on(this.openModalEvent,(function(t){e.setItemValues(t),e.showModal()}))},beforeDestroy:function(){this.$nuxt.$off(this.openModalEvent)},computed:{apiUrl:function(){return this.apiUrlPartial+this.item.id}},methods:{refreshTable:function(){this.$nuxt.$emit(this.refreshTableEvent)},showModal:function(){this.$bvModal.show(this.modalId)},hideModal:function(){this.$bvModal.hide(this.modalId),this.resetFormValues()},setItemValues:function(e){this.item.id=e.id,this.item.text=e.nombre},resetFormValues:function(){this.item.id=null,this.item.text="",this.isProcessing=!1},handleOk:function(e){e.preventDefault(),this.onSubmit()},onSubmit:function(){var e=this;this.item.id&&(this.isProcessing=!0,this.$axios.delete(this.apiUrl).then((function(t){e.$notify({type:"success",text:e.msgSuccess})})).finally((function(){e.refreshTable(),e.hideModal()})))}}},r=n(12),component=Object(r.a)(o,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("b-modal",{attrs:{id:e.modalId,title:e.title},on:{ok:e.handleOk,hidden:e.hideModal},scopedSlots:e._u([{key:"modal-footer",fn:function(t){var o=t.ok,r=t.cancel;return[n("b-button",{attrs:{size:"md",variant:"link"},on:{click:function(e){return r()}}},[e._v(" Cancelar ")]),e._v(" "),n("b-button",{attrs:{type:"submit",size:"md",variant:"danger",disabled:e.isProcessing},on:{click:function(e){return o()}}},[n("span",{directives:[{name:"show",rawName:"v-show",value:e.isProcessing,expression:"isProcessing"}],staticClass:"spinner-border spinner-border-sm"}),e._v("\n        Eliminar\n      ")])]}}])},[n("p",[e._v("¿Está seguro que desea eliminar este registro?")]),e._v(" "),n("p",[n("b",[e._v(e._s(e.item.text))])])])],1)}),[],!1,null,null,null);t.default=component.exports},732:function(e,t,n){"use strict";n.r(t);n(1);var o={layout:"vertical",head:function(){return{title:"".concat(this.title," | CENEPRED")}},data:function(){var e="Lista de Convocatorias";return{title:e,items:[{text:"Admin"},{text:"Mantenimiento"},{text:e,active:!0}],urlTableData:"/convocatorias",tableData:this.getItems,isBusy:!1,totalRows:1,currentPage:1,perPage:10,pageOptions:[10,25,50,100],filter:"",sortDesc:!1,sortBy:"fecha_inicio",fields:[{key:"nombre",label:"Nombre",sortable:!0},{label:"Fecha Inicial",key:"fecha_inicio",sortable:!0,visible:!0,class:"bs-date-col"},{label:"Fecha Final",key:"fecha_final",sortable:!0,visible:!0,class:"bs-date-col"},{label:"Activo",key:"activo_format",sortable:!1,visible:!0,class:"bs-date-col"},{key:"opciones",sortable:!1,class:"bs-option-col",thClass:"bs-option-col-header"}]}},created:function(){var e=this;this.$nuxt.$on("refresh-table",(function(){e.refreshTable()}))},beforeDestroy:function(){this.$nuxt.$off("refresh-table")},methods:{requestDeleteItem:function(e){this.$nuxt.$emit("open-delete-modal",e)},requestEditItem:function(e){this.$nuxt.$emit("open-edit-modal",e)},requestAddItem:function(){this.$nuxt.$emit("open-add-modal")},refreshTable:function(){this.$refs.table.refresh()},getItems:function(e){var t=this,n=this.filtersTable(e);return this.$axios.get(this.urlTableData+n).then((function(e){var n=e.data.data;return t.currentPage=e.data.meta.current_page,t.totalRows=e.data.meta.total,t.isBusy=!1,n})).catch((function(e){return t.isBusy=!1,[]}))},filtersTable:function(e){var t=e.sortDesc?"DESC":"ASC",n="?page=".concat(e.currentPage);return n+="&per_page=".concat(e.perPage),n+="&nombre=".concat(e.filter),n+="&sortBy=".concat(e.sortBy),n+="&direction=".concat(t)}},middleware:"us-admin"},r=n(12),component=Object(r.a)(o,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("PageHeader",{attrs:{title:e.title,items:e.items}}),e._v(" "),n("GeneralConvocatoriaAddModal"),e._v(" "),n("GeneralConvocatoriaEditModal"),e._v(" "),n("GeneralConvocatoriaDeleteModal"),e._v(" "),n("div",{staticClass:"row mx-4"},[n("div",{staticClass:"col-12"},[n("div",{staticClass:"card"},[n("div",{staticClass:"card-header"},[n("h2",{staticClass:"card-title"},[e._v("Listado de convocatorias")]),e._v(" "),n("div",{directives:[{name:"permission",rawName:"v-permission",value:"CONVOCATORIA_CREATE",expression:"'CONVOCATORIA_CREATE'"}],staticClass:"card-options"},[n("b-button",{staticClass:"w-sm",attrs:{size:"sm",variant:"success"},on:{click:function(t){return e.requestAddItem()}}},[n("i",{staticClass:"fa fa-fw fa-plus"}),e._v(" Agregar\n            ")])],1)]),e._v(" "),n("div",{staticClass:"card-body"},[n("div",{staticClass:"row mt-4"},[n("div",{staticClass:"col-sm-12 col-md-6"},[n("div",{staticClass:"dataTables_length",attrs:{id:"tickets-table_length"}},[n("label",{staticClass:"d-inline-flex align-items-center"},[e._v("\n                  Mostrar \n                  "),n("b-form-select",{attrs:{size:"sm",options:e.pageOptions},model:{value:e.perPage,callback:function(t){e.perPage=t},expression:"perPage"}}),e._v("\n                   registros\n                ")],1)])]),e._v(" "),n("div",{staticClass:"col-sm-12 col-md-6"},[n("div",{staticClass:"dataTables_filter text-md-end",attrs:{id:"tickets-table_filter"}},[n("label",{staticClass:"d-inline-flex align-items-center"},[e._v("\n                  Buscar: \n                  "),n("b-form-input",{staticClass:"form-control form-control-sm ml-2",attrs:{type:"search"},model:{value:e.filter,callback:function(t){e.filter=t},expression:"filter"}})],1)])])]),e._v(" "),n("div",{staticClass:"table-responsive mb-0"},[n("b-table",{ref:"table",class:"table-nowrap",attrs:{responsive:"sm",busy:e.isBusy,items:e.tableData,fields:e.fields,"per-page":e.perPage,"current-page":e.currentPage,"sort-by":e.sortBy,"sort-desc":e.sortDesc,filter:e.filter,striped:"","show-empty":""},on:{"update:busy":function(t){e.isBusy=t},"update:sortBy":function(t){e.sortBy=t},"update:sort-by":function(t){e.sortBy=t},"update:sortDesc":function(t){e.sortDesc=t},"update:sort-desc":function(t){e.sortDesc=t}},scopedSlots:e._u([{key:"empty",fn:function(){return[n("p",{staticClass:"text-center"},[e._v("No hay registros para mostrar")])]},proxy:!0},{key:"cell(activo_format)",fn:function(data){return[1==data.item.activo?[n("i",{staticClass:"uil uil-check-circle"})]:e._e()]}},{key:"cell(opciones)",fn:function(data){return[n("ul",{staticClass:"list-inline two-options mb-0"},[n("li",{directives:[{name:"permission",rawName:"v-permission",value:"CONVOCATORIA_DESTROY",expression:"'CONVOCATORIA_DESTROY'"}],staticClass:"list-inline-item"},[n("a",{directives:[{name:"b-tooltip",rawName:"v-b-tooltip.hover",modifiers:{hover:!0}}],staticClass:"px-1 text-primary",attrs:{href:"javascript:void(0);",title:"Editar"},on:{click:function(t){return e.requestEditItem(data.item)}}},[n("i",{staticClass:"uil uil-pen font-size-18"})])]),e._v(" "),n("li",{directives:[{name:"permission",rawName:"v-permission",value:"CONVOCATORIA_EDIT",expression:"'CONVOCATORIA_EDIT'"}],staticClass:"list-inline-item"},[n("a",{directives:[{name:"b-tooltip",rawName:"v-b-tooltip.hover",modifiers:{hover:!0}}],staticClass:"px-1 text-danger",attrs:{href:"javascript:void(0);",title:"Eliminar"},on:{click:function(t){return e.requestDeleteItem(data.item)}}},[n("i",{staticClass:"uil uil-trash-alt font-size-18"})])])])]}}])})],1),e._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col"},[n("div",{staticClass:"dataTables_paginate paging_simple_numbers float-end"},[n("ul",{staticClass:"pagination pagination-rounded mb-0"},[n("b-pagination",{attrs:{"total-rows":e.totalRows,"per-page":e.perPage},model:{value:e.currentPage,callback:function(t){e.currentPage=t},expression:"currentPage"}})],1)])])])])])])])],1)}),[],!1,null,null,null);t.default=component.exports;installComponents(component,{PageHeader:n(585).default,GeneralConvocatoriaAddModal:n(644).default,GeneralConvocatoriaEditModal:n(645).default,GeneralConvocatoriaDeleteModal:n(646).default})}}]);