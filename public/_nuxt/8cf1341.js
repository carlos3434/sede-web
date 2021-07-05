(window.webpackJsonp=window.webpackJsonp||[]).push([[19],{535:function(e,t,n){"use strict";n.r(t);var o=n(26),r=(n(69),n(15),n(477)),l=(n(478),n(479),{components:{DatePicker:r.default},props:{title:{type:String,default:"Agregar Verificación Realizada"}},data:function(){return{modalId:"modal-add",openModalEvent:"open-add-modal",refreshTableEvent:"refresh-table",apiUrlPartial:"/verificaciones-realizadas",msgSuccess:"Verificación creada exitosamente!!!",item:{id:null,nro_expediente:"",fecha:"",nro_informe:"",institucion_id:""},institucionSelected:null,listInstituciones:[]}},watch:{institucionSelected:function(e){this.item.institucion_id=e&&e.id?e.id:null}},mounted:function(){this.loadSelectOptions()},created:function(){var e=this;this.$nuxt.$on(this.openModalEvent,(function(){e.showModal()}))},beforeDestroy:function(){this.$nuxt.$off(this.openModalEvent)},methods:{refreshTable:function(){this.$nuxt.$emit(this.refreshTableEvent)},showModal:function(){this.$bvModal.show(this.modalId)},hideModal:function(){this.$bvModal.hide(this.modalId)},resetModal:function(){this.resetFormValues()},showNotification:function(e,t){this.$notify({group:"noti",type:e,text:t})},resetFormValues:function(){this.item.nro_expediente="",this.item.fecha="",this.item.nro_informe="",this.item.institucion_id="",this.institucionSelected=null},handleOk:function(e){e.preventDefault(),this.onSubmit()},onSubmit:function(){var e=this;this.$refs.form.validate().then((function(t){t&&e.$axios.post(e.apiUrlPartial,e.item).then((function(t){e.showNotification("success",e.msgSuccess)})).finally((function(){e.refreshTable(),e.hideModal()}))}))},loadSelectOptions:function(){var e=this;return Object(o.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.$axios.get("/listasParaVerificacionRealizada").then((function(t){e.listInstituciones=t.data.institutiones||[]}));case 2:case"end":return t.stop()}}),t)})))()}}}),c=n(12),component=Object(c.a)(l,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("b-modal",{attrs:{id:e.modalId,title:e.title,size:"lg"},on:{ok:e.handleOk,hidden:e.resetModal},scopedSlots:e._u([{key:"modal-footer",fn:function(t){var o=t.ok,r=t.cancel;return[n("b-button",{attrs:{size:"md",variant:"link"},on:{click:function(e){return r()}}},[e._v(" Cancelar")]),e._v(" "),n("b-button",{attrs:{type:"submit",size:"md",variant:"primary"},on:{click:function(e){return o()}}},[n("i",{staticClass:"fas fa-paper-plane"}),e._v(" Agregar\n      ")])]}}])},[n("ValidationObserver",{ref:"form",on:{submit:function(e){e.preventDefault()}},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.handleSubmit;return[n("b-form",{on:{submit:function(t){return t.preventDefault(),o(e.onSubmit)}}},[n("ValidationProvider",{attrs:{rules:"required",name:" "},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.valid,r=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Gobierno distrital/provincial:"}},[n("multiselect-c",{class:r[0]?"is-invalid":o?"is-valid":"",attrs:{options:e.listInstituciones,label:"nombre","track-by":"id",placeholder:"Elija un gobierno distrital/provincial"},model:{value:e.institucionSelected,callback:function(t){e.institucionSelected=t},expression:"institucionSelected"}},[n("span",{attrs:{slot:"noResult"},slot:"noResult"},[e._v("Oops! No se encontraron elementos.")])]),e._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:r.length,expression:"errors.length"}],staticClass:"invalid-feedback",staticStyle:{display:"block"}},[e._v("\n              "+e._s(r[0])+"\n            ")])],1)]}}],null,!0)}),e._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{rules:"required|alpha_num_spaces",name:"Nro. de Expediente"},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.valid,r=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Número de expediente:"}},[n("b-form-input",{attrs:{type:"text",state:!r[0]&&(!!o||null)},model:{value:e.item.nro_expediente,callback:function(t){e.$set(e.item,"nro_expediente",t)},expression:"item.nro_expediente"}}),e._v(" "),n("b-form-invalid-feedback",[e._v(e._s(r[0]))])],1)]}}],null,!0)})],1),e._v(" "),n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{mode:"eager",rules:"required",name:"Fecha"},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.valid,r=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Fecha de verificación:"}},[n("date-picker",{class:r[0]?"is-invalid":o?"is-valid":"",attrs:{"first-day-of-week":1,lang:"es",format:"YYYY-MM-DD",valueType:"format","disabled-date":function(t){return t>=e.$moment()}},model:{value:e.item.fecha,callback:function(t){e.$set(e.item,"fecha",t)},expression:"item.fecha"}}),e._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:r.length,expression:"errors.length"}],staticClass:"invalid-feedback",staticStyle:{display:"block"}},[e._v("\n                  "+e._s(r[0])+"\n                ")])],1)]}}],null,!0)})],1)]),e._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col-6"},[n("ValidationProvider",{attrs:{rules:"required|alpha_num_spaces",name:"Nro. de Informe"},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.valid,r=t.errors;return[n("b-form-group",{staticClass:"mb-3",attrs:{label:"Número de informe:"}},[n("b-form-input",{attrs:{type:"text",state:!r[0]&&(!!o||null)},model:{value:e.item.nro_informe,callback:function(t){e.$set(e.item,"nro_informe",t)},expression:"item.nro_informe"}}),e._v(" "),n("b-form-invalid-feedback",[e._v(e._s(r[0]))])],1)]}}],null,!0)})],1)])],1)]}}])})],1)],1)}),[],!1,null,null,null);t.default=component.exports}}]);