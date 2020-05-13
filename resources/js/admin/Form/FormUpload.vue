<template>
  <b-container fluid class="p-4">
    <v-row v-if="entity">
      <v-col v-for="(image, index) in entity.images.data" :key="index" cols="12" sm="4">
        <v-card class="pa-2">
          <v-img class="white--text align-end" height="200px" :src="image.thumb"></v-img>
          <v-card-actions>
            <v-btn @click="onDelete(image.id)" icon small>
              <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-spacer></v-spacer>
            <v-btn :href="image.large" icon small>
              <v-icon>mdi-share</v-icon>
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
    <v-btn dark rounded color="primary" block id="uppy">{{$t('text.upload_photo')}}</v-btn>
    <uppy :url="`/api/upload/${model}/${id}`" @complete="find"></uppy>
  </b-container>
</template>

<script>
export default {
  props: {
    model: {
      required: true,
      type: String
    },
    id: {
      required: true
    }
  },
  data: () => {
    return {
      entity: null
    };
  },
  methods: {
    find() {
      App.$request.find(this.model, this.id).then(response => {
        this.entity = response.data;
      });
    },
    onDelete(id) {
      this.$confirm("Please confirm that you want to delete?").then(res => {
        if (res) {
          App.$request.delete("media", id).then(() => this.find());
        }
      });
    }
  },
  mounted() {
    this.find();
  }
};
</script>
