<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/admin/dashboard' },
  { title: 'Calculator', href: '/admin/utility/calculator' },
]
</script>

<template>
  <Head title="Calculator" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Calculator</h1>
      </div>
    </div>
  </AppLayout>
</template>
