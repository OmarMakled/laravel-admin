<template>
  <v-btn icon @click.prevent="onDelete">
    <v-icon>mdi-delete</v-icon>
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
    onDelete() {
      this.$confirm("Please confirm that you want to delete?").then(res => {
        if (res) {
          App.request()
            .delete(this.model, this.id)
            .then(() => {
              this.$emit("delete");
            });
        }
      });
    }
  }
};
</script>

<style>
</style>