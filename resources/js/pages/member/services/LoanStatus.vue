<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'

// Breadcrumbs for navigation
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/member/dashboard' },
  { title: 'Loan Status', href: '/member/services/loan-status' },
]

// Dummy loan data for illustration (Replace with dynamic data from backend)
const loanStatus = [
  {
    loanId: '123456',
    loanType: 'Personal Loan',
    amount: 5000,
    date: '2023-01-15',
    status: 'Pending Approval',
    remarks: 'Waiting for verification',
  },
  {
    loanId: '123457',
    loanType: 'Home Loan',
    amount: 15000,
    date: '2023-02-01',
    status: 'Approved',
    remarks: 'Approved and awaiting funds release',
  },
  {
    loanId: '123458',
    loanType: 'Car Loan',
    amount: 10000,
    date: '2023-03-10',
    status: 'Rejected',
    remarks: 'Insufficient documentation',
  },
]
</script>

<template>
  <Head title="Loan Status" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-6">

      <div class="space-y-6">
        <!-- Loan Status Table -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
          <h2 class="text-lg font-semibold">Loan Status Overview</h2>
          <table class="min-w-full table-auto text-sm mt-4">
            <thead>
              <tr>
                <th class="text-left py-2 px-4">Loan ID</th>
                <th class="text-left py-2 px-4">Type</th>
                <th class="text-left py-2 px-4">Amount</th>
                <th class="text-left py-2 px-4">Date</th>
                <th class="text-left py-2 px-4">Status</th>
                <th class="text-left py-2 px-4">Remarks</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="loan in loanStatus" :key="loan.loanId">
                <td class="py-2 px-4">{{ loan.loanId }}</td>
                <td class="py-2 px-4">{{ loan.loanType }}</td>
                <td class="py-2 px-4">${{ loan.amount }}</td>
                <td class="py-2 px-4">{{ loan.date }}</td>
                <td class="py-2 px-4">
                  <span :class="{
                    'text-yellow-600': loan.status === 'Pending Approval',
                    'text-green-600': loan.status === 'Approved',
                    'text-red-600': loan.status === 'Rejected'
                  }">{{ loan.status }}</span>
                </td>
                <td class="py-2 px-4">{{ loan.remarks }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
/* Styles for the Loan Status page */
.text-left {
  text-align: left;
}

.py-2 {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}

.px-4 {
  padding-left: 1rem;
  padding-right: 1rem;
}

.bg-white {
  background-color: white;
}

.text-sm {
  font-size: 0.875rem;
}

.text-xl {
  font-size: 1.25rem;
}

.font-semibold {
  font-weight: 600;
}

.text-blue-600 {
  color: #2563eb;
}

.text-blue-700 {
  color: #1d4ed8;
}

.text-green-600 {
  color: #16a34a;
}

.text-yellow-600 {
  color: #eab308;
}

.text-red-600 {
  color: #dc2626;
}

.shadow-lg {
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.rounded-lg {
  border-radius: 8px;
}

.p-6 {
  padding: 1.5rem;
}

.ml-4 {
  margin-left: 1rem;
}

.table-auto {
  table-layout: auto;
  width: 100%;
}

.min-w-full {
  min-width: 100%;
}

.table-auto th, .table-auto td {
  border-bottom: 1px solid #e2e8f0; /* Light gray border */
}

.table-auto th {
  background-color: #f8fafc;
}
</style>
