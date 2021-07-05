<script>
import { required, email, numeric, minLength, minValue } from 'vuelidate/lib/validators'
import { animateCSS } from '~/helpers/animateCSS'
import { countries } from '~/components/static/countries'
import { departamentos, provincias, distritos } from '~/components/static/ubigeos'

/**
 * Register component
 */
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
      countries: countries,
      departamentos: departamentos,
      provincias: provincias,
      distritos: distritos,
      provinciasFiltrado: [],
      distritosFiltrado: [],
      departamento: -1,
      provincia: -1,
      distrito: -1,
      submitted: false,
      showAlert: false,
      variantAlert: '',
      messageAlert: '',
      user: {
        nombres: 'juan carlos',
        apellido_paterno: 'rojas',
        apellido_materno: 'toralva',
        email: 'juan151@gmail.com',
        pais_id: 139,
        sexo: '1',
        tipo_documento_id: '1',
        numero_documento: '455316580',
        distrito_id: '1',
        telefono_fijo: '964142677',
        celular: '964142677',
        password: '12345678',
        password_confirmation: ''
      }
    }
  },
  validations: {
    user: {
      nombres: { required },
      email: { required, email },
      password: { required },
      numero_documento: { required, numeric, minLength: minLength(8) },
      telefono_fijo: { required },
      celular: { required },
      pais_id: { required, minValue: minValue(1) }
    },
    departamento: { required, minValue: minValue(1) },
    provincia: { required, minValue: minValue(1) },
    distrito: { required, minValue: minValue(1) }
  },
  methods: {
    onChangeDepartamento(e) {
      this.provincia = -1
      this.distrito = -1
      this.distritosFiltrado = []
      this.provinciasFiltrado = this.provincias.filter((i) => i.department_id == e.target.value)
    },
    onChangeProvincia(e) {
      this.distrito = -1
      this.distritosFiltrado = this.distritos.filter((i) => i.province_id == e.target.value)
    },
    async tryToRegister() {
      this.submitted = true
      this.showAlert = false

      // stop here if form is invalid
      this.$v.$touch()

      if (this.$v.$invalid) {
        animateCSS('.card', 'shakeX')
        return
      }

      this.user.password_confirmation = this.user.password

      await this.$axios
        .post('/register', this.user)
        .then((res) => {
          let token = res.data.success.token

          this.$auth.setUserToken(token, true).then(() => {
            this.$router.push('/admin/dashboard')
          })
        })
        .catch((err) => {
          this.showAlert = true
          this.variantAlert = 'danger'
          if (err.response.data.message) {
            this.messageAlert = err.response.data.message
          } else {
            this.messageAlert = 'Ha ocurrido un error, por favor inténtelo de nuevo más tarde'
          }
          animateCSS('.card', 'shakeX')
        })
        .finally(() => {
          this.submitted = false
        })
    }
  },
  middleware: 'anonymous'
}
</script>

