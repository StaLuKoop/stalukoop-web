<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import { Button } from '@/components/ui/button'
import { FileDown, FileBarChart, Users, CreditCard, HandCoins } from 'lucide-vue-next'

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/admin/dashboard' },
  { title: 'Report', href: '/admin/utility/reports' },
]

// Simulated function (replace later with backend Inertia route)
const generateReport = (type: string) => {
  alert(`Generating ${type} report... (PDF download coming soon!)`)
}
</script>

<template>
  <Head title="Reports" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col gap-6 p-6">
      <h1 class="text-2xl font-bold text-gray-800">Reports</h1>

      <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Generate Reports for:</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          <!-- Total Loans -->
          <div class="flex flex-col items-center justify-center gap-3 rounded-lg border border-gray-100 bg-gray-50 p-5 hover:shadow-md transition">
            <HandCoins class="h-10 w-10 text-indigo-600" />
            <p class="font-medium text-gray-700">Total Loans</p>
            <Button @click="generateReport('Total Loans')" class="gap-2">
              <FileDown class="h-4 w-4" /> Download PDF
            </Button>
          </div>

          <!-- Members -->
          <div class="flex flex-col items-center justify-center gap-3 rounded-lg border border-gray-100 bg-gray-50 p-5 hover:shadow-md transition">
            <Users class="h-10 w-10 text-green-600" />
            <p class="font-medium text-gray-700">Members</p>
            <Button @click="generateReport('Members')" class="gap-2">
              <FileDown class="h-4 w-4" /> Download PDF
            </Button>
          </div>

          <!-- Payments -->
          <div class="flex flex-col items-center justify-center gap-3 rounded-lg border border-gray-100 bg-gray-50 p-5 hover:shadow-md transition">
            <CreditCard class="h-10 w-10 text-blue-600" />
            <p class="font-medium text-gray-700">Payments</p>
            <Button @click="generateReport('Payments')" class="gap-2">
              <FileDown class="h-4 w-4" /> Download PDF
            </Button>
          </div>

          <!-- Credit Scores -->
          <div class="flex flex-col items-center justify-center gap-3 rounded-lg border border-gray-100 bg-gray-50 p-5 hover:shadow-md transition">
            <FileBarChart class="h-10 w-10 text-yellow-600" />
            <p class="font-medium text-gray-700">Credit Scores</p>
            <Button @click="generateReport('Credit Scores')" class="gap-2">
              <FileDown class="h-4 w-4" /> Download PDF
            </Button>
          </div>
        </div>

      </div>
    </div>
  </AppLayout>
</template>
