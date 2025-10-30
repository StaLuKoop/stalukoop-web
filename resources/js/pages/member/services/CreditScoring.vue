<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'

// Breadcrumbs for navigation
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/member/dashboard' },
  { title: 'Credit Scoring', href: '/member/services/credit-scoring' },
]
</script>

<template>
  <Head title="Credit Scoring"/>

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
      <h1 class="text-xl font-semibold">Credit Scoring</h1>

      <div class="space-y-4 p-6">
        <p>Current Credit Score: <span class="font-semibold text-lg">750</span></p> <!-- Replace this with dynamic data if necessary -->
        
        <h2 class="font-semibold text-md">Breakdown</h2>
        <ul class="list-inside list-disc space-y-1">
          <li>Payment History: Excellent</li>
          <li>Loan-to-Savings Ratio: 50%</li>
          <li>Outstanding Balance: $5000</li>
        </ul>

        <h2 class="font-semibold text-md">Tips to Improve Your Score</h2>
        <ul class="list-inside list-disc space-y-1">
          <li>Pay bills on time</li>
          <li>Reduce credit utilization</li>
          <li>Maintain a good credit mix</li>
        </ul>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
/* Styles for the Credit Scoring page */
.space-y-4 {
  margin-bottom: 16px;
}

.font-semibold {
  font-weight: 600;
}

.text-lg {
  font-size: 1.125rem;
}

.text-md {
  font-size: 1rem;
}

.text-sm {
  font-size: 0.875rem;
}

.text-yellow-800 {
  color: #9c7e00;
}

.bg-yellow-100 {
  background-color: #fef8c7;
}

.border-yellow-400 {
  border-color: #fbbf24;
}

.shadow {
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
}

.rounded-lg {
  border-radius: 8px;
}

.p-6 {
  padding: 1.5rem;
}

.ml-1 {
  margin-left: 0.25rem;
}

.text-blue-700 {
  color: #1d4ed8;
}

.underline {
  text-decoration: underline;
}

.hover\:text-blue-900:hover {
  color: #1e40af;
}

.list-inside {
  list-style-position: inside;
}

.list-disc {
  list-style-type: disc;
}
</style>
