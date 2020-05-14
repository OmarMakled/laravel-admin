<template>
  <ValidationObserver ref="observer" v-slot="{}">
    <ValidationProvider name="email" rules="required|email" v-slot="{ errors }">
      <v-text-field label="Email" v-model="email" :error-messages="errors"></v-text-field>
    </ValidationProvider>
    <ValidationProvider name="password" rules="required" v-slot="{ errors }">
      <v-text-field
        @click:append="showPassword = !showPassword"
        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
        :type="showPassword ? 'text' : 'password'"
        label="Password"
        v-model="password"
        :error-messages="errors"
      ></v-text-field>
    </ValidationProvider>
    <v-btn :disabled="loading" color="black" class="white--text" @click="signIn" dark>
      {{ $t('text.signin') }}
      <v-progress-circular v-if="loading" indeterminate :width="2" :size="20"></v-progress-circular>
    </v-btn>
  </ValidationObserver>
</template>

<script>
export default {
  data() {
    return {
      email: "admin@mail.com",
      password: "password",
      loading: false,
      showPassword: false
    };
  },
  methods: {
    signIn() {
      this.loading = true;
      App.$request
        .signIn({
          email: this.email,
          password: this.password
        })
        .then(() => (window.location = "/admin"))
        .catch(error => {
          this.loading = false;
          this.$refs.observer.setErrors(error.response.data.errors);
        });
    }
  }
};
</script>
