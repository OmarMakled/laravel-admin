<template>
  <ValidationObserver ref="observer" v-slot="{invalid}">
    <ValidationProvider name="name" rules="required" v-slot="{ errors }">
      <v-text-field label="Name" v-model="user.name" :error-messages="errors"></v-text-field>
    </ValidationProvider>
    <ValidationProvider name="email" rules="required|email" v-slot="{ errors }">
      <v-text-field label="Email" v-model="user.email" :error-messages="errors"></v-text-field>
    </ValidationProvider>
    <ValidationProvider name="password" rules="min:8" v-slot="{ errors }">
      <v-text-field
        @click:append="showPassword = !showPassword"
        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
        :type="showPassword ? 'text' : 'password'"
        label="New Password"
        v-model="newPassword"
        :error-messages="errors"
      ></v-text-field>
    </ValidationProvider>
    <v-btn
      class="white--text"
      :disabled="invalid || loading"
      block
      color="black"
      rounded
      @click="onSave"
    >
      {{ $t('text.save') }}
      <v-progress-circular v-if="loading" indeterminate :width="2" :size="20"></v-progress-circular>
    </v-btn>
  </ValidationObserver>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      user: App.config.user,
      newPassword: null,
      showPassword: false
    };
  },
  methods: {
    onSave() {
      this.loading = true;
      let data = {
        name: this.user.name,
        email: this.user.email
      };
      if (this.newPassword) {
        data.password = this.newPassword;
      }
      App.$request
        .updateProfile(data)
        .catch(error => {
          this.$refs.observer.setErrors(error.response.data.errors);
        })
        .then(() => {
          this.loading = false;
        });
    }
  }
};
</script>
