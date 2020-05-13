<template>
  <div>
    <ValidationProvider name="title" rules="required" v-slot="{ errors }">
      <v-text-field label="Title" v-model="entity.title" :error-messages="errors"></v-text-field>
    </ValidationProvider>
    <ValidationProvider name="type" rules="required" v-slot="{ errors }">
      <v-select
        v-model="entity.type"
        :items="entity.form.data.types"
        item-text="title"
        item-value="id"
        label="Type"
        :error-messages="errors"
      ></v-select>
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
