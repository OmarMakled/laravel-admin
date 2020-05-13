<template>
  <ValidationObserver ref="observer" v-slot="{}">
    <b-alert variant="success" :show="success">{{$t('text.success_msg')}}</b-alert>
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
    <ValidationProvider name="password" rules v-slot="{ errors }">
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
import { PROFILE } from "../../store/auctions.type";
import { mapState } from "vuex";

export default {
  data() {
    return {
      name: app.user.name,
      email: app.user.email,
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
      if (this.password) {
        credentials.password = this.password;
      }
      this.$store
        .dispatch(PROFILE, credentials)
        .then(() => {})
        .catch(error => {
          this.$refs.observer.setErrors(error.response.data.errors);
        });
    }
  }
};
</script>
