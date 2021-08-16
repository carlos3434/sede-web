<script>
import { animateCSS } from '~/helpers/animateCSS'

export default {
  layout: 'auth',
  head() {
    return {
      title: `${this.title} | CENEPRED`
    }
  },
  data() {
    return {
      title: 'Registrar cuenta',
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
      listCountries: [],
      listDocumentType: [],
      listDepartamento: [],
      listProvincia: [],
      listDistrito: [],
      listRoles: [],
      provinciasFiltrado: [],
      distritosFiltrado: [],
      genderSelected: null,
      countrySelected: { id: 139, nombre: 'Perú' },
      documentTypeSelected: null,
      departamentoSelected: null,
      provinciaSelected: null,
      distritoSelected: null,
      roleSelected: null,
      isProcessing: false
    }
  },
  watch: {
    distritoSelected: function (val) {
      this.item.distrito_id = val && val.id ? val.id : null
    },
    genderSelected: function (val) {
      // se necesita enviar 0, por ello la asignacion es diferente
      this.item.sexo = val === null ? null : val.id
    },
    countrySelected: function (val) {
      this.item.pais_id = val && val.id ? val.id : null
    },
    documentTypeSelected: function (val) {
      this.item.tipo_documento_id = val && val.id ? val.id : null
    },
    roleSelected: function (val) {
      this.item.roles = val && val.id ? val.name : null
    },
    'item.password': function (newVal, oldVal) {
      this.item.password_confirmation = newVal
    }
  },
  beforeDestroy() {
    this.$recaptcha.destroy()
  },
  async mounted() {
    try {
      await this.$recaptcha.init()
    } catch (e) {
      console.error(e)
    }
    this.loadSelectOptions()

    // Set Pais por defecto
    this.item.pais_id = this.countrySelected ? this.countrySelected.id : ''
  },
  methods: {
    onChangeDepartamento(e) {
      this.distritoSelected = null
      this.provinciaSelected = null
      this.distritosFiltrado = []
      this.provinciasFiltrado = []

      if (!e) return

      this.provinciasFiltrado = this.listProvincia.filter((i) => i.departamento_id == e.id)
    },
    onChangeProvincia(e) {
      if (!e) return

      this.distritoSelected = null
      this.distritosFiltrado = this.listDistrito.filter((i) => i.provincia_id == e.id)
    },
    async onSubmit() {
      let self = this
      this.item.token = await this.$recaptcha.execute('register')

      this.$refs.form.validate().then((success) => {
        if (!success) {
          return
        }

        this.isProcessing = true
        if (!this.item.profesion) delete this.item.profesion

        this.$axios
          .post('/register', this.item)
          .then((res) => {
            let token = res.data.success.token

            this.$auth.setUserToken(token, true).then((res) => {
              let roles = res.data.success.roles
              let permissions = res.data.success.permissions

              this.$gates.setRoles(roles)
              this.$gates.setPermissions(permissions)
              this.$router.push('/admin')
            })
          })
          .catch(function (e) {
            // handle error
            if (e.response && e.response.status == 422) {
              self.$refs.form.setErrors(e.response.data.errors)
            }
          })
          .finally(() => {
            this.isProcessing = false
          })
      })
    },
    async loadSelectOptions() {
      await this.$axios.get('/listasParaRegistro').then((res) => {
        this.listCountries = res.data.paises || []
        this.listDocumentType = res.data.tiposDocumentos || []
        this.listDepartamento = res.data.departamentos || []
        this.listProvincia = res.data.provincias || []
        this.listDistrito = res.data.distritos || []
        this.listRoles = res.data.roles || []
        this.listGender = res.data.sexo || []
      })
    }
  },
  middleware: 'anonymous'
}
</script>

