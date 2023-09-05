<template lang="pug">
  v-container
    v-list
      v-list-item(v-for="report in reports" :to="{name: 'report', params: {id: report.uid}}")
        v-list-item-content
          v-list-item-title {{ report.uid }}
          v-list-item-subtitle {{ report.completedAt }}
</template>

<script lang="ts">
import api from "../services/api";

export default {
  data: () => ({
    reports: []
  }),

  methods: {
    async load () {
      this.reports = await api.reports()
    },
  },

  mounted() {
    this.load()
  }
}
</script>