<script>
/**
 * Dashboard component
 */
export default {
  layout: 'vertical',
  head() {
    return {
      title: `${this.title} | CENEPRED`
    }
  },
  data() {
    return {
      title: 'Postulación',
      items: [{ text: 'Admin' }, { text: 'Postulación', active: true }],
      urlPostulacion: '/postulacion',
      msgSuccess: 'Postulación enviada exitosamente.',
      listSedes: [],
      sedeSelected: null,
      esta_postulando: false,
      hay_convocatoria_actual: false,
      pageOptionsLoaded: false,
      item: {
        sede_registral_id: '',
        sede_registral: ''
      }
    }
  },
  watch: {
    sedeSelected: function (val) {
      this.item.sede_registral_id = val && val.id ? val.id : null
      this.item.sede_registral = val && val.nombre ? val.nombre : ''
    }
  },
  mounted() {
    this.$bvModal.show('modal-alert')
    this.loadSelectOptions()

    this.$root.$on('bv::modal::hide', (bvEvent, modalId) => {
      if (modalId === 'modal-alert' && bvEvent.trigger !== 'ok') {
        bvEvent.preventDefault()
      }
    })
  },
  methods: {
    resetFormValues() {
      // Resetting Values
      this.sedeSelected = null
    },
    async handleConfirmationOk(bvModalEvt) {
      await this.$axios
        .post(this.urlPostulacion, this.item)
        .then((res) => {
          if (res) {
            this.$notify({ type: 'success', text: this.msgSuccess })
          }
        })
        .catch(function (error) {
          // handle error
        })
        .finally(() => {
          this.$bvModal.hide('modal-confirmation')
          this.resetFormValues()
        })

      await this.$auth.fetchUser()
    },
    handleAlertOk(bvModalEvt) {
      this.$bvModal.hide('modal-alert')
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
        this.$bvModal.show('modal-confirmation')
      })
    },
    async loadSelectOptions() {
      await this.$axios.get('/listasParaPostulacion').then((res) => {
        this.listSedes = (res && res.data.sedes_registrales) || []
        this.esta_postulando = (res && res.data.esta_postulando) || []
        this.hay_convocatoria_actual = (res && res.data.hay_convocatoria_actual) || []
        this.pageOptionsLoaded = true
      })
    }
  }
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />

    <b-modal id="modal-alert" title="Aviso!!!" @ok="handleAlertOk">
      <b-alert variant="warning" show>
        <p>
          Asegurese de ingresar todos sus <b>datos personales</b> y adjuntar todos los <b>documentos solicitados</b>,
          una vez que presione el botón postular ya no podrá modificar su información,
          <b>no podrá editar su curriculum vitae.</b>
        </p>
      </b-alert>
      <template #modal-footer="{ ok }">
        <b-button type="submit" size="md" variant="warning" @click="ok()">
          <i class="far fa-thumbs-up"></i> Entiendo
        </b-button>
      </template>
    </b-modal>

    <b-modal id="modal-confirmation" title="Confirmación" @ok="handleConfirmationOk">
      <p>¿Está seguro que desea postular a esta sede?</p>
      <p>
        <b>{{ item.sede_registral }}</b>
      </p>
      <template #modal-footer="{ ok, cancel }">
        <b-button size="md" variant="link" @click="cancel()"> Cancelar </b-button>
        <b-button type="submit" size="md" variant="primary" @click="ok()">
          <i class="far fa-thumbs-up"></i> Confirmo
        </b-button>
      </template>
    </b-modal>

    <div class="row mx-lg-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Postular</h2>
          </div>
          <div class="card-body">
            <div v-if="pageOptionsLoaded">
              <div class="row mt-2" v-if="hay_convocatoria_actual && !$auth.user.esta_postulando">
                <div class="col-md-12 col-xl-5">
                  <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
                    <b-form @submit.prevent="handleSubmit(onSubmit)">
                      <ValidationProvider rules="required" name="Sede" v-slot="{ valid, errors }">
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
                      <div class="float-end">
                        <b-button type="submit" size="md" variant="primary">
                          <i class="fas fa-paper-plane"></i> Postular
                        </b-button>
                      </div>
                    </b-form>
                  </ValidationObserver>
                </div>
                <div class="col-md-12 col-xl-5">
                  <b-alert variant="warning" show class="m-0">
                    <p class="m-0">
                      Asegurese de ingresar todos sus <b>datos personales</b> y adjuntar todos los
                      <b>documentos solicitados</b>, una vez que presione el botón postular ya no podrá modificar su
                      información,
                      <b>no podrá editar su curriculum vitae.</b>
                    </p>
                  </b-alert>
                </div>
              </div>
              <div class="row" v-if="$auth.user.esta_postulando && !$auth.user.esta_acreditado">
                <div class="col-md-12 col-xl-5">
                  <b-alert variant="warning" show class="m-0">
                    <p class="m-0"><b>Ud. se encuentra postulando a una convocatoria.</b></p>
                  </b-alert>
                </div>
              </div>
              <div class="row" v-if="$auth.user.esta_postulando && $auth.user.esta_acreditado">
                <div class="col-md-12 col-xl-5">
                  <b-alert variant="success" show class="m-0">
                    <p class="m-0"><b> Ud. esta acreditado. </b></p>
                    Esté atento, CENEPRED le asignará expedientes a verificar
                  </b-alert>
                </div>
              </div>
              <div class="row" v-if="!hay_convocatoria_actual">
                <div class="col-md-12 col-xl-5">
                  <b-alert variant="warning" show class="m-0">
                    <p class="m-0"><b>No hay convocatorias abiertas por el momento.</b></p>
                  </b-alert>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="alert alert-info m-0">
              Si desea realizar alguna consulta comuníquese con nosotros:
              <br /><br />
              <i class="far fa-envelope"></i>
              <a class="text-decoration" href="mailto:SoporteAdHoc@cenepred.gob.pe">SoporteAdHoc@cenepred.gob.pe</a>
              <br />
              <i class="fas fa-phone"></i>
              <a class="text-decoration" href="tel:01 2013550">(+51) 2013550</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style></style>
