<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'

defineProps<{ status: string }>()

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Dashboard',
    href: '/member/dashboard',
  },
]
</script>

<template>
  <Head title="Dashboard" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
      <template v-if="status === 'pending'">
        <div class="space-y-4 rounded-lg border border-yellow-400 bg-yellow-100 p-6 text-yellow-800 shadow">
          <h2 class="text-lg font-semibold">Membership Pending</h2>

          <p>
            Your membership is still pending approval. To access <u>full dashboard features</u>, please complete the
            following requirements:
          </p>

          <ul class="list-inside list-disc space-y-1">
            <li>Attend the PMES (Pre-Membership Education Seminar)</li>
            <li>Fill out and submit the Membership Application Form</li>
            <li>Submit a valid government-issued ID</li>
            <li>Pay the initial membership fee</li>
          </ul>

          <p>
            You may fill out the membership form online:
            <a href="/member/forms/member-application" class="ml-1 text-blue-700 underline hover:text-blue-900">
              Complete Member Form
            </a>
          </p>

          <p class="text-sm italic">For further assistance, please contact the cooperative office.</p>
        </div>
      </template>

      <template v-else>
        <!-- Full member dashboard content here -->
        <h1 class="text-xl font-bold">Welcome to your Dashboard</h1>
      </template>
    </div>
  </AppLayout>
</template>
