<template>
  <v-btn :href="url" icon>
    <v-icon>mdi-cloud-upload</v-icon>
  </v-btn>
</template>

<script>
export default {
  props: {
    id: {
      required: true
    },
    model: {
      required: true
    }
  },
  computed: {
    url: function() {
      return `/admin/upload/${this.model}/${this.id}/`;
    }
  }
};
</script>

<style>
</style>