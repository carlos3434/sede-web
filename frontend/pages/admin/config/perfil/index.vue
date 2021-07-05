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
      title: 'Perfil',
      items: [{ text: 'Admin' }, { text: 'perfil', active: true }]
    }
  }
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />

    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Select2</h4>
            <p class="card-title-desc">A mobile and touch friendly input spinner component for Bootstrap</p>
            <div class="col-sm-8">
              <label>Single Select</label>
              <multiselect v-model="value" :options="options" class="helo"></multiselect>

              <label class="mt-3">Multiple Select</label>
              <multiselect v-model="value1" :options="options" :multiple="true"></multiselect>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Css Switch</h4>
            <p class="card-title-desc">Here are a few types of switches.</p>

            <switches v-model="enabled" type-bold="true" class="mb-0"></switches>
            <switches v-model="enabled1" type-bold="false" color="warning" class="ml-1 mb-0"></switches>
            <switches v-model="enabled2" type-bold="false" color="danger" class="ml-1 mb-0"></switches>
            <switches v-model="enabled3" type-bold="false" color="primary" class="ml-1 mb-0"></switches>
            <switches v-model="enabled4" type-bold="false" color="success" class="ml-1 mb-0"></switches>
            <switches v-model="enabled5" type-bold="false" color="info" class="ml-1 mb-0"></switches>
            <h5 class="mt-4 font-size-14 mb-4">Small switch</h5>

            <div>
              <switches v-model="small"></switches>
              <switches v-model="small1" color="warning" class="ml-1"></switches>
              <switches v-model="small2" color="danger" class="ml-1"></switches>
              <switches v-model="small3" color="success" class="ml-1"></switches>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style></style>
