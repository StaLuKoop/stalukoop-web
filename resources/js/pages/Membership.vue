<script setup lang="ts">
import PublicLayout from '@/layouts/PublicLayout.vue'

defineOptions({
  layout: (h: any, page: any) => h(PublicLayout, { title: 'Membership' }, () => page),
})
</script>

<template>
  <div></div>
</template>

<style lang="css" scoped></style>
