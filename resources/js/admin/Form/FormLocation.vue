<template>
  <div>
    <ValidationProvider name="title" rules="required" v-slot="{ errors }">
      <v-text-field label="Title" v-model="entity.title" :error-messages="errors"></v-text-field>
    </ValidationProvider>
  </div>
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
