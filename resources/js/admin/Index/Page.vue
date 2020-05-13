<template>
  <div class="d-flex justify-space-between mb-10">
    <h1 class="title">{{model}}</h1>
    <v-btn v-if="add" :href="addUrl" dark rounded color="primary">
      <v-icon>mdi-plus</v-icon>
      {{$t('text.add')}}
    </v-btn>
    <v-btn v-if="back" :href="backUrl" dark rounded color="primary">
      <v-icon>mdi-code-less-than</v-icon>
      {{$t('text.back')}}
    </v-btn>
  </div>
</template>

<script>
export default {
  props: ["model", "add", "back"],
  computed: {
    addUrl: function() {
      return `/admin/form/${this.model}`;
    },
    backUrl: function() {
      return `/admin/index/${this.model}?`;
    }
  }
};
</script>

<style>
</style>