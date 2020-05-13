<template>
  <v-btn @click.prevent="singOut" icon>
    <v-icon>mdi-open-in-new</v-icon>
  </v-btn>
</template>

<script>
export default {
  methods: {
    singOut() {
      App.$request.signOut();
    }
  }
};
</script>

<style>
</style>