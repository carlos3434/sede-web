<script>
/**
 * Dashboard component
 */
export default {
  layout: 'vertical',
  head() {
    return {
      title: `${this.title} | CENEPRED`
    }
  },
  data() {
    return {
      title: 'Dashboard',
      items: [
        {
          text: 'Admin'
        },
        {
          text: 'Dashboard',
          active: true
        }
      ]
    }
  }
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />
  </div>
</template>

<style></style>
