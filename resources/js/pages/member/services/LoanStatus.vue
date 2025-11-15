<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'

// Breadcrumbs for navigation
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/member/dashboard' },
  { title: 'Loan Status', href: '/member/services/loan-status' },
]

// Dummy loan data for illustration (Replace with dynamic data from backend)
const loanHistory = ref([
  {
    loanId: 'L-1023',
    loanType: 'Regular Loan',
    amount: 5000,
    balance: 3000,
    status: 'Ongoing',
    nextDueDate: '2025-12-01',
    maturityDate: '2026-12-01',
    remainingMonths: 12,
  },
  {
    loanId: 'L-1024',
    loanType: 'Emergency Loan',
    amount: 10000,
    balance: 10000,
    status: 'Pending',
    nextDueDate: '',
    maturityDate: '2027-01-01',
    remainingMonths: 24,
  },
  {
    loanId: 'L-1025',
    loanType: 'Home Loan',
    amount: 15000,
    balance: 0,
    status: 'Completed',
    nextDueDate: '',
    maturityDate: '2025-01-01',
    remainingMonths: 0,
  },
  {
    loanId: 'L-1026',
    loanType: 'Car Loan',
    amount: 8000,
    balance: 2000,
    status: 'Rejected',
    nextDueDate: '',
    maturityDate: '',
    remainingMonths: 0,
  },
])

const filteredLoans = ref(loanHistory.value)  // Filtered loans based on status
const selectedStatus = ref('All')  // Track the selected filter status

// Filter loans by status
const filterLoans = (status: string) => {
  if (status === 'All') {
    filteredLoans.value = loanHistory.value
  } else {
    filteredLoans.value = loanHistory.value.filter(loan => loan.status === status)
  }
}

// Loan details modal visibility
const showLoanDetailsModal = ref(false)
const selectedLoan = ref<any>(null)  // Store selected loan details for modal

// Payment modal visibility
const showPaymentModal = ref(false)
const selectedPaymentLoan = ref<any>(null)  // Store selected loan for payment

// Show Loan Details Modal
const showLoanDetails = (loan: any) => {
  selectedLoan.value = loan
  showLoanDetailsModal.value = true
}

// Show Payment Modal
const showPayment = (loan: any) => {
  selectedPaymentLoan.value = loan
  showPaymentModal.value = true
}

// Close Modals
const closeModal = () => {
  showLoanDetailsModal.value = false
  showPaymentModal.value = false
}

// Handle payment proof change (for file input)
const handlePaymentProofChange = (e: Event) => {
  const target = e.target as HTMLInputElement | null;  // Cast the event target as an HTMLInputElement
  const file = target?.files?.[0] ?? null;  // Get the first file, if any
  const paymentProof = file;  // Assign the selected file to the reactive variable
}

</script>

