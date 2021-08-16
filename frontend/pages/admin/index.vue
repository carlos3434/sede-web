<script>
/**
 * Dashboard component
 */
export default {
  layout: 'vertical',
  async asyncData({ route }) {
    let tabIndex = 1 * (route.query.tabIndex || 0)

    return { tabIndex }
  },
  watchQuery: ['tabIndex'],
  head() {
    return {
      title: `${this.title} | CENEPRED`
    }
  },
  data() {
    return {
      title: 'Dashboard',
      items: [{ text: 'Admin' }, { text: 'Dashboard', active: true }],
      pass: {
        old_password: '',
        new_password: '',
        confirm_new_password: ''
      },
      item: {
        nombres: '',
        apellido_paterno: '',
        apellido_materno: '',
        telefono_fijo: '',
        celular: '',
        email: '',
        password: '',
        password_confirmation: '',
        sexo: '',
        pais_id: '',
        tipo_documento_id: '',
        numero_documento: '',
        distrito_id: '',
        roles: '',
        profesion: ''
      },
      listGender: [],
      listDocumentType: [],
      listRoles: [],
      genderSelected: null,
      documentTypeSelected: null,
      roleSelected: null,
      rolesText: ''
    }
  },
  mounted() {
    this.loadSelectOptions()
    this.setUserData()
  },
  watch: {
    genderSelected: function (val) {
      // se necesita enviar 0, por ello la asignacion es diferente
      this.item.sexo = val === null ? null : val.id
    },
    documentTypeSelected: function (val) {
      this.item.tipo_documento_id = val && val.id ? val.id : null
    },
    roleSelected: function (val) {
      this.item.roles = val && val.id ? val.name : null
    }
  },
  computed: {
    generateGreetings: function () {
      let currentHour = this.$moment().format('HH')
      let greetings = 'Hola 👋, '
      let userFullName = this.capitalize(this.$auth.user.nombres)
      userFullName += ' ' + this.capitalize(this.$auth.user.apellido_paterno)
      userFullName += ' ' + this.capitalize(this.$auth.user.apellido_materno)

      if (currentHour >= 0 && currentHour < 12) {
        greetings = 'Buenos días 👋, '
      } else if (currentHour >= 12 && currentHour < 18) {
        greetings = 'Buenas tardes 👋, '
      } else if (currentHour >= 18) {
        greetings = 'Buenas noches 👋, '
      }

      return greetings + userFullName
    }
  },
  methods: {
    setUserData() {
      this.item.nombres = this.$auth.user.nombres
      this.item.apellido_paterno = this.$auth.user.apellido_paterno
      this.item.apellido_materno = this.$auth.user.apellido_materno
      this.item.telefono_fijo = this.$auth.user.telefono_fijo
      this.item.celular = this.$auth.user.celular
      this.item.email = this.$auth.user.email
      this.item.password = this.$auth.user.password
      this.item.password_confirmation = this.$auth.user.password_confirmation
      this.item.sexo = this.$auth.user.sexo
      this.item.pais_id = this.$auth.user.pais_id
      this.item.tipo_documento_id = this.$auth.user.tipo_documento_id
      this.item.numero_documento = this.$auth.user.numero_documento
      this.item.distrito_id = this.$auth.user.distrito_id
      this.rolesTextes = this.$auth.user.roles
      this.item.profesion = this.$auth.user.profesion

      this.rolesText = this.rolesTextes.join(' | ')
    },
    capitalize(value) {
      if (!value) return ''
      value = value.toString().toLowerCase()
      return value.charAt(0).toUpperCase() + value.slice(1)
    },
    tabChange(tabIndex) {
      if (tabIndex == 0 || tabIndex == 1) {
        this.resetPasswordForm()
      }
      if (tabIndex == 0 || tabIndex == 2) {
        this.resetUserForm()
      }
    },
    resetPasswordForm() {
      this.setUserData()

      this.$nextTick(() => {
        this.$refs.form_password.reset()
      })
    },
    resetUserForm() {
      this.pass.old_password = ''
      this.pass.new_password = ''
      this.pass.confirm_new_password = ''

      this.$nextTick(() => {
        this.$refs.form.reset()
      })
    },
    onSubmitPassword() {},
    onSubmitFormUser() {},
    async loadSelectOptions() {
      await this.$axios.get('/listasParaRegistro').then((res) => {
        this.listDocumentType = res.data.tiposDocumentos || []
        this.listRoles = res.data.roles || []
        this.listGender = res.data.sexo || []

        let gen_id = this.item.sexo ? 1 : 0
        let gen = this.listGender.find((i) => i.id == gen_id)
        let dt_id = this.item.tipo_documento_id
        let dt = this.listDocumentType.find((i) => i.id == dt_id)

        this.documentTypeSelected = dt ? dt : null
        this.genderSelected = gen ? gen : null
      })
    }
  },
  middleware: 'authentication'
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />

    <div class="row mx-lg-4">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title mb-4 text-primary">{{ generateGreetings }}</h3>
            <div class="row mt-5">
              <div class="col-12">
                <div class="mb-0">
                  <b-tabs
                    ref="tabs"
                    v-model="tabIndex"
                    content-class="p-4"
                    justified
                    class="nav-tabs-custom"
                    @input="tabChange"
                  >
                    <b-tab>
                      <template v-slot:title>
                        <i class="uil uil-envelope-alt font-size-20"></i>
                        <span class="d-none d-sm-block">Mensajes</span>
                      </template>
                      <div>
                        <div data-simplebar style="max-height: 430px">
                          <div class="media py-4">
                            <div class="media-body">
                              <h5 class="font-size-15 mt-0 mb-1">
                                Sin mensajes.
                                <small class="text-muted float-end">{{ $moment().format('YYYY-MM-DD') }}</small>
                              </h5>
                              <p class="text-muted">No tiene mensajes aun.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </b-tab>
                    <b-tab>
                      <template v-slot:title>
                        <i class="uil uil-user-circle font-size-20"></i>
                        <span class="d-none d-sm-block">Mis Datos</span>
                      </template>
                      <div class="py-4">
                        <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
                          <b-form @submit.prevent="handleSubmit(onSubmitFormUser)">
                            <div class="row">
                              <div class="col-md-6 col-sm-12">
                                <ValidationProvider
                                  vid="nombres"
                                  mode="passive"
                                  rules="required|alpha_num_spaces"
                                  name="Nombres"
                                  v-slot="{ validated, valid, errors }"
                                >
                                  <b-form-group label="Nombres:" class="mb-3">
                                    <b-form-input
                                      type="text"
                                      v-model="item.nombres"
                                      :state="validated && valid ? true : errors[0] ? false : null"
                                    ></b-form-input>
                                    <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                  </b-form-group>
                                </ValidationProvider>
                                <div class="row">
                                  <div class="col-md-6 col-sm-12">
                                    <ValidationProvider
                                      vid="apellido_paterno"
                                      mode="passive"
                                      rules="required|alpha_num_spaces"
                                      name="Apellido Paterno"
                                      v-slot="{ validated, valid, errors }"
                                    >
                                      <b-form-group label="Apellido Paterno:" class="mb-3">
                                        <b-form-input
                                          type="text"
                                          v-model="item.apellido_paterno"
                                          :state="validated && valid ? true : errors[0] ? false : null"
                                        ></b-form-input>
                                        <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                      </b-form-group>
                                    </ValidationProvider>
                                  </div>
                                  <div class="col-md-6 col-sm-12">
                                    <ValidationProvider
                                      vid="apellido_materno"
                                      mode="passive"
                                      rules="required|alpha_num_spaces"
                                      name="Apellido Materno"
                                      v-slot="{ validated, valid, errors }"
                                    >
                                      <b-form-group label="Apellido Materno:" class="mb-3">
                                        <b-form-input
                                          type="text"
                                          v-model="item.apellido_materno"
                                          :state="validated && valid ? true : errors[0] ? false : null"
                                        ></b-form-input>
                                        <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                      </b-form-group>
                                    </ValidationProvider>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <ValidationProvider
                                      vid="telefono_fijo"
                                      mode="passive"
                                      rules="required|alpha_num_spaces"
                                      name="Teléfono"
                                      v-slot="{ validated, valid, errors }"
                                    >
                                      <b-form-group label="Teléfono fijo:" class="mb-3">
                                        <b-form-input
                                          type="number"
                                          v-model="item.telefono_fijo"
                                          :state="validated && valid ? true : errors[0] ? false : null"
                                        ></b-form-input>
                                        <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                      </b-form-group>
                                    </ValidationProvider>
                                  </div>
                                  <div class="col-md-6">
                                    <ValidationProvider
                                      vid="celular"
                                      mode="passive"
                                      rules="required|alpha_num_spaces"
                                      name="Celular"
                                      v-slot="{ validated, valid, errors }"
                                    >
                                      <b-form-group label="Celular:" class="mb-3">
                                        <b-form-input
                                          type="number"
                                          v-model="item.celular"
                                          :state="validated && valid ? true : errors[0] ? false : null"
                                        ></b-form-input>
                                        <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                      </b-form-group>
                                    </ValidationProvider>
                                  </div>
                                </div>
                                <ValidationProvider
                                  vid="email"
                                  mode="passive"
                                  rules="required|email"
                                  name="Correo electrónico"
                                  v-slot="{ validated, valid, errors }"
                                >
                                  <b-form-group label="Correo electrónico:" class="mb-3">
                                    <b-form-input
                                      type="text"
                                      v-model="item.email"
                                      :state="validated && valid ? true : errors[0] ? false : null"
                                    ></b-form-input>
                                    <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                  </b-form-group>
                                </ValidationProvider>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                <div class="row">
                                  <div class="col-lg-6 col-md-12 col-sm-12">
                                    <ValidationProvider
                                      vid="tipo_documento_id"
                                      mode="passive"
                                      rules="required"
                                      name="Tipo de Documento"
                                      v-slot="{ validated, valid, errors }"
                                    >
                                      <b-form-group label="Tipo de Documento:" class="mb-3">
                                        <multiselect-c
                                          :options="listDocumentType"
                                          v-model="documentTypeSelected"
                                          label="nombre"
                                          track-by="id"
                                          :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
                                          placeholder="Elija un tipo de documento"
                                        >
                                          <span slot="noResult">Oops! No se encontraron elementos.</span>
                                        </multiselect-c>
                                        <div class="invalid-feedback" style="display: block" v-show="errors.length">
                                          {{ errors[0] }}
                                        </div>
                                      </b-form-group>
                                    </ValidationProvider>
                                  </div>
                                  <div class="col-lg-6 col-md-12 col-sm-12">
                                    <ValidationProvider
                                      vid="numero_documento"
                                      mode="passive"
                                      rules="required|min:6"
                                      name="Documento"
                                      v-slot="{ validated, valid, errors }"
                                    >
                                      <b-form-group label="Número de Documento:" class="mb-3">
                                        <b-form-input
                                          type="number"
                                          v-model="item.numero_documento"
                                          :state="validated && valid ? true : errors[0] ? false : null"
                                        ></b-form-input>
                                        <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                      </b-form-group>
                                    </ValidationProvider>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-6">
                                    <b-form-group label="Rol:" class="mb-3">
                                      <b-form-input type="text" v-model="rolesText" disabled></b-form-input>
                                    </b-form-group>
                                  </div>
                                  <div class="col-6">
                                    <ValidationProvider
                                      vid="sexo"
                                      mode="passive"
                                      rules="required"
                                      name="Género"
                                      v-slot="{ validated, valid, errors }"
                                    >
                                      <b-form-group label="Género:" class="mb-3">
                                        <multiselect-c
                                          :options="listGender"
                                          v-model="genderSelected"
                                          label="nombre"
                                          track-by="id"
                                          :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
                                          placeholder="Elija un género"
                                        >
                                          <span slot="noResult">Oops! No se encontraron elementos.</span>
                                        </multiselect-c>
                                        <div class="invalid-feedback" style="display: block" v-show="errors.length">
                                          {{ errors[0] }}
                                        </div>
                                      </b-form-group>
                                    </ValidationProvider>
                                  </div>
                                </div>
                                <ValidationProvider
                                  vid="profesion"
                                  mode="passive"
                                  rules="required|alpha_num_spaces"
                                  name="Profesión"
                                  v-slot="{ validated, valid, errors }"
                                >
                                  <b-form-group label="Profesión:" class="mb-3">
                                    <b-form-input
                                      type="text"
                                      v-model="item.profesion"
                                      :state="validated && valid ? true : errors[0] ? false : null"
                                    ></b-form-input>
                                    <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                  </b-form-group>
                                </ValidationProvider>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-12 text-end">
                                <b-button type="submit" variant="primary" disabled>
                                  <i class="fas fa-paper-plane"></i> Actualizar
                                </b-button>
                              </div>
                            </div>
                          </b-form>
                        </ValidationObserver>
                      </div>
                    </b-tab>
                    <b-tab>
                      <template v-slot:title>
                        <i class="uil uil-clipboard-notes font-size-20"></i>
                        <span class="d-none d-sm-block">Cambiar Contraseña</span>
                      </template>
                      <div>
                        <div class="row">
                          <div class="col-4 py-4">
                            <ValidationObserver ref="form_password" v-slot="{ handleSubmit }" @submit.prevent>
                              <b-form @submit.prevent="handleSubmit(onSubmitPassword)">
                                <ValidationProvider
                                  rules="required|alpha_num_spaces"
                                  name="Contraseña Anterior"
                                  v-slot="{ validated, valid, errors }"
                                >
                                  <b-form-group label="Contraseña Anterior:" class="mb-3">
                                    <b-form-input
                                      type="text"
                                      v-model="pass.old_password"
                                      :state="validated && valid ? true : errors[0] ? false : null"
                                    ></b-form-input>
                                    <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                  </b-form-group>
                                </ValidationProvider>
                                <ul class="text-info">
                                  <li>La nueva contraseña debe tener al menos 8 caracteres.</li>
                                  <li>La nueva contraseña debe contener números y letras.</li>
                                </ul>
                                <ValidationProvider
                                  rules="required|alpha_num_spaces|min:8"
                                  name="Nueva Contraseña"
                                  v-slot="{ validated, valid, errors }"
                                >
                                  <b-form-group label="Nueva Contraseña:" class="mb-3">
                                    <b-form-input
                                      type="text"
                                      v-model="pass.new_password"
                                      :state="validated && valid ? true : errors[0] ? false : null"
                                    ></b-form-input>
                                    <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                  </b-form-group>
                                </ValidationProvider>
                                <ValidationProvider
                                  rules="required|alpha_num_spaces|min:8"
                                  name="Confirmar Contraseña"
                                  v-slot="{ validated, valid, errors }"
                                >
                                  <b-form-group label="Confirmar Contraseña:" class="mb-3">
                                    <b-form-input
                                      type="text"
                                      v-model="pass.confirm_new_password"
                                      :state="validated && valid ? true : errors[0] ? false : null"
                                    ></b-form-input>
                                    <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                  </b-form-group>
                                </ValidationProvider>
                                <button type="submit" class="btn btn-primary" disabled>
                                  <i class="fas fa-paper-plane"></i> Cambiar Contraseña
                                </button>
                              </b-form>
                            </ValidationObserver>
                          </div>
                        </div>
                      </div>
                    </b-tab>
                  </b-tabs>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style></style>
