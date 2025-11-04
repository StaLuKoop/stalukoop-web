<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'

// 🔹 Breadcrumbs
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/admin/dashboard' },
  { title: 'Loan Applications', href: '/admin/management/loan-applications' },
]

// 🔹 Mock Data
const loanApplications = ref([
  {
    id: '001',
    memberName: 'John Doe',
    loanType: 'Educational',
    amount: 30000,
    mlPrediction: 'Low',
    creditScore: 742,
    creditRating: 'Good',
    status: 'Pending',
    dateApplied: '2025-10-28',
    term: 6,
    interest: 2.5,
    proofOfIncome: '/storage/docs/john_income.pdf',
    idDocument: '/storage/docs/john_id.pdf',
  },
])

// 🔹 Modal state
const selectedLoan = ref<any>(null)
const showModal = ref(false)

// 🔹 Methods
const viewApplication = (loan: any) => {
  selectedLoan.value = loan
  showModal.value = true
}

const closeModal = () => {
  showModal.value = false
  selectedLoan.value = null
}

const approveApplication = (id: string) => {
  if (confirm(`Approve Loan Application #${id}?`)) {
    alert(`Loan Application #${id} approved.`)
  }
}

const rejectApplication = (id: string) => {
  if (confirm(`Reject Loan Application #${id}?`)) {
    alert(`Loan Application #${id} rejected.`)
  }
}
</script>

<template>
  <Head title="Loan Applications" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-6">
      <h1 class="text-2xl font-bold">Loan Applications</h1>

      <!-- Table -->
      <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
          <thead class="bg-gray-50 text-gray-700">
            <tr>
              <th class="px-4 py-3 text-left font-semibold">Loan ID</th>
              <th class="px-4 py-3 text-left font-semibold">Member Name</th>
              <th class="px-4 py-3 text-left font-semibold">Loan Type</th>
              <th class="px-4 py-3 text-left font-semibold">Amount</th>
              <th class="px-4 py-3 text-left font-semibold">ML Prediction</th>
              <th class="px-4 py-3 text-left font-semibold">Credit Score</th>
              <th class="px-4 py-3 text-left font-semibold">Status</th>
              <th class="px-4 py-3 text-center font-semibold">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 bg-white">
            <tr v-for="loan in loanApplications" :key="loan.id">
              <td class="px-4 py-3 font-medium text-gray-900">{{ loan.id }}</td>
              <td class="px-4 py-3">{{ loan.memberName }}</td>
              <td class="px-4 py-3">{{ loan.loanType }}</td>
              <td class="px-4 py-3">₱{{ loan.amount.toLocaleString() }}</td>
              <td class="px-4 py-3">Predicted Risk: {{ loan.mlPrediction }}</td>
              <td class="px-4 py-3">{{ loan.creditScore }} ({{ loan.creditRating }})</td>
              <td class="px-4 py-3">
                <span
                  :class="[
                    'rounded-full px-3 py-1 text-xs font-semibold',
                    loan.status === 'Pending' ? 'bg-yellow-100 text-yellow-700' :
                    loan.status === 'Approved' ? 'bg-green-100 text-green-700' :
                    loan.status === 'Rejected' ? 'bg-red-100 text-red-700' :
                    'bg-blue-100 text-blue-700'
                  ]"
                >
                  {{ loan.status }}
                </span>
              </td>
              <td class="px-4 py-3 text-center space-x-2">
                <button
                  class="rounded bg-blue-400 px-3 py-1 text-white hover:bg-blue-600"
                  @click="viewApplication(loan)"
                >
                  View
                </button>
                <button
                  class="rounded bg-green-400 px-3 py-1 text-white hover:bg-green-600"
                  @click="approveApplication(loan.id)"
                >
                  Approve
                </button>
                <button
                  class="rounded bg-red-400 px-3 py-1 text-white hover:bg-red-600"
                  @click="rejectApplication(loan.id)"
                >
                  Reject
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal -->
    <div
      v-if="showModal"
      class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
    >
      <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full p-6 relative animate-fadeIn">
        <button
          @click="closeModal"
          class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-lg font-bold"
        >
          ✕
        </button>

        <h2 class="text-xl font-bold mb-4">Loan Application Details</h2>

        <div v-if="selectedLoan" class="space-y-3 text-sm text-gray-700">
          <p><strong>Loan ID:</strong> {{ selectedLoan.id }}</p>
          <p><strong>Member Name:</strong> {{ selectedLoan.memberName }}</p>
          <p><strong>Loan Type:</strong> {{ selectedLoan.loanType }}</p>
          <p><strong>Amount:</strong> ₱{{ selectedLoan.amount.toLocaleString() }}</p>
          <p><strong>Term:</strong> {{ selectedLoan.term }} months</p>
          <p><strong>Interest:</strong> {{ selectedLoan.interest }}%</p>
          <p><strong>Credit Score:</strong> {{ selectedLoan.creditScore }} ({{ selectedLoan.creditRating }})</p>
          <p><strong>Date Applied:</strong> {{ selectedLoan.dateApplied }}</p>
          <hr class="my-3" />
          <h3 class="font-semibold">Supporting Documents:</h3>
          <ul class="list-disc list-inside text-blue-600">
            <li>
              <a :href="selectedLoan.proofOfIncome" target="_blank" class="hover:underline">
                Proof of Income
              </a>
            </li>
            <li>
              <a :href="selectedLoan.idDocument" target="_blank" class="hover:underline">
                Valid ID / Document
              </a>
            </li>
          </ul>
        </div>

        <div class="flex justify-end gap-3 mt-6">
          <button
            class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-800"
            @click="closeModal"
          >
            Close
          </button>
          <button
            class="px-4 py-2 rounded bg-green-400 hover:bg-green-200 text-white"
            @click="approveApplication(selectedLoan.id)"
          >
            Approve
          </button>
          <button
            class="px-4 py-2 rounded bg-red-400 hover:bg-red-200 text-white"
            @click="rejectApplication(selectedLoan.id)"
          >
            Reject
          </button>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
.animate-fadeIn {
  animation: fadeIn 0.25s ease-out;
}
</style>
