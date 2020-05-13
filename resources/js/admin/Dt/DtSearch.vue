<template>
  <v-text-field
    single-line
    hide-details
    prepend-inner-icon="search"
    clearable
    filled
    dense
    rounded
    v-model="value"
    @keyup="search({term: value,page: 1})"
    @click:clear="search({term: '',page: 1})"
    :label="$t('text.search')"
  ></v-text-field>
</template>

<script>
export default {
  props: ["term"],
  data() {
    return {
      value: ""
    };
  },
  methods: {
    search(obj) {
      this.debouncer(() => {
        this.$emit("change", obj);
      });
    },
    debouncer: _.debounce(callback => callback(), 500)
  },
  watch: {
    term: function(value, oldValue) {
      this.value = value;
    }
  }
};
</script>

<style>
</style>