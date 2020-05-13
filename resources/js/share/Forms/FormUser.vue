<template>
  <ValidationObserver ref="observer" v-slot="{}">
    <ValidationProvider name="name" rules="required" v-slot="{ errors }">
      <b-form-group :invalid-feedback="errors[0]" :label="$t('text.name')">
        <b-form-input
          v-model="name"
          size="lg"
          placeholder
          :state="errors.length >= 1 ? false : null"
        ></b-form-input>
      </b-form-group>
    </ValidationProvider>
    <ValidationProvider name="email" rules="required|email" v-slot="{ errors }">
      <b-form-group :invalid-feedback="errors[0]">
        <b-form-input
          size="lg"
          v-model="email"
          placeholder
          :state="errors.length >= 1 ? false : null"
        ></b-form-input>
      </b-form-group>
    </ValidationProvider>
    <ValidationProvider name="password" rules="required" v-slot="{ errors }">
      <b-form-group :invalid-feedback="errors[0]">
        <b-form-input
          size="lg"
          v-model="password"
          placeholder
          :type="'password'"
          :state="errors.length >= 1 ? false : null"
        ></b-form-input>
      </b-form-group>
    </ValidationProvider>
    <b-button :disabled="loading" variant="outline-primary" block @click="save">
      {{ $t('text.save') }}
      <b-spinner v-if="loading" small></b-spinner>
    </b-button>
  </ValidationObserver>
</template>

<script>
import { CREATE_USER, UPDATE_USER } from "../../store/auctions.type";
import { mapState } from "vuex";

export default {
  props: {
    entity: {
      required: true
    },
    to: {
      required: false
    }
  },
  data() {
    return {
      name: this.entity.name,
      email: this.entity.email,
      password: null
    };
  },
  computed: {
    ...mapState({
      loading: state => state.loading,
      success: state => state.success,
      error: state => state.error
    })
  },
  methods: {
    save() {
      let credentials = {
        name: this.name,
        email: this.email
      };
      let request;

      if (this.password) {
        credentials.password = this.password;
      }

      if (!this.entity.id) {
        request = this.$store.dispatch(CREATE_USER, credentials);
      } else {
        request = this.$store.dispatch(UPDATE_USER, {
          id: this.entity.id,
          credentials
        });
      }

      request
        .then(() => {
          if (!this.to) {
            location.reload();
          }
          location.href = this.to;
        })
        .catch(error => {
          this.$refs.observer.setErrors(error.response.data.errors);
        });
    }
  }
};
</script>
