<template>
  <v-btn icon @click.prevent="onEdit">
    <v-icon>mdi-pencil</v-icon>
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
  methods: {
    onEdit() {
      window.location = `/admin/form/${this.model}/${this.id}`;
    }
  }
};
</script>

<style>
</style>