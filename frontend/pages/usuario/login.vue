<script>
import { required, email } from 'vuelidate/lib/validators'
import { animateCSS } from '~/helpers/animateCSS'

/**
 * Login component
 */
export default {
  layout: 'auth',
  head() {
    return {
      title: `${this.title} - CENEPRED`
    }
  },
  data() {
    return {
      title: 'Inicio de sesión',
      email: 'kmontoya@cenepred.gob.pe',
      password: '12345678',
      submitted: false,
      showAlert: false,
      variantAlert: '',
      messageAlert: ''
    }
  },
  validations: {
    email: { required, email },
    password: { required }
  },
  methods: {
    // Try to log the user in with the username
    // and password they provided.
    async tryToLogIn() {
      this.submitted = true
      this.showAlert = false

      // stop here if form is invalid
      this.$v.$touch()

      if (this.$v.$invalid) {
        animateCSS('.card', 'shakeX')
        return
      }

      let res = await this.$auth
        .loginWith('local', {
          data: {
            email: this.email,
            password: this.password
          }
        })
        .then((res) => {
          console.log(res.data)
          let roles = res.data.success.roles
          let permissions = res.data.success.permissions

          this.$gates.setRoles(roles)
          this.$gates.setPermissions(permissions)

          // this.$gates.setRoles(['ADMINISTRADOR'])
          console.log(this.$gates.getRoles())
          console.log(this.$gates.getPermissions())
          this.$router.push('/admin/dashboard')
        })
        .catch((err) => {
          animateCSS('.card', 'shakeX')
          this.messageAlert = 'El correo o la contraseña no son correctos.'
          this.showAlert = true
          this.variantAlert = 'danger'
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
        <div class="row">
          <div class="col-lg-12"></div>
        </div>
        <div class="row align-items-center justify-content-center">
          <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card">
              <div class="card-body p-4">
                <div class="text-center mt-2">
                  <h5 class="text-primary">Inicia sesión en tu cuenta</h5>
                </div>
                <div class="p-2 mt-4">
                  <b-alert v-model="showAlert" :variant="variantAlert" dismissible fade>
                    {{ messageAlert }}
                  </b-alert>
                  <b-form @submit.prevent="tryToLogIn">
                    <b-form-group label="Correo electrónico" class="mb-3">
                      <b-form-input
                        v-model="email"
                        type="text"
                        :class="{ 'is-invalid': $v.email.$error }"
                      ></b-form-input>
                      <div v-if="$v.email.$error" class="invalid-feedback">
                        <span v-if="!$v.email.required">Ingresa tu correo electrónico.</span>
                        <span v-if="!$v.email.email">El correo electrónico no es válido.</span>
                      </div>
                    </b-form-group>
                    <b-form-group class="mb-3">
                      <div class="float-end">
                        <nuxt-link to="/usuario/forgot-password" class="text-muted">
                          ¿Olvidaste tu contraseña?
                        </nuxt-link>
                      </div>
                      <label>Contraseña</label>
                      <b-form-input
                        v-model="password"
                        type="password"
                        :class="{ 'is-invalid': $v.password.$error }"
                      ></b-form-input>
                      <div v-if="$v.password.$error" class="invalid-feedback">
                        <span v-if="!$v.password.required">Ingresa tu contraseña.</span>
                      </div>
                    </b-form-group>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="remember-check" />
                      <label class="form-check-label" for="remember-check">Recordarme</label>
                    </div>
                    <div class="mt-3 text-end">
                      <b-button type="submit" variant="primary" class="w-sm">{{ $t('auth.login.login') }}</b-button>
                    </div>
                    <div class="mt-4 text-center">
                      <p class="mb-0">
                        ¿No tienes una cuenta?
                        <nuxt-link to="/usuario/registro" class="fw-medium text-primary">Registrate ahora</nuxt-link>
                      </p>
                    </div>
                  </b-form>
                </div>
                <!-- end card-body -->
              </div>
              <!-- end card -->
            </div>
            <!-- end row -->
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->
      </div>
    </div>
  </div>
</template>

<style>
.card {
  box-shadow: 0 0.5em 1em -0.125em rgb(10 10 10 / 10%), 0 0px 0 1px rgb(10 10 10 / 2%);
}
</style>
