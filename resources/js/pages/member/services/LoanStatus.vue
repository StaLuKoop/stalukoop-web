<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/member/dashboard' },
  { title: 'Loan Status', href: '/member/services/loan-status' },
]

// Dummy data (replace later with backend)
const loanHistory = ref([
  {
    loanId: 'L-1023',
    loanType: 'Regular Loan',
    amount: 25000,
    balance: 21086,
    status: 'Ongoing',
    nextDueDate: '2025-12-10',
    interest: 2.5,
    startDate: '2025-11-10',
    savingsDeposit: 500,
    shareCapital: 500,
    lpp: 150,
    serviceFee: 750,
    netProceeds: 23100,
  },
  {
    loanId: 'L-1024',
    loanType: 'Emergency Loan',
    amount: 10000,
    balance: 10000,
    status: 'Pending',
  },
  {
    loanId: 'L-1025',
    loanType: 'Home Loan',
    amount: 15000,
    balance: 0,
    status: 'Completed',
  },
  {
    loanId: 'L-1026',
    loanType: 'Car Loan',
    amount: 8000,
    balance: 2000,
    status: 'Rejected',
    rejectionReason: 'Insufficient proof of income.',
  },
])

const selectedStatus = ref('All')
const filteredLoans = ref(loanHistory.value)

const filterLoans = (status: string) => {
  selectedStatus.value = status
  filteredLoans.value =
    status === 'All'
      ? loanHistory.value
      : loanHistory.value.filter((loan) => loan.status === status)
}

// Modals
const showLoanDetailsModal = ref(false)
const showPaymentModal = ref(false)
const showRejectionModal = ref(false)

const selectedLoan = ref<any>(null)
const selectedPaymentLoan = ref<any>(null)
const selectedRejectedLoan = ref<any>(null)

const showLoanDetails = (loan: any) => {
  selectedLoan.value = loan
  showLoanDetailsModal.value = true
}
const showPayment = (loan: any) => {
  selectedPaymentLoan.value = loan
  showPaymentModal.value = true
}
const showRejectionReason = (loan: any) => {
  selectedRejectedLoan.value = loan
  showRejectionModal.value = true
}

const closeModal = () => {
  showLoanDetailsModal.value = false
  showPaymentModal.value = false
  showRejectionModal.value = false
}

// Handle file input
const paymentProof = ref<File | null>(null)
const handlePaymentProofChange = (e: Event) => {
  const file = (e.target as HTMLInputElement)?.files?.[0] ?? null
  paymentProof.value = file
}
</script>