<template>
  <Head title="Loan Status" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col gap-6 p-6">

      <!-- Loan History Filter -->
      <div class="flex justify-between items-center mb-6">
        <div class="flex gap-4">
          <button @click="filterLoans('All')" :class="{'bg-gray-300': selectedStatus === 'All'}" class="py-2 px-4 rounded">All</button>
          <button @click="filterLoans('Completed')" :class="{'bg-green-300': selectedStatus === 'Completed'}" class="py-2 px-4 rounded">Completed</button>
          <button @click="filterLoans('Ongoing')" :class="{'bg-blue-300': selectedStatus === 'Ongoing'}" class="py-2 px-4 rounded">Ongoing</button>
          <button @click="filterLoans('Pending')" :class="{'bg-yellow-300': selectedStatus === 'Pending'}" class="py-2 px-4 rounded">Pending</button>
          <button @click="filterLoans('Rejected')" :class="{'bg-red-300': selectedStatus === 'Rejected'}" class="py-2 px-4 rounded">Rejected</button>
        </div>
      </div>

      <!-- Loan History Table -->
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Loan History</h2>
        <table class="min-w-full table-auto text-sm">
          <thead>
            <tr>
              <th class="py-2 px-4 text-left">Loan ID</th>
              <th class="py-2 px-4 text-left">Type</th>
              <th class="py-2 px-4 text-left">Amount</th>
              <th class="py-2 px-4 text-left">Balance</th>
              <th class="py-2 px-4 text-left">Status</th>
              <th class="py-2 px-4 text-left">Next Due Date</th>
              <th class="py-2 px-4 text-left">Action</th>
            </tr>
          </thead>
          <tbody>
          <tr v-for="loan in filteredLoans" :key="loan.loanId">
            <td class="py-2 px-4">{{ loan.loanId }}</td>
            <td class="py-2 px-4">{{ loan.loanType }}</td>
            <td class="py-2 px-4">₱{{ loan.amount }}</td>
            <td class="py-2 px-4">₱{{ loan.balance }}</td>
            <td class="py-2 px-4">
              <span
                :class="{
                  'bg-green-100 text-green-700': loan.status === 'Completed',
                  'bg-blue-100 text-blue-700': loan.status === 'Ongoing',
                  'bg-yellow-100 text-yellow-700': loan.status === 'Pending',
                  'bg-red-100 text-red-700': loan.status === 'Rejected'
                }"
                class="py-1 px-2 rounded-full"
              >
                {{ loan.status }}
              </span>
            </td>

            <!-- Show next due date only for ongoing loans; otherwise show "-" -->
            <td class="py-2 px-4">
              {{ loan.status === 'Ongoing' ? loan.nextDueDate : '-' }}
            </td>

            <!-- Actions -->
            <td class="py-2 px-4">
              <button
                @click="showLoanDetails(loan)"
                v-if="loan.status === 'Ongoing' || loan.status === 'Completed'"
                class="text-blue-600 hover:underline"
              >
                View
              </button>

              <button
                @click="showPayment(loan)"
                v-if="loan.status === 'Ongoing'"
                class="ml-2 text-green-600 hover:underline"
              >
                Make Payment
              </button>

              <span v-if="loan.status === 'Rejected'" class="text-red-600">
                Reason Only
              </span>

              <span v-if="loan.status === 'Pending'" class="text-yellow-600">
                Awaiting Approval
              </span>
            </td>
          </tr>
        </tbody>
        </table>
      </div>

      <!-- Loan Details Modal -->
      <div v-if="showLoanDetailsModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 relative">
          <h2 class="text-2xl font-semibold mb-3">Loan Details ({{ selectedLoan.loanId }})</h2>
          <p><strong>Loan Type:</strong> {{ selectedLoan.loanType }}</p>
          <p><strong>Amount:</strong> ₱{{ selectedLoan.amount }}</p>
          <p><strong>Interest Rate:</strong> 5%</p>
          <p><strong>Start Date:</strong> {{ selectedLoan.date }}</p>
          <p><strong>Maturity Date:</strong> {{ selectedLoan.maturityDate }}</p>

          <!-- Amortization Table -->
          <h3 class="mt-4 text-lg font-semibold">Amortization Table</h3>
          <table class="min-w-full table-auto text-sm mt-2">
            <thead>
              <tr>
                <th class="py-2 px-4">Due Date</th>
                <th class="py-2 px-4">Payment</th>
                <th class="py-2 px-4">Interest</th>
                <th class="py-2 px-4">Principal</th>
                <th class="py-2 px-4">Balance</th>
                <th class="py-2 px-4">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="py-2 px-4">2025-12-01</td>
                <td class="py-2 px-4">₱500</td>
                <td class="py-2 px-4">₱100</td>
                <td class="py-2 px-4">₱400</td>
                <td class="py-2 px-4">₱2500</td>
                <td class="py-2 px-4">Pending</td>
              </tr>
            </tbody>
          </table>
          <div class="mt-4 flex gap-4">
            <button @click="closeModal" class="bg-gray-600 text-white py-2 px-4 rounded-md">Close</button>
          </div>
        </div>
      </div>

      <!-- Payment Modal -->
  <div v-if="showPaymentModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 relative">
      <h2 class="text-2xl font-semibold mb-3">Make a Payment for Loan ({{ selectedPaymentLoan.loanId }})</h2>
      <form>
        <div class="space-y-4">
          <div>
            <label for="paymentProof" class="block text-sm font-semibold">Upload Proof of Payment</label>
            <input
              type="file"
              id="paymentProof"
              @change="handlePaymentProofChange"
              required
            />
          </div>
          <div class="mt-4 flex gap-4">
            <button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700">Submit Payment</button>
            <button @click="closeModal" type="button" class="bg-gray-600 text-white py-2 px-4 rounded-md">Cancel</button>
          </div>
        </div>
      </form>
        </div>
      </div>

    </div>
  </AppLayout>
</template>
