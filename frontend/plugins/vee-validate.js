import Vue from 'vue'
import { ValidationObserver, ValidationProvider, extend, localize } from 'vee-validate'
import { email, required, alpha, alpha_dash, ext, image, integer, numeric, size } from 'vee-validate/dist/rules'
import es from 'vee-validate/dist/locale/es.json'

Vue.component('ValidationProvider', ValidationProvider)
Vue.component('ValidationObserver', ValidationObserver)

localize('es', es)

extend('before_or_equal', {
  params: ['target'],
  validate: (value, { target }) => {
    return target && value <= target
  },
  message: 'El campo {_field_} debe ser anterior a {target}'
})

extend('alpha_num_spaces', {
  validate: (value) => {
    let rule = /^[a-z\d\-_\s]+$/i
    return rule.test(value)
  },
  message: 'El campo {_field_} solo debe contener letras, números, -, _ y espacios'
})

extend('required', {
  ...required
})

extend('email', {
  ...email
})

extend('alpha_dash', {
  ...alpha_dash
})

extend('ext', {
  ...ext
})

extend('image', {
  ...image
})

extend('numeric', {
  ...numeric
})

extend('integer', {
  ...integer
})

extend('size', {
  ...size
})

extend('alpha', {
  ...alpha
  // message: 'This field must only contain alphabetic characters'
})

// "alpha": "El campo {_field_} solo debe contener letras",
// "alpha_dash": "El campo {_field_} solo debe contener letras, números y guiones",
// "alpha_num": "El campo {_field_} solo debe contener letras y números",
// "alpha_spaces": "El campo {_field_} solo debe contener letras y espacios",
// "between": "El campo {_field_} debe estar entre {min} y {max}",
// "confirmed": "El campo {_field_} no coincide",
// "digits": "El campo {_field_} debe ser numérico y contener exactamente {length} dígitos",
// "dimensions": "El campo {_field_} debe ser de {width} píxeles por {height} píxeles",
// "email": "El campo {_field_} debe ser un correo electrónico válido",
// "excluded": "El campo {_field_} debe ser un valor válido",
// "ext": "El campo {_field_} debe ser un archivo válido",
// "image": "El campo {_field_} debe ser una imagen",
// "oneOf": "El campo {_field_} debe ser un valor válido",
// "integer": "El campo {_field_} debe ser un entero",
// "length": "El largo del campo {_field_} debe ser {length}",
// "max": "El campo {_field_} no debe ser mayor a {length} caracteres",
// "max_value": "El campo {_field_} debe de ser {max} o menor",
// "mimes": "El campo {_field_} debe ser un tipo de archivo válido",
// "min": "El campo {_field_} debe tener al menos {length} caracteres",
// "min_value": "El campo {_field_} debe ser {min} o superior",
// "numeric": "El campo {_field_} debe contener solo caracteres numéricos",
// "regex": "El formato del campo {_field_} no es válido",
// "required": "El campo {_field_} es obligatorio",
// "required_if": "El campo {_field_} es obligatorio",
// "size": "El campo {_field_} debe ser menor a {size}KB",
// "double": "El campo {_field_} debe ser un decimal válido",
// "is": "El campo {_field_} no coincide con {other}",
// "is_not": "El campo {_field_} debe ser diferente a {other}"
