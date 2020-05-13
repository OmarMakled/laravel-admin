<template>
  <div>
    <div class="row mb-3">
      <div class="col-md-3 col-12">
        <nav-locale @change="onChange($event)"></nav-locale>
      </div>
      <div class="col-md-9 col-12">
        <dt-search @change="onChange($event)" :term="url.term"></dt-search>
      </div>
    </div>
    <v-simple-table>
      <thead>
        <th v-for="(field, index) in fields" :key="index">
          <dt-sort
            v-if="field.sortable"
            :field="field"
            :direction="url.direction"
            :orderBy="url.orderBy"
            @change="onChange($event)"
          >{{ field.title }}</dt-sort>
          <span v-else>{{field.title}}</span>
        </th>
        <th></th>
      </thead>
      <tbody>
        <tr v-for="(row, index) in results" :key="index">
          <td v-for="(td, index) in fields" :key="index">{{row[td.id]}}</td>
          <td>
            <component
              v-for="(action, index) in actions"
              :key="index"
              :is="`action-${action}`"
              :id="row.id"
              :model="model"
              @delete="search"
            ></component>
          </td>
        </tr>
      </tbody>
    </v-simple-table>

    <dt-pagination :pages="pages" :page="page" @change="onChange($event)"></dt-pagination>
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  props: {
    model: {
      required: true
    }
  },
  data: () => {
    return {
      fields: [],
      results: [],
      actions: [],
      url: {},
      pages: null,
      page: null
    };
  },
  methods: {
    onChange(q) {
      this.url = {
        ...this.url,
        ...q
      };
      window.history.pushState(
        null,
        null,
        location.pathname + "?" + new URLSearchParams(this.url).toString()
      );
    },
    search() {
      App.$request
        .get(this.model, this.url, {
          "Accept-Language": this.url.locale || "en"
        })
        .then(data => {
          this.fields = data.fields;
          this.actions = data.actions;
          this.results = data.results.data;
          this.pages = data.results.meta.pagination.total_pages;
          this.page = data.results.meta.pagination.current_page;
        });
    },
    setUrl() {
      this.url = Object.fromEntries(new URLSearchParams(location.search));
    }
  },
  mounted() {
    this.setUrl();
    window.addEventListener("popstate", () => {
      this.setUrl();
    });
  },
  watch: {
    url: {
      handler: function(val, oldVal) {
        this.search();
      },
      deep: true
    }
  }
};
</script>

<style>
</style>
