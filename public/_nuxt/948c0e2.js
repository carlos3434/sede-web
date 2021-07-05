(window.webpackJsonp=window.webpackJsonp||[]).push([[9],{524:function(t,e,n){"use strict";n.r(e);var o=n(26),l=(n(69),n(15),n(79),n(477)),r=(n(478),n(479),{components:{DatePicker:l.default},props:{title:{type:String,default:"Editar Capacitación"}},data:function(){return{modalId:"modal-edit",openModalEvent:"open-edit-modal",refreshTableEvent:"refresh-table",apiUrlPartial:"/capacitaciones/",msgSuccess:"Capacitación actualizada exitosamente!!!",item:{id:null,nombre:"",fecha_inicio:"",fecha_termino:"",horas_lectivas:"",ciudad:"",tipo_capacitacion_id:"",institucion_id:"",certificado:null,certificado_anterior:null},institucionSelected:null,tipoCapacitacionSelected:null,listInstituciones:[],listTipoCapacitacion:[],isNewFile:!1}},watch:{institucionSelected:function(t){this.item.institucion_id=t&&t.id?t.id:null},tipoCapacitacionSelected:function(t){this.item.tipo_capacitacion_id=t&&t.id?t.id:null}},computed:{apiUrl:function(){return this.apiUrlPartial+this.item.id}},mounted:function(){this.loadSelectOptions()},created:function(){var t=this;this.$nuxt.$on(this.openModalEvent,(function(e){t.setItemValues(e),t.showModal()}))},beforeDestroy:function(){this.$nuxt.$off(this.openModalEvent)},methods:{refreshTable:function(){this.$nuxt.$emit(this.refreshTableEvent)},showModal:function(){this.$bvModal.show(this.modalId)},hideModal:function(){this.$bvModal.hide(this.modalId)},resetmodal:function(){this.resetFormValues()},showNotification:function(t,e){this.$notify({group:"noti",type:t,text:e})},setItemValues:function(t){this.item.id=t.id,this.item.nombre=t.nombre,this.item.fecha_inicio=t.fecha_inicio,this.item.fecha_termino=t.fecha_termino,this.item.horas_lectivas=t.horas_lectivas,this.item.ciudad=t.ciudad,this.item.tipo_capacitacion_id=t.tipo_capacitacion_id,this.item.institucion_id=t.institucion_id,this.item.certificado_anterior=t.certificado,this.setSelectedOptions()},resetFormValues:function(){this.item.id="",this.item.nombre="",this.item.fecha_inicio="",this.item.fecha_termino="",this.item.horas_lectivas="",this.item.ciudad="",this.item.tipo_capacitacion_id="",this.item.institucion_id="",this.item.certificado=null,this.institucionSelected=null,this.tipoCapacitacionSelected=null,this.isNewFile=!1},handleOk:function(t){t.preventDefault(),this.onSubmit()},onSubmit:function(){var t=this;this.$refs.form.validate().then((function(e){if(e){var data=new FormData;for(var n in data.append("_method","put"),t.item)t.item[n]&&data.append(n,t.item[n]);t.$axios.post(t.apiUrl,data).then((function(e){t.showNotification("success",t.msgSuccess)})).finally((function(){t.refreshTable(),t.hideModal()}))}}))},setSelectedOptions:function(){var t=this;this.institucionSelected=this.listInstituciones.find((function(i){return i.id==t.item.institucion_id})),this.tipoCapacitacionSelected=this.listTipoCapacitacion.find((function(i){return i.id==t.item.tipo_capacitacion_id}))},loadSelectOptions:function(){var t=this;return Object(o.a)(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,t.$axios.get("/listasParaCapacitacion").then((function(e){t.listInstituciones=e.data.institutiones||[],t.listTipoCapacitacion=e.data.tipo_capacitacion||[]}));case 2:case"end":return e.stop()}}),e)})))()},handleFileChange:function(t){var e=t.target.files||t.dataTransfer.files;e.length&&(this.item.certificado=e[0])},requestChangeFile:function(){this.isNewFile=!this.isNewFile}}}),c=n(12),component=Object(c.a)(r,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("b-modal",{attrs:{id:t.modalId,title:t.title,size:"lg"},on:{ok:t.handleOk,hidden:t.resetmodal},scopedSlots:t._u([{key:"modal-footer",fn:function(e){var o=e.ok,l=e.cancel;return[n("b-button",{attrs:{size:"md",variant:"link"},on:{click:function(t){return l()}}},[t._v(" Cancelar")]),t._v(" "),n("b-button",{attrs:{type:"submit",size:"md",variant:"primary"},on:{click:function(t){return o()}}},[n("i",{staticClass:"fas fa-edit"}),t._v(" Actualizar\n      ")])]}}])},[n("ValidationObserver",{ref:"form",on:{submit:function(t){t.preventDefault()}},scopedSlots:t._u([{key:"default",fn:function(e){var o=e.handleSubmit;return[n("b-form",{on:{submit:function(e){return e.preventDefault(),o(t.onSubmit)}}},[n("ValidationProvider",{attrs:{mode:"eager",rules:"required|alpha_num_spaces",name:"Nombre"},scopedSlots:t._u([{key:"default",fn:function(e){var o=e.validated,l=e.valid,r=e.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Nombre de la capacitación:"}},[n("b-form-input",{attrs:{type:"text",state:!(!o||!l)||!r[0]&&null},model:{value:t.item.nombre,callback:function(e){t.$set(t.item,"nombre",e)},expression:"item.nombre"}}),t._v(" "),n("b-form-invalid-feedback",[t._v(t._s(r[0]))])],1)]}}],null,!0)}),t._v(" "),n("ValidationProvider",{attrs:{rules:"required",name:" "},scopedSlots:t._u([{key:"default",fn:function(e){var o=e.validated,l=e.valid,r=e.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Institución académica:"}},[n("multiselect-c",{class:o&&l?"is-valid":r[0]?"is-invalid":"",attrs:{options:t.listInstituciones,label:"nombre","track-by":"id",placeholder:"Elija un institución académica"},model:{value:t.institucionSelected,callback:function(e){t.institucionSelected=e},expression:"institucionSelected"}},[n("span",{attrs:{slot:"noResult"},slot:"noResult"},[t._v("Oops! No se encontraron elementos.")])]),t._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:r.length,expression:"errors.length"}],staticClass:"invalid-feedback",staticStyle:{display:"block"}},[t._v("\n              "+t._s(r[0])+"\n            ")])],1)]}}],null,!0)}),t._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{rules:"required",name:"Tipo"},scopedSlots:t._u([{key:"default",fn:function(e){var o=e.validated,l=e.valid,r=e.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Tipo de capacitación:"}},[n("multiselect-c",{class:o&&l?"is-valid":r[0]?"is-invalid":"",attrs:{options:t.listTipoCapacitacion,label:"nombre","track-by":"id",placeholder:"Elija tipo de capacitación"},model:{value:t.tipoCapacitacionSelected,callback:function(e){t.tipoCapacitacionSelected=e},expression:"tipoCapacitacionSelected"}},[n("span",{attrs:{slot:"noResult"},slot:"noResult"},[t._v("Oops! No se encontraron elementos.")])]),t._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:r.length,expression:"errors.length"}],staticClass:"invalid-feedback",staticStyle:{display:"block"}},[t._v("\n                  "+t._s(r[0])+"\n                ")])],1)]}}],null,!0)})],1),t._v(" "),n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{mode:"eager",rules:"required|alpha_num_spaces",name:"Ciudad"},scopedSlots:t._u([{key:"default",fn:function(e){var o=e.validated,l=e.valid,r=e.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Ciudad de la capacitación:"}},[n("b-form-input",{attrs:{type:"text",state:!(!o||!l)||!r[0]&&null},model:{value:t.item.ciudad,callback:function(e){t.$set(t.item,"ciudad",e)},expression:"item.ciudad"}}),t._v(" "),n("b-form-invalid-feedback",[t._v(t._s(r[0]))])],1)]}}],null,!0)})],1)]),t._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{mode:"eager",rules:"required|before_or_equal:@target_fecha_final",name:"Fecha Inicio"},scopedSlots:t._u([{key:"default",fn:function(e){var o=e.validated,l=e.valid,r=e.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Fecha Inicio:"}},[n("date-picker",{class:o&&l?"is-valid":r[0]?"is-invalid":"",attrs:{"first-day-of-week":1,lang:"es",format:"YYYY-MM-DD",valueType:"format","disabled-date":function(e){return e>=t.$moment().subtract(1,"days")}},model:{value:t.item.fecha_inicio,callback:function(e){t.$set(t.item,"fecha_inicio",e)},expression:"item.fecha_inicio"}}),t._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:r.length,expression:"errors.length"}],staticClass:"invalid-feedback",staticStyle:{display:"block"}},[t._v("\n                  "+t._s(r[0])+"\n                ")])],1)]}}],null,!0)})],1),t._v(" "),n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{mode:"eager",vid:"target_fecha_final",rules:"required",name:"Fecha Fin"},scopedSlots:t._u([{key:"default",fn:function(e){var o=e.validated,l=e.valid,r=e.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Fecha Final:"}},[n("date-picker",{class:o&&l?"is-valid":r[0]?"is-invalid":"",attrs:{"first-day-of-week":1,lang:"es",format:"YYYY-MM-DD",valueType:"format","disabled-date":function(e){return e>=t.$moment().subtract(1,"days")}},model:{value:t.item.fecha_termino,callback:function(e){t.$set(t.item,"fecha_termino",e)},expression:"item.fecha_termino"}}),t._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:r.length,expression:"errors.length"}],staticClass:"invalid-feedback",staticStyle:{display:"block"}},[t._v("\n                  "+t._s(r[0])+"\n                ")])],1)]}}],null,!0)})],1)]),t._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{rules:"required|numeric|integer",name:"Horas"},scopedSlots:t._u([{key:"default",fn:function(e){var o=e.validated,l=e.valid,r=e.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Horas lectivas"}},[n("b-form-input",{attrs:{type:"number",state:!(!o||!l)||!r[0]&&null},model:{value:t.item.horas_lectivas,callback:function(e){t.$set(t.item,"horas_lectivas",e)},expression:"item.horas_lectivas"}}),t._v(" "),n("b-form-invalid-feedback",[t._v(t._s(r[0]))])],1)]}}],null,!0)})],1),t._v(" "),n("div",{staticClass:"col-6"},[t.isNewFile?[n("ValidationProvider",{attrs:{mode:"eager",rules:"required|ext:pdf|size:3072",name:"Archivo"},scopedSlots:t._u([{key:"default",fn:function(e){var o=e.validate,l=e.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Certificado.PDF:"}},[n("input",{staticClass:"form-control",attrs:{type:"file"},on:{change:function(e){t.handleFileChange(e)||o(e)}}}),t._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:l.length,expression:"errors.length"}],staticClass:"invalid-feedback",staticStyle:{display:"block"}},[t._v("\n                    "+t._s(l[0])+"\n                  ")])])]}}],null,!0)})]:[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Certificado.PDF:"}},[n("a",{staticClass:"text-decoration",attrs:{href:t.$config.filebaseurl+t.item.certificado_anterior,target:"_blank"}},[n("i",{staticClass:"uil uil-file-info-alt font-size-18"}),t._v(" Archivo adjunto\n                ")]),t._v(" "),n("button",{directives:[{name:"b-tooltip",rawName:"v-b-tooltip.hover",modifiers:{hover:!0}}],staticClass:"btn btn-outline-danger btn-sm",staticStyle:{"margin-left":"20px"},attrs:{type:"button",title:"Subir nuevo Archivo"},on:{click:t.requestChangeFile}},[t._v("\n                  Cambiar\n                ")])])]],2)])],1)]}}])})],1)],1)}),[],!1,null,null,null);e.default=component.exports}}]);