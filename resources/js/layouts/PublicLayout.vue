<script setup lang="ts">
import Footer from '@/components/facade/Footer.vue'
import Header from '@/components/facade/Header.vue'
import { Head } from '@inertiajs/vue3'
import '@fortawesome/fontawesome-free/css/all.min.css';

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
