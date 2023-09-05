<template lang="pug">
  v-container
    v-card
      v-card-text
        v-form(@submit.prevent="toSubmit")
          v-textarea(v-model="form.ips" rows="10" placeholder="Enter ips" )
      v-card-actions
        v-btn(@click.prevent="toSubmit" block) Send
</template>

<script lang="ts">
import api from "../services/api";

export default {
  data: () => ({
    form: {
      ips: '',
    }
  }),

  methods: {
    async toSubmit() {
      let report = await api.create({
        proxies: this.form.ips.split(/\r?\n/)
      })

      this.$router.push(`/report/${report.uid}`)
    }
  }
}
</script>