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
      title: 'Nosotros',
      items: [{ text: 'Útiles' }, { text: 'Nosotros', active: true }]
    }
  },
  middleware: 'authentication'
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />
  </div>
</template>

<style></style>
