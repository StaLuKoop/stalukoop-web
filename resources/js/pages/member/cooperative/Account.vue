<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'

defineProps<{ status: string }>()

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/member/dashboard' },
  { title: 'Account', href: '/member/cooperative/account' },
]

const totalShareCapital = ref(5000) // Example value, initially not affected by pending approval
const totalSavings = ref(1000) // Example value

const shareCapitalAmount = ref(0)
const savingsAmount = ref(0)
const paymentProof = ref<File | null>(null)
const paymentMode = ref('Bank')
const paymentReference = ref('') // Added ref for Payment Reference
const showShareCapitalForm = ref(false) // Control visibility of Add Share Capital form
const showSavingsForm = ref(false) // Control visibility of Add Savings Deposit form

const transactions = ref([
  { date: '2025-10-15', type: 'Deposit', amount: 500, status: 'Completed' },
  { date: '2025-10-12', type: 'Deposit', amount: 200, status: 'Completed' },
  { date: '2025-10-10', type: 'Deposit', amount: 100, status: 'Pending' },
])

const shareCapitalApprovalStatus = ref('Pending') // Track the approval status of Share Capital form

// Handle payment proof change (for file input)
const handlePaymentProofChange = (e: Event) => {
  const target = e.target as HTMLInputElement | null
  const file = target?.files?.[0] ?? null
  paymentProof.value = file
}

// Method for adding Share Capital (set as pending until approved by admin)
const addShareCapital = () => {
  // Simulate the pending status
  shareCapitalApprovalStatus.value = 'Pending'
  alert('Share Capital Added: ' + shareCapitalAmount.value + ' (Pending Admin Approval)')
  showShareCapitalForm.value = false // Hide form after submission
}

// Method for adding Savings Deposit
const addSavingsDeposit = () => {
  alert('Savings Deposit Added: ' + savingsAmount.value)
  showSavingsForm.value = false // Hide form after submission
}

// Method to cancel the form and hide it
const cancelForm = (formType: string) => {
  if (formType === 'shareCapital') {
    showShareCapitalForm.value = false
  } else if (formType === 'savings') {
    showSavingsForm.value = false
  }
}
</script>

