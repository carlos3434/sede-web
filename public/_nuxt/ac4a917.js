(window.webpackJsonp=window.webpackJsonp||[]).push([[50],{652:function(t,e,n){"use strict";n.r(e);n(15);var o={props:{title:{type:String,default:"Eliminar Institución"}},data:function(){return{modalId:"modal-delete",openModalEvent:"open-delete-modal",refreshTableEvent:"refresh-table",apiUrlPartial:"/instituciones/",msgSuccess:"Institución eliminada exitosamente!!!",isProcessing:!1,item:{id:null,text:""}}},created:function(){var t=this;this.$nuxt.$on(this.openModalEvent,(function(e){t.setItemValues(e),t.showModal()}))},beforeDestroy:function(){this.$nuxt.$off(this.openModalEvent)},computed:{apiUrl:function(){return this.apiUrlPartial+this.item.id}},methods:{refreshTable:function(){this.$nuxt.$emit(this.refreshTableEvent)},showModal:function(){this.$bvModal.show(this.modalId)},hideModal:function(){this.$bvModal.hide(this.modalId),this.resetFormValues()},setItemValues:function(t){this.item.id=t.id,this.item.text=t.nombre},resetFormValues:function(){this.item.id=null,this.item.text="",this.isProcessing=!1},handleOk:function(t){t.preventDefault(),this.onSubmit()},onSubmit:function(){var t=this;this.item.id&&(this.isProcessing=!0,this.$axios.delete(this.apiUrl).then((function(e){t.$notify({type:"success",text:t.msgSuccess})})).finally((function(){t.refreshTable(),t.hideModal()})))}}},r=n(12),component=Object(r.a)(o,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("b-modal",{attrs:{id:t.modalId,title:t.title},on:{ok:t.handleOk,hidden:t.hideModal},scopedSlots:t._u([{key:"modal-footer",fn:function(e){var o=e.ok,r=e.cancel;return[n("b-button",{attrs:{size:"md",variant:"link"},on:{click:function(t){return r()}}},[t._v(" Cancelar ")]),t._v(" "),n("b-button",{attrs:{type:"submit",size:"md",variant:"danger",disabled:t.isProcessing},on:{click:function(t){return o()}}},[n("span",{directives:[{name:"show",rawName:"v-show",value:t.isProcessing,expression:"isProcessing"}],staticClass:"spinner-border spinner-border-sm"}),t._v("\n        Eliminar\n      ")])]}}])},[n("p",[t._v("¿Está seguro que desea eliminar este registro?")]),t._v(" "),n("p",[n("b",[t._v(t._s(t.item.text))])])])],1)}),[],!1,null,null,null);e.default=component.exports}}]);