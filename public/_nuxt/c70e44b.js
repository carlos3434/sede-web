(window.webpackJsonp=window.webpackJsonp||[]).push([[45],{645:function(e,t,n){"use strict";n.r(t);n(15);var o=n(586),r=(n(587),n(588),{components:{DatePicker:o.default},props:{title:{type:String,default:"Editar Convocatoria"}},data:function(){return{modalId:"modal-edit",openModalEvent:"open-edit-modal",refreshTableEvent:"refresh-table",apiUrlPartial:"/convocatorias/",msgSuccess:"Convocatoria actualizada exitosamente!!!",isProcessing:!1,item:{id:null,nombre:"",activo:!1,fecha_inicio:"",fecha_final:""}}},created:function(){var e=this;this.$nuxt.$on(this.openModalEvent,(function(t){e.setItemValues(t),e.showModal()}))},beforeDestroy:function(){this.$nuxt.$off(this.openModalEvent)},computed:{apiUrl:function(){return this.apiUrlPartial+this.item.id}},methods:{refreshTable:function(){this.$nuxt.$emit(this.refreshTableEvent)},showModal:function(){this.$bvModal.show(this.modalId)},hideModal:function(){this.$bvModal.hide(this.modalId)},resetModal:function(){this.resetFormValues()},setItemValues:function(e){this.item.id=e.id,this.item.nombre=e.nombre,this.item.activo=e.activo,this.item.fecha_inicio=e.fecha_inicio,this.item.fecha_final=e.fecha_final},resetFormValues:function(){this.item.id="",this.item.nombre="",this.item.activo=!1,this.item.fecha_inicio="",this.item.fecha_final="",this.isProcessing=!1},handleOk:function(e){e.preventDefault(),this.onSubmit()},onSubmit:function(){var e=this;this.item.id&&this.$refs.form.validate().then((function(t){t&&(e.isProcessing=!0,e.$axios.put(e.apiUrl,e.item).then((function(t){e.$notify({type:"success",text:e.msgSuccess})})).finally((function(){e.refreshTable(),e.hideModal()})))}))}}}),l=n(12),component=Object(l.a)(r,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("b-modal",{attrs:{id:e.modalId,title:e.title,size:"lg"},on:{ok:e.handleOk,hidden:e.resetModal},scopedSlots:e._u([{key:"modal-footer",fn:function(t){var o=t.ok,r=t.cancel;return[n("b-button",{attrs:{size:"md",variant:"link"},on:{click:function(e){return r()}}},[e._v(" Cancelar")]),e._v(" "),n("b-button",{attrs:{type:"submit",size:"md",variant:"primary",disabled:e.isProcessing},on:{click:function(e){return o()}}},[n("span",{directives:[{name:"show",rawName:"v-show",value:e.isProcessing,expression:"isProcessing"}],staticClass:"spinner-border spinner-border-sm"}),e._v(" "),n("i",{directives:[{name:"show",rawName:"v-show",value:!e.isProcessing,expression:"!isProcessing"}],staticClass:"fas fa-edit"}),e._v(" Actualizar\n      ")])]}}])},[n("ValidationObserver",{ref:"form",on:{submit:function(e){e.preventDefault()}},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.handleSubmit;return[n("b-form",{on:{submit:function(t){return t.preventDefault(),o(e.onSubmit)}}},[n("div",{staticClass:"row"},[n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{mode:"eager",rules:"required|alpha_num_spaces",name:"Nombre"},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.validated,r=t.valid,l=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Nombre:"}},[n("b-form-input",{attrs:{type:"text",state:!(!o||!r)||!l[0]&&null},model:{value:e.item.nombre,callback:function(t){e.$set(e.item,"nombre",t)},expression:"item.nombre"}}),e._v(" "),n("b-form-invalid-feedback",[e._v(e._s(l[0]))])],1)]}}],null,!0)})],1),e._v(" "),n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{name:"Activo"},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.valid,r=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Activo:"}},[n("b-form-checkbox",{attrs:{value:"true","unchecked-value":"false",state:!r[0]&&(!!o||null)},model:{value:e.item.activo,callback:function(t){e.$set(e.item,"activo",t)},expression:"item.activo"}}),e._v(" "),n("b-form-invalid-feedback",[e._v(e._s(r[0]))])],1)]}}],null,!0)})],1)]),e._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{mode:"eager",rules:"required|before_or_equal:@target_fecha_final",name:"Fecha Inicio"},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.validated,r=t.valid,l=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Fecha Inicio:"}},[n("date-picker",{class:o&&r?"is-valid":l[0]?"is-invalid":"",attrs:{"first-day-of-week":1,lang:"es",format:"YYYY-MM-DD",valueType:"format"},model:{value:e.item.fecha_inicio,callback:function(t){e.$set(e.item,"fecha_inicio",t)},expression:"item.fecha_inicio"}}),e._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:l.length,expression:"errors.length"}],staticClass:"invalid-feedback",staticStyle:{display:"block"}},[e._v("\n                  "+e._s(l[0])+"\n                ")])],1)]}}],null,!0)})],1),e._v(" "),n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{mode:"eager",vid:"target_fecha_final",rules:"required",name:"Fecha Fin"},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.validated,r=t.valid,l=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Fecha Final:"}},[n("date-picker",{class:o&&r?"is-valid":l[0]?"is-invalid":"",attrs:{"first-day-of-week":1,lang:"es",format:"YYYY-MM-DD",valueType:"format"},model:{value:e.item.fecha_final,callback:function(t){e.$set(e.item,"fecha_final",t)},expression:"item.fecha_final"}}),e._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:l.length,expression:"errors.length"}],staticClass:"invalid-feedback",staticStyle:{display:"block"}},[e._v("\n                  "+e._s(l[0])+"\n                ")])],1)]}}],null,!0)})],1)])])]}}])})],1)],1)}),[],!1,null,null,null);t.default=component.exports}}]);