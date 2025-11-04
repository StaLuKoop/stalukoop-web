<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'

// 🔹 Breadcrumb navigation
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/admin/dashboard' },
  { title: 'Credit Scoring', href: '/admin/management/creditscoring' },
]

// 🔹 Sample data
const creditScores = ref([
  {
    loanId: '101',
    memberName: 'Jane Doe',
    avgCreditScore: 750,
    loanType: 'Regular Loan',
    loanCreditScore: 800,
  },
  {
    loanId: '102',
    memberName: 'John Smith',
    avgCreditScore: 720,
    loanType: 'Regular Loan',
    loanCreditScore: 740,
  },
  {
    loanId: '103',
    memberName: 'Ella Santos',
    avgCreditScore: 770,
    loanType: 'Regular Loan',
    loanCreditScore: 790,
  },
])
</script>

<template>
  <Head title="Credit Scoring" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col gap-6 p-6">
      <h1 class="text-2xl font-bold text-gray-800">Credit Scoring</h1>

      <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
          <thead class="bg-gray-50 text-gray-700">
            <tr>
              <th class="px-4 py-3 text-left font-semibold">Loan ID</th>
              <th class="px-4 py-3 text-left font-semibold">Member Name</th>
              <th class="px-4 py-3 text-left font-semibold">Average Credit Score</th>
              <th class="px-4 py-3 text-left font-semibold">Loan Type</th>
              <th class="px-4 py-3 text-left font-semibold">Loan Credit Score</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 bg-white">
            <tr
              v-for="(item, index) in creditScores"
              :key="index"
              class="hover:bg-gray-50 transition"
            >
              <td class="px-4 py-3 font-medium text-gray-900">{{ item.loanId }}</td>
              <td class="px-4 py-3">{{ item.memberName }}</td>
              <td class="px-4 py-3">
                <span
                  :class="[
                    'rounded-full px-3 py-1 text-xs font-semibold',
                    item.avgCreditScore >= 750
                      ? 'bg-green-100 text-green-700'
                      : item.avgCreditScore >= 700
                      ? 'bg-yellow-100 text-yellow-700'
                      : 'bg-red-100 text-red-700',
                  ]"
                >
                  {{ item.avgCreditScore }}
                </span>
              </td>
              <td class="px-4 py-3">{{ item.loanType }}</td>
              <td class="px-4 py-3">
                <span
                  :class="[
                    'rounded-full px-3 py-1 text-xs font-semibold',
                    item.loanCreditScore >= 750
                      ? 'bg-green-100 text-green-700'
                      : item.loanCreditScore >= 700
                      ? 'bg-yellow-100 text-yellow-700'
                      : 'bg-red-100 text-red-700',
                  ]"
                >
                  {{ item.loanCreditScore }}
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </AppLayout>
</template>
