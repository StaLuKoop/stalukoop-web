<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/member/dashboard' },
  { title: 'Pre-Membership Education Seminar', href: '/member/requirements/pre-membership-seminar' },
]
</script>

<template>
  <Head title="Pre-Membership Education Seminar" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
      <h1 class="text-xl font-semibold">Pre-Membership Education Seminar</h1>
    </div>
  </AppLayout>
</template>
