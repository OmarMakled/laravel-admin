<template>
  <ValidationProvider name="title" rules="required" v-slot="{ errors }">
    <b-form-group :invalid-feedback="errors[0]" :label="$t('text.name')">
      <b-form-input
        v-model="entity.title"
        size="lg"
        placeholder
        :state="errors.length >= 1 ? false : null"
      ></b-form-input>
    </b-form-group>
  </ValidationProvider>
</template>

<script>
export default {
  props: {
    entity: {
      required: true
    }
  }
};
</script>
