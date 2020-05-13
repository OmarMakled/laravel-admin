<template>
  <v-pagination ref="pagination" circle v-model="value" :length="pages" color="black"></v-pagination>
</template>

<script>
import { mapState } from "vuex";

export default {
  props: ["pages", "page"],
  data() {
    return {
      value: 1
    };
  },
  mounted() {
    this.$refs.pagination.$on("input", page => {
      this.$emit("change", { page: page });
    });
  },
  watch: {
    page: function(value, oldValue) {
      this.value = value;
    }
  }
};
</script>

<style>
</style>