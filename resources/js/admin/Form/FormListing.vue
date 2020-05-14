<template>
  <div>
    <ValidationProvider name="title" rules="required" v-slot="{ errors }">
      <v-text-field label="Title" v-model="entity.title" :error-messages="errors"></v-text-field>
    </ValidationProvider>

    <ValidationProvider name="location" rules="required" v-slot="{ errors }">
      <v-select
        v-model="entity.location_id"
        :items="entity.form.data.locations.data"
        item-text="title"
        item-value="id"
        label="Location"
        :error-messages="errors"
      ></v-select>
    </ValidationProvider>

    <ValidationProvider name="amenities">
      <v-select
        v-model="entity.amenities"
        :items="entity.form.data.amenities.data"
        attach
        chips
        label="Amenities"
        item-text="title"
        item-value="id"
        multiple
      ></v-select>
    </ValidationProvider>

    <ValidationProvider name="type">
      <v-select
        v-model="entity.type"
        :items="entity.form.data.types.data"
        item-text="title"
        item-value="id"
        label="Type"
      ></v-select>
    </ValidationProvider>

    <ValidationProvider name="price" rules="required|decimal" v-slot="{ errors }">
      <v-text-field label="Price" v-model="entity.price" :error-messages="errors"></v-text-field>
    </ValidationProvider>

    <ValidationProvider name="size" rules="required|decimal" v-slot="{ errors }">
      <v-text-field label="Size" v-model="entity.size" :error-messages="errors"></v-text-field>
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
