<script>
import { required, email, numeric, minLength } from 'vuelidate/lib/validators'
import { animateCSS } from '../../helpers/animateCSS'

export default {
  layout: 'auth',
  async asyncData({ route, redirect }) {
    let email = route.query.email || ''
    let token = route.query.token || ''

    if (!email || !token) {
      redirect('/')
    }

    return { email, token }
  },
  head() {
    return {
      title: `${this.title} | CENEPRED`
    }
  },
  data() {
    return {
      title: 'Recuperar contraseña',
      password: '',
      password_confirmation: '',
      variantAlert: '',
      messageAlert: '',
      isProcessing: false
    }
  },
  validations: {
    password: {
      required,
      minLength: minLength(8)
    }
  },
  methods: {
    async tryToReset() {
      // stop here if form is invalid
      this.$v.$touch()

      if (this.$v.$invalid) {
        animateCSS('.card', 'shakeX')
        return
      }

      this.isProcessing = true

      await this.$axios
        .post('/password/reset', {
          token: this.token,
          email: this.email,
          password: this.password,
          password_confirmation: this.password
        })
        .then((res) => {
          console.log('Here 🚀: ', res)
          this.password = ''
          this.password_confirmation = ''
          this.messageAlert = 'Su contraseña ha sido cambiada exitosamente, por favor inicie sesión.'
          this.variantAlert = 'success'
        })
        .catch((err) => {
          animateCSS('.card', 'shakeX')
          this.messageAlert = err.response.data.message
          this.variantAlert = 'danger'
        })
        .finally(() => {
          this.isProcessing = false
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
          <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card">
              <div class="card-body p-4">
                <div class="text-center mt-2">
                  <h5 class="text-primary">Ingrese su nueva contraseña</h5>
                  <p class="text-muted">
                    Por favor, ingrese una contraseña minimo de 8 caracteres y trate de usar números y letras.
                  </p>
                </div>
                <div class="p-2 mt-4">
                  <b-alert :variant="variantAlert" dismissible fade :show="variantAlert == 'danger'">
                    {{ messageAlert }}
                  </b-alert>
                  <b-alert :variant="variantAlert" fade class="text-center" :show="variantAlert == 'success'">
                    <i class="fas fa-paper-plane d-block display-4 mt-2 mb-3 text-success"></i>
                    <h5 class="text-success">{{ messageAlert }}</h5>
                  </b-alert>

                  <form @submit.prevent="tryToReset" autocomplete="off" v-if="variantAlert != 'success'">
                    <div class="mb-3">
                      <label>Correo electrónico:</label>
                      <input type="email" v-model="email" class="form-control" autocomplete="off" readonly />
                    </div>
                    <div class="mb-3">
                      <label>Nueva Contraseña:</label>
                      <input
                        type="password"
                        v-model="password"
                        class="form-control"
                        autocomplete="off"
                        placeholder="Nueva contraseña"
                        :class="{
                          'is-invalid': $v.password.$error
                        }"
                      />
                      <div v-if="$v.password.$error" class="invalid-feedback">
                        <span v-if="!$v.password.required">Ingresa una nueva contraseña.</span>
                        <span v-if="!$v.password.minLength">La contraseña debe tener minimo 8 caracteres.</span>
                      </div>
                    </div>
                    <div class="form-group row mb-0">
                      <div class="col-12 text-end">
                        <button class="btn btn-primary w-sm" type="submit" :disabled="isProcessing">
                          <span class="spinner-border spinner-border-sm" v-show="isProcessing"></span>
                          Recuperar
                        </button>
                      </div>
                    </div>
                    <div class="mt-4 text-center">
                      <p class="mb-0">
                        Ir a
                        <nuxt-link to="/usuario/login" class="fw-medium text-primary"> Iniciar sesión </nuxt-link>
                      </p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
