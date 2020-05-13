<template>
  <v-select
    hide-details
    filled
    dense
    rounded
    :value="locale"
    :items="locales"
    @change="change($event)"
  ></v-select>
</template>

<script>
export default {
  methods: {
    change(locale) {
      this.$emit("change", { locale: locale });
    }
  },
  data() {
    return {
      url: Object.fromEntries(new URLSearchParams(location.search)),
      locales: ["ar", "en"]
    };
  },
  computed: {
    locale: function() {
      return this.url.locale || "en";
    }
  }
};
</script>

<style>
</style>