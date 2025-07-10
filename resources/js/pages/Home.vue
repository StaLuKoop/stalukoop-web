<script setup lang="ts">
import PublicLayout from '@/layouts/PublicLayout.vue'

defineOptions({
  layout: (h: any, page: any) => h(PublicLayout, { title: 'Home' }, () => page),
})
</script>

<template>
  <div>
    
  </div>
</template>