<template>
  <Head title="Member's Own Funds" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <template v-if="status === 'pending'">
      <div class="space-y-4 rounded-lg border border-yellow-400 bg-yellow-100 p-6 text-yellow-800 shadow">
        <h2 class="text-lg font-semibold">Membership Pending</h2>

        <p>
          Your membership is still pending approval. To access your <u>full account details</u>, please complete the
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
          <a href="/member/requirements/membership-form" class="ml-1 text-blue-700 underline hover:text-blue-900">
            Complete Member Form
          </a>
        </p>

        <p class="text-sm italic">For further assistance, please contact the cooperative office.</p>
      </div>
    </template>

    <template v-else-if="status === 'regular'">
      <div class="container mx-auto mt-10 w-[100%]">
        <!-- Share Capital and Savings Cards -->
        <div class="mb-6 grid grid-cols-1 gap-10 md:grid-cols-2">
          <!-- Share Capital Card -->
          <div class="summary-card pastel-red">
            <h2 class="mb-3 text-2xl font-semibold">Total Share Capital</h2>
            <p class="text-xl">₱{{ totalShareCapital }}</p>
            <!-- Add Share Capital Button inside the card -->
            <button
              @click="showShareCapitalForm = !showShareCapitalForm"
              class="mt-4 rounded-md px-4 py-2 text-black hover:bg-red-200"
            >
              + Add Share Capital
            </button>
          </div>

          <!-- Savings Card -->
          <div class="summary-card pastel-blue">
            <h2 class="mb-3 text-2xl font-semibold">Total Savings</h2>
            <p class="text-xl">₱{{ totalSavings }}</p>
            <!-- Add Savings Deposit Button inside the card -->
            <button
              @click="showSavingsForm = !showSavingsForm"
              class="mt-4 rounded-md px-4 py-2 text-black hover:bg-blue-200"
            >
              + Add Savings Deposit
            </button>
          </div>
        </div>

        <!-- Floating Add Share Capital Form -->
        <div v-if="showShareCapitalForm" class="fixed inset-0 z-50 flex items-center justify-center">
          <div class="relative w-1/3 rounded-lg bg-white p-5 shadow-md">
            <h2 class="mb-3 text-2xl font-semibold">Add Share Capital</h2>
            <form @submit.prevent="addShareCapital">
              <div class="space-y-4">
                <div>
                  <label for="shareCapitalAmount" class="block text-sm font-semibold">Amount to Add</label>
                  <input
                    id="shareCapitalAmount"
                    v-model="shareCapitalAmount"
                    type="number"
                    class="mt-1 w-full rounded-md border p-2"
                    placeholder="Enter amount to add"
                    required
                  />
                </div>
                <div>
                  <label for="paymentMode" class="block text-sm font-semibold">Payment Mode</label>
                  <select id="paymentMode" v-model="paymentMode" class="mt-1 w-full rounded-md border p-2">
                    <option value="Bank">Bank</option>
                    <option value="GCash">GCash</option>
                    <option value="Over the Counter">Over the Counter</option>
                  </select>
                </div>
                <div>
                  <label for="paymentReference" class="block text-sm font-semibold">Payment Reference</label>
                  <input
                    id="paymentReference"
                    v-model="paymentReference"
                    type="text"
                    class="mt-1 w-full rounded-md border p-2"
                    placeholder="e.g., Transaction ID, Invoice Number, Reference Code"
                    required
                  />
                </div>
                <div>
                  <label for="paymentProof" class="block text-sm font-semibold">Upload Proof of Payment</label>
                  <input id="paymentProof" type="file" @change="handlePaymentProofChange" class="mt-1" required />
                </div>
                <div class="mt-4 flex space-x-4">
                  <button type="submit" class="rounded-md bg-red-400 px-4 py-2 text-white hover:bg-blue-700">
                    Add Share Capital
                  </button>
                  <button
                    @click="cancelForm('shareCapital')"
                    type="button"
                    class="rounded-md bg-red-400 px-4 py-2 text-white hover:bg-red-700"
                  >
                    Cancel
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Floating Add Savings Deposit Form -->
        <div v-if="showSavingsForm" class="fixed inset-0 z-50 flex items-center justify-center">
          <div class="relative w-1/3 rounded-lg bg-white p-5 shadow-md">
            <h2 class="mb-3 text-2xl font-semibold">Add Savings Deposit</h2>
            <form @submit.prevent="addSavingsDeposit">
              <div class="space-y-4">
                <div>
                  <label for="savingsAmount" class="block text-sm font-semibold">Amount to Deposit</label>
                  <input
                    id="savingsAmount"
                    v-model="savingsAmount"
                    type="number"
                    class="mt-1 w-full rounded-md border p-2"
                    placeholder="Enter amount to deposit"
                    required
                  />
                </div>
                <div>
                  <label for="paymentMode" class="block text-sm font-semibold">Payment Mode</label>
                  <select id="paymentMode" v-model="paymentMode" class="mt-1 w-full rounded-md border p-2">
                    <option value="Bank">Bank</option>
                    <option value="GCash">GCash</option>
                    <option value="Over the Counter">Over the Counter</option>
                  </select>
                </div>
                <div>
                  <label for="paymentReference" class="block text-sm font-semibold">Payment Reference</label>
                  <input
                    id="paymentReference"
                    v-model="paymentReference"
                    type="text"
                    class="mt-1 w-full rounded-md border p-2"
                    placeholder="e.g., Transaction ID, Invoice Number, Reference Code"
                    required
                  />
                </div>
                <div>
                  <label for="paymentProof" class="block text-sm font-semibold">Upload Proof of Payment</label>
                  <input id="paymentProof" type="file" @change="handlePaymentProofChange" class="mt-1" required />
                </div>
                <div class="mt-4 flex space-x-4">
                  <button type="submit" class="rounded-md bg-red-400 px-4 py-2 text-white hover:bg-green-700">
                    Add Savings Deposit
                  </button>
                  <button
                    @click="cancelForm('savings')"
                    type="button"
                    class="rounded-md bg-red-400 px-4 py-2 text-white hover:bg-red-700"
                  >
                    Cancel
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Transaction History Table -->
        <div class="mb-6 rounded-lg bg-white p-5 shadow-md">
          <h2 class="mb-3 text-2xl font-semibold">Transaction History</h2>
          <table class="min-w-full table-auto border-collapse">
            <thead>
              <tr>
                <th class="border-b px-4 py-2 text-left">Date</th>
                <th class="border-b px-4 py-2 text-left">Type</th>
                <th class="border-b px-4 py-2 text-left">Amount</th>
                <th class="border-b px-4 py-2 text-left">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="transaction in transactions" :key="transaction.date">
                <td class="border-b px-4 py-2">{{ transaction.date }}</td>
                <td class="border-b px-4 py-2">{{ transaction.type }}</td>
                <td class="border-b px-4 py-2">₱{{ transaction.amount }}</td>
                <td class="border-b px-4 py-2">{{ transaction.status }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </template>

    <template v-else>
      <div class="space-y-4 rounded-lg border border-red-400 bg-red-100 p-6 text-red-800 shadow">
        <h2 class="text-lg font-semibold">Account Closed</h2>

        <p>
          Your membership account has been marked as <strong>closed</strong>. Access to member services, savings, share
          capital, and loan-related features is no longer available through the portal.
        </p>

        <p>
          If you believe this status is incorrect, or if you need clarification regarding the reason for account
          closure, please contact the cooperative office for verification and assistance.
        </p>

        <ul class="list-inside list-disc space-y-1">
          <li>Request a status review or account reactivation (if applicable)</li>
          <li>Verify any remaining obligations or balances</li>
          <li>Update your personal or membership information if required</li>
        </ul>

        <p class="text-sm italic">
          For further assistance, you may reach the Membership Officer or visit the cooperative office during business
          hours.
        </p>
      </div>
    </template>
  </AppLayout>
</template>

<style scoped>
.summary-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 1rem;
}

.summary-card {
  border-radius: 1rem;
  padding: 2rem;
  color: #1f2937;
  font-weight: 500;
  background: #fff;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
  min-height: 150px;
}

.pastel-red {
  background: linear-gradient(180deg, #fee2e2, #ffffff);
  border-left: 5px solid #fca5a5;
}
.pastel-blue {
  background: linear-gradient(180deg, #dbeafe, #ffffff);
  border-left: 5px solid #93c5fd;
}
</style>
