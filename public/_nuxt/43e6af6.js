(window.webpackJsonp=window.webpackJsonp||[]).push([[39],{596:function(t,e,n){"use strict";n.r(e);var o={props:{items:{type:Array,default:function(){return[]}}},data:function(){return{tableData:this.items,totalRows:this.items.length,currentPage:1,perPage:5,sortDesc:!1,sortBy:"fecha_inicio",fields:[{label:"Institución",key:"institucion",sortable:!0},{label:"F. Inicio",key:"fecha_inicio",sortable:!0,class:"bs-date-col"},{label:"F. Fin",key:"fecha_fin",sortable:!0,class:"bs-date-col"},{label:"Constancia",key:"archivo_constancia",sortable:!1,class:"bs-date-col"}]}}},r=n(12),component=Object(r.a)(o,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("div",{staticClass:"table-responsive mb-0"},[n("b-table",{ref:"table",class:"table-nowrap",attrs:{responsive:"true",items:t.tableData,fields:t.fields,"per-page":t.perPage,"current-page":t.currentPage,"sort-by":t.sortBy,"sort-desc":t.sortDesc,striped:"",borderless:""},on:{"update:sortBy":function(e){t.sortBy=e},"update:sort-by":function(e){t.sortBy=e},"update:sortDesc":function(e){t.sortDesc=e},"update:sort-desc":function(e){t.sortDesc=e}},scopedSlots:t._u([{key:"cell(archivo_constancia)",fn:function(data){return[n("a",{staticClass:"text-decoration",attrs:{href:"javascript:void(0);"},on:{click:function(e){return e.stopPropagation(),t.$downloadFile(data.value)}}},[n("i",{staticClass:"uil uil-file-info-alt font-size-18"}),t._v(" Archivo adjunto\n        ")])]}}])})],1),t._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col"},[n("div",{staticClass:"dataTables_paginate paging_simple_numbers float-end"},[n("ul",{staticClass:"pagination pagination-rounded mb-0"},[n("b-pagination",{attrs:{"total-rows":t.totalRows,"per-page":t.perPage},model:{value:t.currentPage,callback:function(e){t.currentPage=e},expression:"currentPage"}})],1)])])])])}),[],!1,null,null,null);e.default=component.exports}}]);