<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import dayjs from 'dayjs'
import { computed, ref } from 'vue'

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/admin/dashboard' },
  { title: 'Calculator', href: '/admin/utility/calculator' },
]

const loanAmount = ref<number | null>(null)
const months = ref<number | null>(null)
const interestRate = ref<number | null>(null)
const startDate = ref(dayjs().format('YYYY-MM-DD'))

const formatCurrency = (amount: number | null) =>
  amount != null ? `₱ ${amount.toFixed(2)}` : '₱ 0.00'

const savings = computed(() => (loanAmount.value ? Math.ceil(loanAmount.value * 0.02) : 0))
const shareCapital = computed(() => (loanAmount.value ? Math.ceil(loanAmount.value * 0.02) : 0))
const lpp = computed(() =>
  loanAmount.value && months.value ? Math.ceil((loanAmount.value / 1000) * 1 * months.value) : 0,
)
const serviceFee = computed(() => (loanAmount.value ? Math.ceil(loanAmount.value * 0.03) : 0))
const totalDeduction = computed(() => savings.value + shareCapital.value + lpp.value + serviceFee.value)
const netProceeds = computed(() => (loanAmount.value ? loanAmount.value - totalDeduction.value : 0))

const monthlyInterest = computed(() => (interestRate.value ? interestRate.value / 100 : 0))

const amortization = computed(() => {
  if (!loanAmount.value || !months.value || !monthlyInterest.value) return 0
  const r = monthlyInterest.value
  const n = months.value
  const A = (loanAmount.value * (r * Math.pow(1 + r, n))) / (Math.pow(1 + r, n) - 1)
  return Math.ceil(A)
})

const schedule = computed(() => {
  if (!loanAmount.value || !months.value || !monthlyInterest.value) return []

  const r = monthlyInterest.value
  const n = months.value
  let balance = loanAmount.value
  const result = []

  for (let i = 0; i < n; i++) {
    let interest = balance * r
    let principal = amortization.value - interest

    if (i === n - 1) {
      principal = balance
      interest = amortization.value - principal
    }

    interest = Math.ceil(interest)
    principal = Math.ceil(amortization.value - interest)

    if (i === n - 1) {
      principal = balance
      interest = amortization.value - principal
    }

    const payment = principal + interest
    const newBalance = balance - principal

    const date = dayjs(startDate.value).add(i + 1, 'month').format('YYYY-MM-DD')

    result.push({
      no: i + 1,
      date,
      payment,
      interest,
      principal,
      balance: newBalance <= 1 ? 0 : Math.ceil(newBalance),
    })

    balance = newBalance
  }

  return result
})
</script>

<template>
  <Head title="Calculator" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="space-y-8 p-6">
      <h1 class="text-2xl font-bold text-gray-800">Loan Amortization Calculator</h1>

      <!-- Input Section -->
      <div class="grid grid-cols-1 gap-6 md:grid-cols-4 bg-white p-4 rounded-xl shadow-sm">
        <div>
          <label class="block text-sm font-medium text-gray-600">Loan Amount</label>
          <input
            type="number"
            v-model.number="loanAmount"
            placeholder="e.g. 25000"
            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring focus:ring-blue-100"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-600">Term (Months)</label>
          <input
            type="number"
            v-model.number="months"
            placeholder="e.g. 3"
            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring focus:ring-blue-100"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-600">Interest Rate (%)</label>
          <input
            type="number"
            step="0.01"
            v-model.number="interestRate"
            placeholder="e.g. 2.5"
            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring focus:ring-blue-100"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-600">Start Date</label>
          <input
            type="date"
            v-model="startDate"
            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring focus:ring-blue-100"
          />
        </div>
      </div>

      <!-- Computed Deductions -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 bg-gray-50 p-4 rounded-xl shadow-inner">
        <div>
          <label class="block text-xs font-semibold text-gray-500">Savings Deposit</label>
          <input type="text" :value="formatCurrency(savings)" disabled class="w-full bg-gray-100 rounded-lg px-4 py-2" />
        </div>
        <div>
          <label class="block text-xs font-semibold text-gray-500">Share Capital</label>
          <input type="text" :value="formatCurrency(shareCapital)" disabled class="w-full bg-gray-100 rounded-lg px-4 py-2" />
        </div>
        <div>
          <label class="block text-xs font-semibold text-gray-500">LPP</label>
          <input type="text" :value="formatCurrency(lpp)" disabled class="w-full bg-gray-100 rounded-lg px-4 py-2" />
        </div>
        <div>
          <label class="block text-xs font-semibold text-gray-500">Service Fee</label>
          <input type="text" :value="formatCurrency(serviceFee)" disabled class="w-full bg-gray-100 rounded-lg px-4 py-2" />
        </div>
      </div>

      <!-- Totals -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-blue-50 p-4 rounded-xl shadow-sm">
          <label class="block text-sm text-blue-800 font-semibold">Total Deduction</label>
          <input type="text" :value="formatCurrency(totalDeduction)" disabled class="w-full bg-transparent font-bold text-blue-900 text-lg" />
        </div>
        <div class="bg-green-50 p-4 rounded-xl shadow-sm">
          <label class="block text-sm text-green-800 font-semibold">Net Proceeds</label>
          <input type="text" :value="formatCurrency(netProceeds)" disabled class="w-full bg-transparent font-bold text-green-900 text-lg" />
        </div>
      </div>

      <!-- Schedule Table -->
      <div class="pt-4">
        <h2 class="text-lg font-semibold mb-2">Amortization Schedule</h2>
        <div class="overflow-auto rounded-xl shadow-sm">
          <table class="min-w-full text-sm border border-gray-200">
            <thead class="bg-gray-100 text-gray-700">
              <tr>
                <th class="px-3 py-2 text-left">No</th>
                <th class="px-3 py-2 text-left">Date</th>
                <th class="px-3 py-2 text-right">Payment</th>
                <th class="px-3 py-2 text-right">Interest</th>
                <th class="px-3 py-2 text-right">Principal</th>
                <th class="px-3 py-2 text-right">Balance</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="item in schedule"
                :key="item.no"
                class="odd:bg-white even:bg-gray-50 border-t border-gray-200"
              >
                <td class="px-3 py-2">{{ item.no }}</td>
                <td class="px-3 py-2">{{ item.date }}</td>
                <td class="px-3 py-2 text-right">{{ formatCurrency(item.payment) }}</td>
                <td class="px-3 py-2 text-right">{{ formatCurrency(item.interest) }}</td>
                <td class="px-3 py-2 text-right">{{ formatCurrency(item.principal) }}</td>
                <td class="px-3 py-2 text-right">{{ formatCurrency(item.balance) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
