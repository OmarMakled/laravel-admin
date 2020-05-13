<template>
  <b-modal id="modal-login" title hide-footer :header-border-variant="'0'">
    <template v-slot:modal-header="{ close }">
      <button class="close" @click="close()">
        <b-icon icon="x" font-scale="1" variant="muted"></b-icon>
      </button>
    </template>
    <div class="p-4">
      <component :is="component" @change="component = $event"></component>
      <p class="text-center mt-5">
        <a
          href
          v-if="component == 'FormSignIn'"
          class="text-decoration-none"
          @click.prevent="component = 'FormSignUp'"
        >{{$t('text.signup')}}</a>
        <a
          href
          v-else
          class="text-decoration-none"
          @click.prevent="component = 'FormSignIn'"
        >{{$t('text.signin')}}</a>
      </p>
    </div>
  </b-modal>
</template>

<script>
export default {
  data() {
    return {
      component: "FormSignIn"
    };
  }
};
</script>
