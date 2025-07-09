<script setup lang="ts">
import Footer from '@/components/facade/Footer.vue'
import Header from '@/components/facade/Header.vue'
import { Head } from '@inertiajs/vue3'

defineProps<{
  title: string
}>()
</script>

<template>
  <Head :title="title" />
  <Header />
  <main>
    <slot />
  </main>
  <Footer />
</template>
