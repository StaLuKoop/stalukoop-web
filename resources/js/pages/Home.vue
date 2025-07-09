x
<script setup lang="ts">
import PublicLayout from '@/layouts/PublicLayout.vue'

defineOptions({
  layout: (h: any, page: any) => h(PublicLayout, { title: 'Home' }, () => page),
})
</script>

<template>
  <div class="flex h-screen flex-col items-center justify-center gap-4 bg-gradient-to-b from-primary to-destructive text-white">
    <h1 class="text-3xl font-bold">Empowering Your Journey Forward</h1>

    <p class="font-inter">Connection in Every Click</p>
  </div>
</template>
