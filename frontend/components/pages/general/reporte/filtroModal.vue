<script>
import DatePicker from 'vue2-datepicker'
import 'vue2-datepicker/index.css'
import 'vue2-datepicker/locale/es'

export default {
  components: {
    DatePicker
  },
  props: {
    title: {
      type: String,
      default: 'Descargar Reporte'
    }
  },
  data() {
    return {
      modalId: 'modal-add',
      openModalEvent: 'open-reporte-modal',
      refreshTableEvent: 'refresh-table',
      isExcel: true,
      isPdf: false,
      isDownloading: false,
      item: {
        id: null,
        nombre: '',
        link: ''
      },
      listSedes: [],
      sedeSelected: null
    }
  },
  mounted() {
    this.loadSelectOptions()
  },
  created() {
    this.$nuxt.$on(this.openModalEvent, (item) => {
      this.setItemValues(item)
      this.showModal()
    })
  },
  beforeDestroy() {
    this.$nuxt.$off(this.openModalEvent)
  },
  methods: {
    refreshTable() {
      this.$nuxt.$emit(this.refreshTableEvent)
    },
    showModal() {
      this.$bvModal.show(this.modalId)
    },
    hideModal() {
      this.$bvModal.hide(this.modalId)
    },
    resetModal() {
      this.resetFormValues()
    },
    setItemValues(item) {
      this.item.id = item.id
      this.item.nombre = item.nombre
      this.item.link = item.link
    },
    resetFormValues() {
      // Resetting Values
      this.item.id = ''
      this.item.nombre = ''
      this.item.link = ''
      this.sedeSelected = null
    },
    handleOk(bvModalEvt) {
      bvModalEvt.preventDefault()
      this.onSubmit()
    },
    onSubmit() {
      this.$refs.form.validate().then((success) => {
        if (!success) {
          return
        }

        this.isDownloading = true
        let excel = this.isExcel ? 'excel=true' : ''
        let pdf = this.isPdf ? 'pdf=true' : ''
        let url = this.$config.reportebaseurl + this.item.link + '?' + excel + pdf
        let title = `reporte-${new Date().getTime()}`

        this.$downloadUrl(url, title, '.xlsx')

        this.$nextTick(() => {
          this.isDownloading = false
          this.hideModal()
        })
      })
    },
    async loadSelectOptions() {
      await this.$axios.get('/listasParaPostulantesAdhoc').then((res) => {
        this.listSedes = res && res.data.sedes_registrales
      })
    }
  }
}
</script>

<template>
  <div>
    <b-modal :id="modalId" :title="title" @ok="handleOk" @hidden="resetModal">
      <p class="text-primary">
        <b>{{ item.nombre }}</b>
      </p>
      <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
        <b-form @submit.prevent="handleSubmit(onSubmit)">
          <ValidationProvider  name="Sede" v-slot="{ valid, errors }">
            <b-form-group label="Sede Regitral:" class="mb-3">
              <multiselect-c
                :options="listSedes"
                v-model="sedeSelected"
                label="nombre"
                track-by="id"
                :class="errors[0] ? `is-invalid` : valid ? `is-valid` : ``"
                placeholder="Elija una sede regitral"
              >
                <span slot="noResult">Oops! No se encontraron elementos.</span>
              </multiselect-c>
              <div class="invalid-feedback" style="display: block" v-show="errors.length">
                {{ errors[0] }}
              </div>
            </b-form-group>
          </ValidationProvider>
        </b-form>
      </ValidationObserver>
      <template #modal-footer="{ ok, cancel }">
        <b-button size="md" variant="link" @click="cancel()" :disabled="isDownloading"> Cancelar</b-button>
        <b-button type="submit" size="md" variant="primary" @click="ok()" :disabled="isDownloading">
          <span v-if="isDownloading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          <i v-else class="fas fa-download"></i> Descargar
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
