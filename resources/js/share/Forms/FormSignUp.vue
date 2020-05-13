<template>
  <ValidationObserver ref="observer" v-slot="{}">
    <ValidationProvider name="name" rules="required" v-slot="{ errors }">
      <b-form-group :invalid-feedback="errors[0]">
        <b-form-input v-model="name" placeholder :state="errors.length >= 1 ? false : null"></b-form-input>
      </b-form-group>
    </ValidationProvider>
    <ValidationProvider name="email" rules="required|email" v-slot="{ errors }">
      <b-form-group :invalid-feedback="errors[0]">
        <b-form-input v-model="email" placeholder :state="errors.length >= 1 ? false : null"></b-form-input>
      </b-form-group>
    </ValidationProvider>
    <ValidationProvider name="password" rules="required" v-slot="{ errors }">
      <b-form-group :invalid-feedback="errors[0]">
        <b-form-input
          v-model="password"
          placeholder
          :type="'password'"
          :state="errors.length >= 1 ? false : null"
        ></b-form-input>
      </b-form-group>
    </ValidationProvider>
    <b-button :disabled="loading" variant="outline-primary" block @click="signUp">
      {{ $t('text.signup') }}
      <b-spinner v-if="loading" small></b-spinner>
    </b-button>
  </ValidationObserver>
</template>

<script>
import { SIGNUP } from "../../store/auctions.type";
import { mapState } from "vuex";

export default {
  data() {
    return {
      name: null,
      email: null,
      password: null
    };
  },
  computed: {
    ...mapState({
      loading: state => state.loading,
      error: state => state.error
    })
  },
  methods: {
    signUp() {
      this.$store
        .dispatch(SIGNUP, {
          name: this.name,
          email: this.email,
          password: this.password
        })
        .then(() => {
          location.reload();
        })
        .catch(error => {
          this.$refs.observer.setErrors(error.response.data.errors);
        });
    }
  }
};
</script>
