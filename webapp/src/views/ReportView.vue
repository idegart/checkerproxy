<template lang="pug">
  v-container
    v-list(v-if="report")
      v-list-item(v-for="proxy in report.proxies")
        template(v-if="proxy.completed_at && proxy.protocol")
          v-list-item-avatar(color="green")
        template(v-else-if="proxy.completed_at && !proxy.protocol")
          v-list-item-avatar(color="red")
        template(v-else-if="!proxy.completed_at")
          v-list-item-avatar(color="warning")
        v-list-item-content
          v-list-item-title {{ proxy.ip_address }}
          v-list-item-subtitle {{ proxy.protocol }} - {{ proxy.country }} - {{ proxy.speed }} - {{ proxy.completed_at }}
</template>

<script lang="ts">
import api from "../services/api";
import Report from "../models/Report";

export default {
  props: ['id'],

  data: () => ({
    report: <Report>null
  }),

  methods: {
    async load () {
      this.report = await api.report(this.id)
    },
  },

  mounted() {
    this.load()
  }
}
</script>