<template>
  <div>
    <div class="account-pages my-5">
      <div class="container">
        <div class="row">
          <div class="card">
            <div class="card-body">
              <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
                <b-form @submit.prevent="handleSubmit(onSubmit)">
                  <div class="row">
                    <div class="col-md-12 mb-4">
                      <div class="text-center mt-2">
                        <h5 class="text-primary">Registro</h5>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <ValidationProvider
                        vid="nombres"
                        rules="required|alpha_num_spaces"
                        name="Nombres"
                        v-slot="{ valid, errors }"
                      >
                        <b-form-group label="Nombres:" class="mb-3">
                          <b-form-input
                            type="text"
                            v-model="item.nombres"
                            :state="errors[0] ? false : valid ? true : null"
                          ></b-form-input>
                          <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                        </b-form-group>
                      </ValidationProvider>
                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <ValidationProvider
                            vid="apellido_paterno"
                            rules="required|alpha_num_spaces"
                            name="Apellido Paterno"
                            v-slot="{ valid, errors }"
                          >
                            <b-form-group label="Apellido Paterno:" class="mb-3">
                              <b-form-input
                                type="text"
                                v-model="item.apellido_paterno"
                                :state="errors[0] ? false : valid ? true : null"
                              ></b-form-input>
                              <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                            </b-form-group>
                          </ValidationProvider>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <ValidationProvider
                            vid="apellido_materno"
                            rules="required|alpha_num_spaces"
                            name="Apellido Materno"
                            v-slot="{ valid, errors }"
                          >
                            <b-form-group label="Apellido Materno:" class="mb-3">
                              <b-form-input
                                type="text"
                                v-model="item.apellido_materno"
                                :state="errors[0] ? false : valid ? true : null"
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
                            rules="required|alpha_num_spaces"
                            name="Teléfono"
                            v-slot="{ valid, errors }"
                          >
                            <b-form-group label="Teléfono fijo:" class="mb-3">
                              <b-form-input
                                type="number"
                                v-model="item.telefono_fijo"
                                :state="errors[0] ? false : valid ? true : null"
                              ></b-form-input>
                              <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                            </b-form-group>
                          </ValidationProvider>
                        </div>
                        <div class="col-md-6">
                          <ValidationProvider
                            vid="celular"
                            rules="required|alpha_num_spaces"
                            name="Celular"
                            v-slot="{ valid, errors }"
                          >
                            <b-form-group label="Celular:" class="mb-3">
                              <b-form-input
                                type="number"
                                v-model="item.celular"
                                :state="errors[0] ? false : valid ? true : null"
                              ></b-form-input>
                              <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                            </b-form-group>
                          </ValidationProvider>
                        </div>
                      </div>
                      <ValidationProvider
                        vid="email"
                        rules="required|email"
                        name="Correo electrónico"
                        v-slot="{ valid, errors }"
                      >
                        <b-form-group label="Correo electrónico:" class="mb-3">
                          <b-form-input
                            type="text"
                            v-model="item.email"
                            :state="errors[0] ? false : valid ? true : null"
                          ></b-form-input>
                          <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                        </b-form-group>
                      </ValidationProvider>
                      <div class="row">
                        <div class="col-6">
                          <ValidationProvider
                            vid="password"
                            rules="required|min:8"
                            name="Contraseña"
                            v-slot="{ valid, errors }"
                          >
                            <b-form-group label="Contraseña:" class="mb-3">
                              <b-form-input
                                type="password"
                                v-model="item.password"
                                placeholder="••••••"  autocomplete="new-password"
                                :state="errors[0] ? false : valid ? true : null"
                              ></b-form-input>
                              <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                            </b-form-group>
                          </ValidationProvider>
                        </div>
                        <div class="col-6">
                          <ValidationProvider vid="sexo" rules="required" name="Género" v-slot="{ valid, errors }">
                            <b-form-group label="Género:" class="mb-3">
                              <multiselect-c
                                :options="listGender"
                                v-model="genderSelected"
                                label="nombre"
                                track-by="id"
                                :class="errors[0] ? `is-invalid` : valid ? `is-valid` : ``"
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
                      <div class="row">
                        <div class="col-md-12">
                          <ValidationProvider vid="roles" rules="required" name="Rol" v-slot="{ valid, errors }">
                            <b-form-group label="Rol:" class="mb-3">
                              <multiselect-c
                                :options="listRoles"
                                v-model="roleSelected"
                                label="nombre"
                                track-by="id"
                                :class="errors[0] ? `is-invalid` : valid ? `is-valid` : ``"
                                placeholder="Elija un rol"
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
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <ValidationProvider
                        vid="pais_id"
                        rules="required"
                        name="Nacionalidad"
                        v-slot="{ validated, valid, errors }"
                      >
                        <b-form-group label="Nacionalidad:" class="mb-3">
                          <multiselect-c
                            :options="listCountries"
                            v-model="countrySelected"
                            label="nombre"
                            track-by="id"
                            :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
                            placeholder="Elija un nacionalidad"
                          >
                            <span slot="noResult">Oops! No se encontraron elementos.</span>
                          </multiselect-c>
                          <div class="invalid-feedback" style="display: block" v-show="errors.length">
                            {{ errors[0] }}
                          </div>
                        </b-form-group>
                      </ValidationProvider>
                      <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                          <ValidationProvider
                            vid="tipo_documento_id"
                            rules="required"
                            name="Tipo de Documento"
                            v-slot="{ valid, errors }"
                          >
                            <b-form-group label="Tipo de Documento:" class="mb-3">
                              <multiselect-c
                                :options="listDocumentType"
                                v-model="documentTypeSelected"
                                label="nombre"
                                track-by="id"
                                :class="errors[0] ? `is-invalid` : valid ? `is-valid` : ``"
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
                            rules="required|min:6"
                            name="Documento"
                            v-slot="{ valid, errors }"
                          >
                            <b-form-group label="Número de Documento:" class="mb-3">
                              <b-form-input
                                type="number"
                                v-model="item.numero_documento"
                                :state="errors[0] ? false : valid ? true : null"
                              ></b-form-input>
                              <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                            </b-form-group>
                          </ValidationProvider>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                          <ValidationProvider rules="required" name="Departamento" v-slot="{ valid, errors }">
                            <b-form-group label="Departamento:" class="mb-3">
                              <multiselect-c
                                :options="listDepartamento"
                                v-model="departamentoSelected"
                                label="nombre"
                                track-by="id"
                                :class="errors[0] ? `is-invalid` : valid ? `is-valid` : ``"
                                placeholder="Elija un departamento"
                                @input="onChangeDepartamento"
                              >
                                <span slot="noResult">Oops! No se encontraron elementos.</span>
                                <span slot="noOptions">Lista vacia.</span>
                              </multiselect-c>
                              <div class="invalid-feedback" style="display: block" v-show="errors.length">
                                {{ errors[0] }}
                              </div>
                            </b-form-group>
                          </ValidationProvider>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                          <ValidationProvider rules="required" name="Provincia" v-slot="{ valid, errors }">
                            <b-form-group label="Provincia:" class="mb-3">
                              <multiselect-c
                                :options="provinciasFiltrado"
                                v-model="provinciaSelected"
                                label="nombre"
                                track-by="id"
                                :class="errors[0] ? `is-invalid` : valid ? `is-valid` : ``"
                                placeholder="Elija un provincia"
                                @input="onChangeProvincia"
                              >
                                <span slot="noResult">Oops! No se encontraron elementos.</span>
                                <span slot="noOptions">Lista vacia.</span>
                              </multiselect-c>
                              <div class="invalid-feedback" style="display: block" v-show="errors.length">
                                {{ errors[0] }}
                              </div>
                            </b-form-group>
                          </ValidationProvider>
                        </div>
                      </div>
                      <ValidationProvider vid="distrito_id" rules="required" name="Distrito" v-slot="{ valid, errors }">
                        <b-form-group label="Distrito:" class="mb-3">
                          <multiselect-c
                            :options="distritosFiltrado"
                            v-model="distritoSelected"
                            label="nombre"
                            track-by="id"
                            :class="errors[0] ? `is-invalid` : valid ? `is-valid` : ``"
                            placeholder="Elija un distrito"
                          >
                            <span slot="noResult">Oops! No se encontraron elementos.</span>
                            <span slot="noOptions">Lista vacia.</span>
                          </multiselect-c>
                          <div class="invalid-feedback" style="display: block" v-show="errors.length">
                            {{ errors[0] }}
                          </div>
                        </b-form-group>
                      </ValidationProvider>
                      <b-form-group label="Profesión:" class="mb-3">
                        <b-form-input type="text" v-model="item.profesion"></b-form-input>
                      </b-form-group>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 text-end">
                      <b-button type="submit" size="md" variant="primary" :disabled="isProcessing">
                        <span class="spinner-border spinner-border-sm" v-show="isProcessing"></span> Registrarse
                      </b-button>
                    </div>
                  </div>
                </b-form>
                <div class="mt-4 text-center">
                  <p class="mb-0">
                    Ir a
                    <nuxt-link to="/usuario/login" class="fw-medium text-primary">Iniciar sesión</nuxt-link>
                  </p>
                </div>
              </ValidationObserver>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
