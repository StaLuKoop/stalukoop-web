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

const totalShareCapital = ref(5000)  // Example value, initially not affected by pending approval
const totalSavings = ref(1000)       // Example value

const shareCapitalAmount = ref(0)
const savingsAmount = ref(0)
const paymentProof = ref<File | null>(null)
const paymentMode = ref('Bank')
const paymentReference = ref('')  // Added ref for Payment Reference
const showShareCapitalForm = ref(false)  // Control visibility of Add Share Capital form
const showSavingsForm = ref(false)      // Control visibility of Add Savings Deposit form

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
  showShareCapitalForm.value = false  // Hide form after submission
}

// Method for adding Savings Deposit
const addSavingsDeposit = () => {
  alert('Savings Deposit Added: ' + savingsAmount.value)
  showSavingsForm.value = false  // Hide form after submission
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
    <div class="container mx-auto w-[100%] mt-10">
      <!-- Share Capital and Savings Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-6">
        
        <!-- Share Capital Card -->
        <div class="summary-card pastel-red">
          <h2 class="text-2xl font-semibold mb-3">Total Share Capital</h2>
          <p class="text-xl">₱{{ totalShareCapital }}</p>
          <!-- Add Share Capital Button inside the card -->
          <button
            @click="showShareCapitalForm = !showShareCapitalForm"
            class="text-black py-2 px-4 rounded-md hover:bg-red-200 mt-4"
          >
           + Add Share Capital
          </button>
        </div>

        <!-- Savings Card -->
        <div class="summary-card pastel-blue">
          <h2 class="text-2xl font-semibold mb-3">Total Savings</h2>
          <p class="text-xl">₱{{ totalSavings }}</p>
          <!-- Add Savings Deposit Button inside the card -->
          <button
            @click="showSavingsForm = !showSavingsForm"
            class="text-black py-2 px-4 rounded-md hover:bg-blue-200 mt-4"
          >
            + Add Savings Deposit
          </button>
        </div>
        
      </div>

      <!-- Floating Add Share Capital Form -->
      <div
        v-if="showShareCapitalForm"
        class="fixed inset-0 flex justify-center items-center z-50"
      >
        <div class="bg-white p-5 rounded-lg shadow-md w-1/3 relative">
          <h2 class="text-2xl font-semibold mb-3">Add Share Capital</h2>
          <form @submit.prevent="addShareCapital">
            <div class="space-y-4">
              <div>
                <label for="shareCapitalAmount" class="block text-sm font-semibold">Amount to Add</label>
                <input
                  id="shareCapitalAmount"
                  v-model="shareCapitalAmount"
                  type="number"
                  class="mt-1 p-2 w-full border rounded-md"
                  placeholder="Enter amount to add"
                  required
                />
              </div>
              <div>
                <label for="paymentMode" class="block text-sm font-semibold">Payment Mode</label>
                <select id="paymentMode" v-model="paymentMode" class="mt-1 p-2 w-full border rounded-md">
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
                  class="mt-1 p-2 w-full border rounded-md"
                  placeholder="e.g., Transaction ID, Invoice Number, Reference Code"
                  required
                />
              </div>
              <div>
                <label for="paymentProof" class="block text-sm font-semibold">Upload Proof of Payment</label>
                <input
                  id="paymentProof"
                  type="file"
                  @change="handlePaymentProofChange"
                  class="mt-1"
                  required
                />
              </div>
              <div class="flex space-x-4 mt-4">
                <button
                  type="submit"
                  class="bg-red-400 text-white py-2 px-4 rounded-md hover:bg-blue-700"
                >
                  Add Share Capital
                </button>
                <button
                  @click="cancelForm('shareCapital')"
                  type="button"
                  class="bg-red-400 text-white py-2 px-4 rounded-md hover:bg-red-700"
                >
                  Cancel
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Floating Add Savings Deposit Form -->
      <div
        v-if="showSavingsForm"
        class="fixed inset-0 flex justify-center items-center z-50"
      >
        <div class="bg-white p-5 rounded-lg shadow-md w-1/3 relative">
          <h2 class="text-2xl font-semibold mb-3">Add Savings Deposit</h2>
          <form @submit.prevent="addSavingsDeposit">
            <div class="space-y-4">
              <div>
                <label for="savingsAmount" class="block text-sm font-semibold">Amount to Deposit</label>
                <input
                  id="savingsAmount"
                  v-model="savingsAmount"
                  type="number"
                  class="mt-1 p-2 w-full border rounded-md"
                  placeholder="Enter amount to deposit"
                  required
                />
              </div>
              <div>
                <label for="paymentMode" class="block text-sm font-semibold">Payment Mode</label>
                <select id="paymentMode" v-model="paymentMode" class="mt-1 p-2 w-full border rounded-md">
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
                  class="mt-1 p-2 w-full border rounded-md"
                  placeholder="e.g., Transaction ID, Invoice Number, Reference Code"
                  required
                />
              </div>
              <div>
                <label for="paymentProof" class="block text-sm font-semibold">Upload Proof of Payment</label>
                <input
                  id="paymentProof"
                  type="file"
                  @change="handlePaymentProofChange"
                  class="mt-1"
                  required
                />
              </div>
              <div class="flex space-x-4 mt-4">
                <button
                  type="submit"
                  class="bg-red-400 text-white py-2 px-4 rounded-md hover:bg-green-700"
                >
                  Add Savings Deposit
                </button>
                <button
                  @click="cancelForm('savings')"
                  type="button"
                  class="bg-red-400 text-white py-2 px-4 rounded-md hover:bg-red-700"
                >
                  Cancel
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Transaction History Table -->
      <div class="bg-white p-5 rounded-lg shadow-md mb-6">
        <h2 class="text-2xl font-semibold mb-3">Transaction History</h2>
        <table class="min-w-full border-collapse table-auto">
          <thead>
            <tr>
              <th class="py-2 px-4 border-b text-left">Date</th>
              <th class="py-2 px-4 border-b text-left">Type</th>
              <th class="py-2 px-4 border-b text-left">Amount</th>
              <th class="py-2 px-4 border-b text-left">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="transaction in transactions" :key="transaction.date">
              <td class="py-2 px-4 border-b">{{ transaction.date }}</td>
              <td class="py-2 px-4 border-b">{{ transaction.type }}</td>
              <td class="py-2 px-4 border-b">₱{{ transaction.amount }}</td>
              <td class="py-2 px-4 border-b">{{ transaction.status }}</td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
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

.pastel-red { background: linear-gradient(180deg, #fee2e2, #ffffff); border-left: 5px solid #fca5a5; }
.pastel-blue { background: linear-gradient(180deg, #dbeafe, #ffffff); border-left: 5px solid #93c5fd; }
</style>