<template>
  <Head title="Loan Status" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col gap-6 p-6">
      <!-- Filter Buttons -->
      <div class="flex gap-2 mb-4">
        <button
          v-for="status in ['All','Completed','Ongoing','Pending','Rejected']"
          :key="status"
          @click="filterLoans(status)"
          :class="[
            'py-2 px-4 rounded text-sm font-semibold',
            selectedStatus === status ? 'bg-blue-600 text-white' : 'bg-gray-200 hover:bg-gray-300'
          ]"
        >
          {{ status }}
        </button>
      </div>

      <!-- Loan History Table -->
      <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Loan History</h2>
        <table class="min-w-full divide-y divide-gray-200 text-sm">
          <thead class="bg-gray-50 text-gray-700">
            <tr>
              <th class="px-4 py-2 text-left">Loan ID</th>
              <th class="px-4 py-2 text-left">Type</th>
              <th class="px-4 py-2 text-left">Amount</th>
              <th class="px-4 py-2 text-left">Balance</th>
              <th class="px-4 py-2 text-left">Status</th>
              <th class="px-4 py-2 text-left">Next Due Date</th>
              <th class="px-4 py-2 text-left">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            <tr v-for="loan in filteredLoans" :key="loan.loanId">
              <td class="px-4 py-2">{{ loan.loanId }}</td>
              <td class="px-4 py-2">{{ loan.loanType }}</td>
              <td class="px-4 py-2">₱{{ loan.amount.toLocaleString() }}</td>
              <td class="px-4 py-2">₱{{ loan.balance.toLocaleString() }}</td>
              <td class="px-4 py-2">
                <span
                  :class="{
                    'bg-green-100 text-green-700': loan.status === 'Completed',
                    'bg-blue-100 text-blue-700': loan.status === 'Ongoing',
                    'bg-yellow-100 text-yellow-700': loan.status === 'Pending',
                    'bg-red-100 text-red-700': loan.status === 'Rejected'
                  }"
                  class="rounded-full px-3 py-1 text-xs font-semibold"
                >
                  {{ loan.status }}
                </span>
              </td>
              <td class="px-4 py-2">
                {{ loan.status === 'Ongoing' ? loan.nextDueDate : '-' }}
              </td>
              <td class="px-4 py-2 space-x-2">
                <button
                  v-if="loan.status === 'Ongoing' || loan.status === 'Completed'"
                  @click="showLoanDetails(loan)"
                  class="text-blue-600 hover:underline"
                >
                  View
                </button>
                <button
                  v-if="loan.status === 'Ongoing'"
                  @click="showPayment(loan)"
                  class="text-green-600 hover:underline"
                >
                  Pay
                </button>
                <button
                  v-if="loan.status === 'Rejected'"
                  @click="showRejectionReason(loan)"
                  class="text-red-600 hover:underline"
                >
                  Reason Only
                </button>
                <span v-if="loan.status === 'Pending'" class="text-yellow-600">Awaiting Approval</span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Loan Details Modal -->
      <div v-if="showLoanDetailsModal" class="fixed inset-0 bg-black/50 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-xl w-full max-w-3xl shadow-lg relative animate-fadeIn">
          <h2 class="text-xl font-bold mb-4">
            Loan Details — {{ selectedLoan.loanId }}
          </h2>
          <div class="grid grid-cols-2 gap-3 text-sm text-gray-700">
            <p><strong>Loan Type:</strong> {{ selectedLoan.loanType }}</p>
            <p><strong>Interest Rate:</strong> {{ selectedLoan.interest }}%</p>
            <p><strong>Start Date:</strong> {{ selectedLoan.startDate }}</p>
            <p><strong>Next Due Date:</strong> {{ selectedLoan.nextDueDate }}</p>
            <p><strong>Savings Deposit:</strong> ₱{{ selectedLoan.savingsDeposit }}</p>
            <p><strong>Share Capital:</strong> ₱{{ selectedLoan.shareCapital }}</p>
            <p><strong>LPP:</strong> ₱{{ selectedLoan.lpp }}</p>
            <p><strong>Service Fee:</strong> ₱{{ selectedLoan.serviceFee }}</p>
            <p><strong>Total Deduction:</strong> ₱1900.00</p>
            <p><strong>Net Proceeds:</strong> ₱{{ selectedLoan.netProceeds }}</p>
          </div>

          <h3 class="mt-5 font-semibold">Amortization Schedule</h3>
          <table class="min-w-full mt-2 text-xs border">
            <thead class="bg-gray-50">
              <tr>
                <th class="py-2 px-2">No</th>
                <th class="py-2 px-2">Date</th>
                <th class="py-2 px-2">Amount</th>
                <th class="py-2 px-2">Interest</th>
                <th class="py-2 px-2">Principal</th>
                <th class="py-2 px-2">Balance</th>
                <th class="py-2 px-2">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="py-1 px-2">1</td>
                <td class="py-1 px-2">2025-12-10</td>
                <td class="py-1 px-2">₱4539</td>
                <td class="py-1 px-2">₱625</td>
                <td class="py-1 px-2">₱3914</td>
                <td class="py-1 px-2">₱21086</td>
                <td class="py-1 px-2 text-blue-600">Paid</td>
              </tr>
            </tbody>
          </table>

          <div class="mt-5 flex justify-end">
            <button @click="closeModal" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Close</button>
          </div>
        </div>
      </div>

      <!-- Payment Modal -->
      <div v-if="showPaymentModal" class="fixed inset-0 bg-black/50 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-lg relative animate-fadeIn">
          <h2 class="text-xl font-bold mb-4">
            Pay Loan — {{ selectedPaymentLoan.loanId }}
          </h2>
          <form class="space-y-4">
            <div>
              <label class="block text-sm font-semibold mb-1">Amount Paid</label>
              <input type="number" placeholder="₱" class="w-full border rounded p-2" required />
            </div>
            <div>
              <label class="block text-sm font-semibold mb-1">Mode of Payment</label>
              <select class="w-full border rounded p-2" required>
                <option value="">Select Mode</option>
                <option>Cash</option>
                <option>GCash</option>
                <option>Bank Transfer</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-semibold mb-1">Upload Proof</label>
              <input type="file" @change="handlePaymentProofChange" class="w-full" required />
            </div>
            <div class="flex justify-end gap-3 mt-4">
              <button type="button" @click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
              <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Submit</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Rejection Reason Modal -->
      <div v-if="showRejectionModal" class="fixed inset-0 bg-black/50 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-lg relative animate-fadeIn">
          <h2 class="text-xl font-bold mb-3">Rejection Reason</h2>
          <p class="text-gray-700">{{ selectedRejectedLoan.rejectionReason }}</p>
          <div class="mt-5 flex justify-end">
            <button @click="closeModal" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Close</button>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(8px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn { animation: fadeIn 0.25s ease-out; }
</style>