<template>
  <div>
    <div class="account-pages my-5 pt-sm-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6 col-xl-6">
            <div class="card">
              <div class="card-body p-4">
                <div class="text-center mt-2">
                  <h5 class="text-primary">Registro</h5>
                  <p class="text-muted"></p>
                </div>
                <div class="mt-4">
                  <b-alert v-model="showAlert" :variant="variantAlert" dismissible fade>
                    {{ messageAlert }}
                  </b-alert>
                  <form @submit.prevent="tryToRegister" autocomplete="off">
                    <div class="form-group mb-3">
                      <label>Nacionalidad:</label>
                      <select
                        v-model="user.pais_id"
                        class="form-select"
                        :class="{ 'is-invalid': $v.user.pais_id.$error }"
                      >
                        <option value="-1">Elije tu país</option>
                        <option v-for="c in countries" :key="c.id" :value="c.id">{{ c.country }}</option>
                      </select>
                      <div v-if="$v.user.pais_id.$error" class="invalid-feedback">
                        <span v-if="!$v.user.pais_id.minValue">Seleccione su país.</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 form-group mb-3">
                        <label>Tipo de documento:</label>
                        <select v-model="user.tipo_documento_id" class="form-select">
                          <option value="1">DNI</option>
                        </select>
                      </div>
                      <div class="col-md-8 form-group mb-3">
                        <label>Número de documento:</label>
                        <input
                          type="number"
                          v-model="user.numero_documento"
                          class="form-control"
                          autocomplete="off"
                          :class="{ 'is-invalid': $v.user.numero_documento.$error }"
                        />
                        <div v-if="$v.user.numero_documento.$error" class="invalid-feedback">
                          <span v-if="!$v.user.numero_documento.required">Ingresa tu número de documento.</span>
                          <span v-if="!$v.user.numero_documento.minLength">
                            El número de documento debe tener minimo 8 digitos.
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group mb-3">
                      <label>Nombres:</label>
                      <input
                        type="text"
                        v-model="user.nombres"
                        class="form-control"
                        autocomplete="off"
                        :class="{ 'is-invalid': $v.user.nombres.$error }"
                      />
                      <div v-if="$v.user.nombres.$error" class="invalid-feedback">
                        <span v-if="!$v.user.nombres.required">Ingresa tus nombres.</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 form-group mb-3">
                        <label>Departamento:</label>
                        <select
                          v-model="departamento"
                          @change="onChangeDepartamento"
                          class="form-select"
                          :class="{ 'is-invalid': $v.departamento.$error }"
                        >
                          <option value="-1" disabled>Seleccione departamento</option>
                          <option v-for="c in departamentos" :key="c.id" :value="c.id">{{ c.name }}</option>
                        </select>
                        <div v-if="$v.departamento.$error" class="invalid-feedback">
                          <span v-if="!$v.departamento.minValue">Seleccione el departamento.</span>
                        </div>
                      </div>
                      <div class="col-md-6 form-group mb-3">
                        <label>Provincia:</label>
                        <select
                          v-model="provincia"
                          @change="onChangeProvincia"
                          class="form-select"
                          :class="{ 'is-invalid': $v.provincia.$error }"
                        >
                          <option value="-1" disabled>Seleccione provincia</option>
                          <option v-for="c in provinciasFiltrado" :key="c.id" :value="c.id">{{ c.name }}</option>
                        </select>
                        <div v-if="$v.provincia.$error" class="invalid-feedback">
                          <span v-if="!$v.provincia.minValue">Seleccione la provincia.</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group mb-3">
                      <label>Distrito:</label>
                      <select v-model="distrito" class="form-select" :class="{ 'is-invalid': $v.distrito.$error }">
                        <option value="-1" disabled>Seleccione distrito</option>
                        <option v-for="c in distritosFiltrado" :key="c.id" :value="c.id">{{ c.name }}</option>
                      </select>
                      <div v-if="$v.distrito.$error" class="invalid-feedback">
                        <span v-if="!$v.distrito.minValue">Seleccione el distrito.</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 form-group mb-3">
                        <label>Teléfono fijo:</label>
                        <input
                          type="text"
                          v-model="user.telefono_fijo"
                          class="form-control"
                          autocomplete="off"
                          :class="{ 'is-invalid': $v.user.telefono_fijo.$error }"
                        />
                        <div v-if="$v.user.telefono_fijo.$error" class="invalid-feedback">
                          <span v-if="!$v.user.telefono_fijo.required">Ingresa tu teléfono fijo.</span>
                        </div>
                      </div>
                      <div class="col-md-6 form-group mb-3">
                        <label>Celular:</label>
                        <input
                          type="text"
                          v-model="user.celular"
                          class="form-control"
                          autocomplete="off"
                          :class="{ 'is-invalid': $v.user.celular.$error }"
                        />
                        <div v-if="$v.user.celular.$error" class="invalid-feedback">
                          <span v-if="!$v.user.celular.required">Ingresa tu celular.</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group mb-3">
                      <label>Correo electrónico:</label>
                      <input
                        type="text"
                        v-model="user.email"
                        class="form-control"
                        autocomplete="off"
                        :class="{ 'is-invalid': $v.user.email.$error }"
                      />
                      <div v-if="$v.user.email.$error" class="invalid-feedback">
                        <span v-if="!$v.user.email.required">Ingresa tu correo electrónico.</span>
                      </div>
                    </div>
                    <div class="form-group mb-3">
                      <label>Contraseña:</label>
                      <input
                        type="password"
                        v-model="user.password"
                        class="form-control"
                        autocomplete="off"
                        :class="{ 'is-invalid': $v.user.password.$error }"
                      />
                      <div v-if="$v.user.password.$error" class="invalid-feedback">
                        <span v-if="!$v.user.password.required">Ingresa tu contraseña.</span>
                      </div>
                    </div>
                    <div class="form-group mb-0">
                      <div class="col-12 text-end">
                        <button class="btn btn-primary w-sm" type="submit">Registrarse</button>
                      </div>
                    </div>
                  </form>
                  <div class="mt-4 text-center">
                    <p class="mb-0">
                      Ir a
                      <nuxt-link to="/usuario/login" class="fw-medium text-primary">Iniciar sesión</nuxt-link>
                    </p>
                  </div>
                </div>
              </div>
              <!-- end card-body -->
            </div>
            <!-- end card -->
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </div>
  </div>
</template>

<style lang="scss" module></style>
