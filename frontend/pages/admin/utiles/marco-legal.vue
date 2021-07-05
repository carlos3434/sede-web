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
      title: 'Marco Legal',
      items: [{ text: 'Útiles' }, { text: 'Marco Legal', active: true }]
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
