<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/admin/dashboard' },
  { title: 'Loan Applications', href: '/admin/management/loan-applications' },
]

// 🧩 Mock Data (replace later with backend)
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
    purpose: 'Tuition and school expenses',
    collateral: 'N/A',
    monthlyIncome: '₱20,000',
    remarks: '',
  },
])

// 🧩 State
const selectedLoan = ref<any>(null)
const showModal = ref(false)
const rejectMode = ref(false)
const rejectReason = ref('')

// 🧩 Methods
const viewApplication = (loan: any) => {
  selectedLoan.value = loan
  showModal.value = true
  rejectMode.value = false
  rejectReason.value = ''
}

const closeModal = () => {
  showModal.value = false
  selectedLoan.value = null
  rejectMode.value = false
  rejectReason.value = ''
}

const approveApplication = (id: string) => {
  if (confirm(`Approve Loan Application #${id}?`)) {
    alert(`✅ Loan Application #${id} approved.`)
    selectedLoan.value.status = 'Approved'
    closeModal()
  }
}

const toggleReject = () => {
  rejectMode.value = !rejectMode.value
}

const submitReject = (id: string) => {
  if (!rejectReason.value.trim()) {
    alert('Please enter a reason for rejection.')
    return
  }
  if (confirm(`Reject Loan Application #${id}?`)) {
    alert(`❌ Loan Application #${id} rejected.\nReason: ${rejectReason.value}`)
    selectedLoan.value.status = 'Rejected'
    selectedLoan.value.remarks = rejectReason.value
    closeModal()
  }
}
</script>

<template>
  <Head title="Loan Applications" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col gap-6 p-6">
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
              <th class="px-4 py-3 text-left font-semibold">Credit Score</th>
              <th class="px-4 py-3 text-left font-semibold">Status</th>
              <th class="px-4 py-3 text-center font-semibold">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 bg-white">
            <tr v-for="loan in loanApplications" :key="loan.id">
              <td class="px-4 py-3 font-medium">{{ loan.id }}</td>
              <td class="px-4 py-3">{{ loan.memberName }}</td>
              <td class="px-4 py-3">{{ loan.loanType }}</td>
              <td class="px-4 py-3">₱{{ loan.amount.toLocaleString() }}</td>
              <td class="px-4 py-3">{{ loan.creditScore }} ({{ loan.creditRating }})</td>
              <td class="px-4 py-3">
                <span
                  :class="[
                    'rounded-full px-3 py-1 text-xs font-semibold',
                    loan.status === 'Pending' ? 'bg-yellow-100 text-yellow-700' :
                    loan.status === 'Approved' ? 'bg-green-100 text-green-700' :
                    loan.status === 'Rejected' ? 'bg-red-100 text-red-700' :
                    'bg-gray-100 text-gray-600'
                  ]"
                >
                  {{ loan.status }}
                </span>
              </td>
              <td class="px-4 py-3 text-center">
                <button
                  class="rounded bg-blue-500 px-3 py-1 text-white hover:bg-blue-600"
                  @click="viewApplication(loan)"
                >
                  View
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
      class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm"
    >
      <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full p-6 relative animate-fadeIn">
        <button
          @click="closeModal"
          class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-lg font-bold"
        >
          ✕
        </button>

        <h2 class="text-xl font-bold mb-4">Loan Application Details</h2>

        <div v-if="selectedLoan" class="space-y-2 text-sm text-gray-700">
          <p><strong>Loan ID:</strong> {{ selectedLoan.id }}</p>
          <p><strong>Member Name:</strong> {{ selectedLoan.memberName }}</p>
          <p><strong>Loan Type:</strong> {{ selectedLoan.loanType }}</p>
          <p><strong>Purpose:</strong> {{ selectedLoan.purpose }}</p>
          <p><strong>Amount:</strong> ₱{{ selectedLoan.amount.toLocaleString() }}</p>
          <p><strong>Term:</strong> {{ selectedLoan.term }} months</p>
          <p><strong>Interest:</strong> {{ selectedLoan.interest }}%</p>
          <p><strong>Collateral:</strong> {{ selectedLoan.collateral }}</p>
          <p><strong>Monthly Income:</strong> {{ selectedLoan.monthlyIncome }}</p>
          <p><strong>Credit Score:</strong> {{ selectedLoan.creditScore }} ({{ selectedLoan.creditRating }})</p>
          <p><strong>Date Applied:</strong> {{ selectedLoan.dateApplied }}</p>
          <hr class="my-3" />

          <h3 class="font-semibold">Supporting Documents:</h3>
          <ul class="list-disc list-inside text-blue-600">
            <li><a :href="selectedLoan.proofOfIncome" target="_blank" class="hover:underline">Proof of Income</a></li>
            <li><a :href="selectedLoan.idDocument" target="_blank" class="hover:underline">Valid ID / Document</a></li>
          </ul>

          <p v-if="selectedLoan.remarks && selectedLoan.status === 'Rejected'" class="mt-3 text-red-600">
            <strong>Rejection Reason:</strong> {{ selectedLoan.remarks }}
          </p>
        </div>

        <!-- Actions -->
        <div class="flex justify-end gap-3 mt-6">
          <button
            class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-800"
            @click="closeModal"
          >
            Close
          </button>
          <button
            class="px-4 py-2 rounded bg-green-500 hover:bg-green-600 text-white"
            @click="approveApplication(selectedLoan.id)"
          >
            Approve
          </button>
          <button
            v-if="!rejectMode"
            class="px-4 py-2 rounded bg-red-500 hover:bg-red-600 text-white"
            @click="toggleReject"
          >
            Reject
          </button>
        </div>

        <!-- Reject Reason -->
        <div v-if="rejectMode" class="mt-4 border-t pt-4">
          <label class="block text-sm font-medium mb-2">Reason for Rejection:</label>
          <textarea
            v-model="rejectReason"
            rows="3"
            class="w-full border rounded-lg p-2 text-sm"
            placeholder="Enter reason here..."
          ></textarea>

          <div class="flex justify-end gap-2 mt-3">
            <button
              class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 text-gray-700"
              @click="toggleReject"
            >
              Cancel
            </button>
            <button
              class="px-3 py-1 rounded bg-red-500 hover:bg-red-600 text-white"
              @click="submitReject(selectedLoan.id)"
            >
              Confirm Reject
            </button>
          </div>
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
