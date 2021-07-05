<script>
/**
 * Dashboard component
 */
export default {
  head() {
    return {
      title: `${this.title} | CENEPRED`
    }
  },
  data() {
    return {
      title: 'Home'
    }
  }
}
</script>

<template>
  <div>
    <HomeHeroBanner />
    <HomeMediaFooter />
  </div>
</template>

<style></style>
