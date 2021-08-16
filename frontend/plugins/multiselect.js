import Vue from 'vue'
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'

Vue.component('multiselect-c', {
  mixins: [Multiselect],
  props: {
    selectLabel: {
      default: 'Presiona enter para elejir'
    },
    deselectLabel: {
      default: 'Presiona enter para eliminar'
    },
    selectedLabel: {
      default: 'Seleccionado'
    },
    noOptionsLabel: {
      default: 'Seleccionado'
    },
    placeholder: {
      default: 'Por favor, seleccione...'
    }
  }
})
