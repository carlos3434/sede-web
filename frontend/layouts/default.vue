<script>
import { mapState } from 'vuex'

export default {
  computed: mapState(['layout']),
  mounted() {}
}
</script>

<template>
  <div>
    <HomeNavBar />
    <HomeHeroHead />
    <Nuxt />
    <HomeFooter />
  </div>
</template>
