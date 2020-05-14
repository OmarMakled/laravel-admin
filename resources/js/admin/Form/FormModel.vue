<template>
  <v-form>
    <div class="row mb-3">
      <div class="col-md-3 col-12">
        <nav-locale @change="onChange($event)"></nav-locale>
      </div>
    </div>
    <ValidationObserver ref="observer" v-slot="{invalid}">
      <component :is="component" :entity="entity" v-if="entity"></component>
      <v-btn
        :disabled="invalid || loading"
        block
        color="black"
        class="mt-4 white--text"
        rounded
        @click="onSave"
      >
        {{ $t('text.save') }}
        <v-progress-circular v-if="loading" indeterminate :width="2" :size="20"></v-progress-circular>
      </v-btn>
    </ValidationObserver>
  </v-form>
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
  computed: {
    component: function() {
      return `form-${this.model}`;
    }
  },
  data: () => {
    return {
      locale: null,
      loading: false,
      entity: null
    };
  },
  methods: {
    find() {
      App.$request
        .find(this.model, this.id, {
          "Accept-Language": this.locale
        })
        .then(response => {
          this.entity = response.data;
        });
    },
    onChange(q) {
      this.locale = q.locale;
      window.history.pushState(
        null,
        null,
        location.pathname + "?" + new URLSearchParams(q).toString()
      );
    },
    onSave() {
      this.loading = true;
      let request;
      if (this.entity.id) {
        request = App.$request.put(this.model, this.entity.id, this.entity, {
          "Accept-Language": this.locale
        });
      } else {
        request = App.$request.post(this.model, this.entity, {
          "Accept-Language": this.locale
        });

        request.then(response => {
          window.location =
            location.pathname +
            `/${response.data.id}?` +
            new URLSearchParams({ locale: this.locale }).toString();
        });
      }

      request
        .catch(error => {
          this.$refs.observer.setErrors(error.response.data.errors);
        })
        .then(() => {
          this.loading = false;
        });
    },
    setLocale() {
      this.locale =
        Object.fromEntries(new URLSearchParams(location.search)).locale || "en";
    }
  },
  mounted() {
    this.setLocale();
    window.addEventListener("popstate", () => {
      this.setLocale();
    });
  },
  watch: {
    locale: {
      handler: function(val, oldVal) {
        this.find();
      }
    }
  }
};
</script>

