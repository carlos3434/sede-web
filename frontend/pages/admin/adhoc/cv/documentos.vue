<script>
export default {
  layout: 'vertical',
  head() {
    return {
      title: `${this.title} | CENEPRED`
    }
  },
  data() {
    return {
      title: 'Documentos',
      items: [{ text: 'Admin' }, { text: 'Curriculum Vitae' }, { text: 'Documentos', active: true }],
      msgSuccess: 'Documentos subidos exitosamente!!!',
      url: '/documentos',
      user: [],
      fields: [
        {
          label: 'Opciones',
          key: 'opciones',
          sortable: false,
          visible: true,
          class: 'bs-option-col',
          thClass: 'bs-option-col-header'
        }
      ]
    }
  },
  computed: {
    apiUrl: function () {
      return this.url + '/' + this.user.id
    },
    userEstaPostulando() {
      let u = this.$auth.user.esta_postulando
      this.fields.map((f) => (f.visible = !(f.key === 'opciones' && u)))
      return u
    },
    visibleFields() {
      return this.fields.filter((field) => field.visible)
    }
  },
  mounted() {
    this.getDocumentUser()
  },
  methods: {
    async getDocumentUser(ctx) {
      await this.$axios
        .get(this.url)
        .then((res) => {
          this.user = res.data.data
        })
        .catch((error) => {})
    },
    refreshTable() {
      this.getDocumentUser()
    },
    onSubmit() {
      this.$refs.form.validate().then((success) => {
        if (!success) {
          return
        }
        let data = new FormData()
        data.append('_method', 'PUT')
        for (let key in this.user) {
          if (this.user[key]) {
            data.append(key, this.user[key])
          }
        }
        this.$axios
          .post(this.apiUrl, data)
          .then((res) => {
            this.$notify({ type: 'success', text: this.msgSuccess })
          })
          .finally(() => {
            this.refreshTable()
          })
      })
    },

    handleFileChange(e, name) {
      let files = e.target.files || e.dataTransfer.files
      if (!files.length) return
      this.user[name] = files[0]
    }
  },
  middleware: 'us-adhoc'
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />

    <div class="row mx-lg-4">
      <AdhocCvAlertPostulando :seccion="`sus documentos`"></AdhocCvAlertPostulando>

      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Listado de documentos</h2>
          </div>
          <div class="card-body">
            <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
              <b-form @submit.prevent="handleSubmit(onSubmit)">
                <div class="row mt-2">
                  <div class="col-9">
                    <ValidationProvider
                      rules="required|ext:pdf|size:3072"
                      name="Anexo N° 1"
                      v-slot="{ validate, errors }"
                    >
                      <b-form-group label-cols="6" label="Anexo N° 1 .pdf" class="mb-3">
                        <input
                          v-show="!userEstaPostulando"
                          class="form-control"
                          type="file"
                          @change="handleFileChange($event, 'anexo_1') || validate($event)"
                        />
                        <div class="invalid-feedback" style="display: block" v-show="errors.length">
                          {{ errors[0] }}
                        </div>
                      </b-form-group>
                    </ValidationProvider>
                  </div>
                  <div class="col-3">
                    <a
                      href="javascript:void(0);"
                      class="text-decoration"
                      v-show="user.anexo_1"
                      @click.stop="$downloadFile(user.anexo_1)"
                    >
                      <i class="uil uil-file-info-alt font-size-18"></i> Archivo adjunto
                    </a>
                  </div>
                </div>

                <div class="row mt-2">
                  <div class="col-9">
                    <ValidationProvider
                      rules="required|ext:pdf|size:3072"
                      name="Copia de DNI"
                      v-slot="{ validate, errors }"
                    >
                      <b-form-group
                        label-cols="6"
                        label=" Copia de DNI (documento nacional de identidad) .pdf"
                        class="mb-3"
                      >
                        <input
                          v-show="!userEstaPostulando"
                          class="form-control"
                          type="file"
                          @change="handleFileChange($event, 'copia_dni') || validate($event)"
                        />
                        <div class="invalid-feedback" style="display: block" v-show="errors.length">
                          {{ errors[0] }}
                        </div>
                      </b-form-group>
                    </ValidationProvider>
                  </div>

                  <div class="col-3">
                    <a
                      href="javascript:void(0);"
                      class="text-decoration"
                      v-show="user.copia_dni"
                      @click.stop="$downloadFile(user.copia_dni)"
                    >
                      <i class="uil uil-file-info-alt font-size-18"></i> Archivo adjunto
                    </a>
                  </div>
                </div>

                <div class="row mt-2">
                  <div class="col-9">
                    <ValidationProvider
                      rules="required|ext:pdf|size:3072"
                      name="Declaración Jurada"
                      v-slot="{ validate, errors }"
                    >
                      <b-form-group label-cols="6" label="Declaracion jurada .pdf" class="mb-3">
                        <input
                          v-show="!userEstaPostulando"
                          class="form-control"
                          type="file"
                          @change="handleFileChange($event, 'declaracion_jurada') || validate($event)"
                        />

                        <div class="invalid-feedback" style="display: block" v-show="errors.length">
                          {{ errors[0] }}
                        </div>
                      </b-form-group>
                    </ValidationProvider>
                  </div>

                  <div class="col-3">
                    <a
                      href="javascript:void(0);"
                      class="text-decoration"
                      v-show="user.declaracion_jurada"
                      @click.stop="$downloadFile(user.declaracion_jurada)"
                    >
                      <i class="uil uil-file-info-alt font-size-18"></i> Archivo adjunto
                    </a>
                  </div>
                </div>

                <div class="row mt-2">
                  <div class="col-9">
                    <ValidationProvider
                      rules="required|ext:jpg,png,gif|size:3072"
                      name="Fotografía"
                      v-slot="{ validate, errors }"
                    >
                      <b-form-group label-cols="6" label="Fotografía .jpg/png/gif" class="mb-3">
                        <input
                          v-show="!userEstaPostulando"
                          class="form-control"
                          type="file"
                          @change="handleFileChange($event, 'foto') || validate($event)"
                        />

                        <div class="invalid-feedback" style="display: block" v-show="errors.length">
                          {{ errors[0] }}
                        </div>
                      </b-form-group>
                    </ValidationProvider>
                  </div>

                  <div class="col-3">
                    <a
                      href="javascript:void(0);"
                      class="text-decoration"
                      v-show="user.foto"
                      @click.stop="$downloadFile(user.foto)"
                    >
                      <i class="uil uil-file-info-alt font-size-18"></i> Archivo adjunto
                    </a>
                  </div>
                </div>

                <div class="row mt-2">
                  <div class="col-9">
                    <ValidationProvider rules="ext:pdf|size:3072" name="Archivo" v-slot="{ validate, errors }">
                      <b-form-group
                        label-cols="6"
                        label="Resolución como inspector técnico en seguridad de edificaciones .pdf"
                        class="mb-3"
                      >
                        <input
                          v-show="!userEstaPostulando"
                          class="form-control"
                          type="file"
                          @change="handleFileChange($event, 'rj_itse') || validate($event)"
                        />

                        <div class="invalid-feedback" style="display: block" v-show="errors.length">
                          {{ errors[0] }}
                        </div>
                      </b-form-group>
                    </ValidationProvider>
                  </div>

                  <div class="col-3">
                    <a
                      href="javascript:void(0);"
                      class="text-decoration"
                      v-show="user.rj_itse"
                      @click.stop="$downloadFile(user.rj_itse)"
                    >
                      <i class="uil uil-file-info-alt font-size-18"></i> Archivo adjunto
                    </a>
                  </div>
                </div>

                <div class="row mt-2">
                  <div class="col-9">
                    <ValidationProvider rules="ext:pdf|size:3072" name="Archivo" v-slot="{ validate, errors }">
                      <b-form-group
                        label-cols="6"
                        label="Resolución que lo acredita como verificador AD HOC .pdf "
                        class="mb-3"
                      >
                        <input
                          v-show="!userEstaPostulando"
                          class="form-control"
                          type="file"
                          @change="handleFileChange($event, 'rj_verificador') || validate($event)"
                        />

                        <div class="invalid-feedback" style="display: block" v-show="errors.length">
                          {{ errors[0] }}
                        </div>
                      </b-form-group>
                    </ValidationProvider>
                  </div>

                  <div class="col-3">
                    <a
                      href="javascript:void(0);"
                      class="text-decoration"
                      v-show="user.rj_verificador"
                      @click.stop="$downloadFile(user.rj_verificador)"
                    >
                      <i class="uil uil-file-info-alt font-size-18"></i> Archivo adjunto
                    </a>
                  </div>
                </div>

                <div class="row mt-2">
                  <div class="col-12">
                    <b-button type="submit" v-show="!userEstaPostulando" variant="primary">
                      <i class="fas fa-paper-plane"></i> Subir Documentos
                    </b-button>
                  </div>
                </div>
              </b-form>
            </ValidationObserver>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
