<script>
import { required, email, numeric, minLength } from 'vuelidate/lib/validators'
import { animateCSS } from '../../helpers/animateCSS'

/**
 * Forgot Password component
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
      title: 'Recuperar contraseña',
      email: '',
      documento: '',
      variantAlert: '',
      messageAlert: '',
      isProcessing: false
    }
  },
  validations: {
    email: {
      required,
      email
    },
    documento: {
      required,
      numeric,
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
        .post('/password/email', {
          email: this.email,
          dni: this.documento
        })
        .then((res) => {
          this.documento = ''
          this.email = ''
          this.messageAlert = 'Enviamos más instrucciones a tu correo electrónico.'
          this.variantAlert = 'success'
        })
        .catch((err) => {
          animateCSS('.card', 'shakeX')
          this.messageAlert = 'Verifique sus datos e inténtelo más tarde.'
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
                  <h5 class="text-primary">
                    {{ $t('auth.reset.title') }}
                  </h5>
                  <p class="text-muted">
                    {{ $t('auth.reset.description') }}
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
                      <label for="useremail">
                        {{ $t('auth.reset.email') }}
                      </label>
                      <input
                        type="email"
                        v-model="email"
                        class="form-control"
                        id="useremail"
                        autocomplete="off"
                        :placeholder="$t('auth.reset.email')"
                        :class="{
                          'is-invalid': $v.email.$error
                        }"
                      />
                      <div v-if="$v.email.$error" class="invalid-feedback">
                        <span v-if="!$v.email.required">
                          {{ $t('auth.error_msg.email_required') }}
                        </span>
                        <span v-if="!$v.email.email">
                          {{ $t('auth.error_msg.email_valid') }}
                        </span>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="nrodocumento">
                        {{ $t('auth.reset.documento') }}
                      </label>
                      <input
                        type="number"
                        v-model="documento"
                        class="form-control"
                        id="nrodocumento"
                        autocomplete="off"
                        :placeholder="$t('auth.reset.documento')"
                        :class="{
                          'is-invalid': $v.documento.$error
                        }"
                      />
                      <div v-if="$v.documento.$error" class="invalid-feedback">
                        <span v-if="!$v.documento.required">
                          {{ $t('auth.error_msg.nro_required') }}
                        </span>
                        <span v-if="!$v.documento.numeric">
                          {{ $t('auth.error_msg.nro_documento') }}
                        </span>
                        <span v-if="!$v.documento.minLength">
                          {{ $t('auth.error_msg.nro_minlength') }}
                        </span>
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
