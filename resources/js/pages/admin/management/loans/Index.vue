<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

import {
  Table,
  TableHeader,
  TableRow,
  TableHead,
  TableBody,
  TableCell,
} from '@/components/ui/table'
import { Button } from '@/components/ui/button'
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogFooter } from '@/components/ui/dialog'

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/admin/dashboard' },
  { title: 'Loans', href: '/admin/management/loans' },
]

// -------------------
// Loan + Payment Types
// -------------------
type Payment = {
  id: number
  due_date: string
  payment: string
  interest: string
  principal: string
  balance: string
  status: string
  action?: string
}

type Loan = {
  id: number
  member_name: string
  amount: number
  loan_type: string
  term: number
  interest_rate: number
  start_date: string
  payments: Payment[]
}

const loans = ref<Loan[]>([
  {
    id: 101,
    member_name: 'Jane Doe',
    amount: 25000,
    loan_type: 'Regular Loan',
    term: 3,
    interest_rate: 2.5,
    start_date: '11/04/2025',
    payments: [
      {
        id: 1,
        due_date: '12/04/2025',
        payment: '₱6,800',
        interest: '₱300',
        principal: '₱6,500',
        balance: '₱13,500',
        status: '🟡 Pending Verification',
        action: '🔍 View Proof',
      },
      {
        id: 2,
        due_date: '01/04/2026',
        payment: '₱6,800',
        interest: '₱200',
        principal: '₱6,600',
        balance: '₱6,900',
        status: '🔵 Paid',
      },
      {
        id: 3,
        due_date: '02/04/2026',
        payment: '₱6,800',
        interest: '₱100',
        principal: '₱6,700',
        balance: '₱0',
        status: '⚪ Upcoming',
        action: '🔔 Notify',
      },
      {
        id: 4,
        due_date: '03/04/2026',
        payment: '₱6,800',
        interest: '₱50',
        principal: '₱6,750',
        balance: '₱0',
        status: '🔴 Overdue',
        action: '📞 Contact Member',
      },
    ],
  },
])

// -------------------
// Modal logic
// -------------------
const selectedLoan = ref<Loan | null>(null)
const showLoan = ref(false)

const viewLoan = (loan: Loan) => {
  selectedLoan.value = loan
  showLoan.value = true
}

const closeModal = () => {
  selectedLoan.value = null
  showLoan.value = false
}

// -------------------
// Computed deductions
// -------------------
const computedDeductions = computed(() => {
  if (!selectedLoan.value) return null
  const amount = selectedLoan.value.amount
  const term = selectedLoan.value.term

  const cbu = amount * 0.02
  const sbu = amount * 0.02
  const serviceFee = amount * 0.03
  const lpp = (amount / 1000) * 1 * term
  const total = cbu + sbu + serviceFee + lpp
  const net = amount - total

  return {
    cbu,
    sbu,
    serviceFee,
    lpp,
    total,
    net,
  }
})
</script>

<template>
  <Head title="Loan Management" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
      <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Loan Management</h1>
      </div>

      <!-- Loan Table -->
      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>Loan ID</TableHead>
            <TableHead>Member Name</TableHead>
            <TableHead>Amount</TableHead>
            <TableHead>Loan Type</TableHead>
            <TableHead class="text-right">Actions</TableHead>
          </TableRow>
        </TableHeader>

        <TableBody>
          <TableRow v-for="loan in loans" :key="loan.id">
            <TableCell>{{ loan.id }}</TableCell>
            <TableCell>{{ loan.member_name }}</TableCell>
            <TableCell>₱{{ loan.amount.toLocaleString() }}</TableCell>
            <TableCell>{{ loan.loan_type }}</TableCell>
            <TableCell class="text-right">
              <Button size="sm" variant="outline" @click="viewLoan(loan)">View</Button>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>

      <!-- Loan Modal -->
      <Dialog v-model:open="showLoan">
        <DialogContent class="sm:max-w-3xl">
          <DialogHeader>
            <DialogTitle>Loan Details</DialogTitle>
          </DialogHeader>

          <div v-if="selectedLoan">
            <div class="grid grid-cols-2 gap-4 mb-4">
              <p><strong>Loan Amount:</strong> ₱{{ selectedLoan.amount.toLocaleString() }}</p>
              <p><strong>Term (Months):</strong> {{ selectedLoan.term }}</p>
              <p><strong>Interest Rate (%):</strong> {{ selectedLoan.interest_rate }}</p>
              <p><strong>Start Date:</strong> {{ selectedLoan.start_date }}</p>
            </div>

            <!-- Deductions (auto computed) -->
            <div class="mt-2 border-t pt-3 space-y-1">
              <h3 class="font-semibold mb-2">Deductions</h3>

              <div v-if="computedDeductions" class="grid grid-cols-2 md:grid-cols-3 gap-2">
                <p>Capital Build-up (CBU): ₱{{ computedDeductions.cbu.toFixed(2) }}</p>
                <p>Savings Build-up (SBU): ₱{{ computedDeductions.sbu.toFixed(2) }}</p>
                <p>Service Fee: ₱{{ computedDeductions.serviceFee.toFixed(2) }}</p>
                <p>LPP: ₱{{ computedDeductions.lpp.toFixed(2) }}</p>
                <p>Total Deduction: ₱{{ computedDeductions.total.toFixed(2) }}</p>
                <p>Net Proceeds: ₱{{ computedDeductions.net.toFixed(2) }}</p>
              </div>
            </div>

            <!-- Payment Schedule -->
            <div class="mt-4 border-t pt-3">
              <h3 class="font-semibold mb-2">Payment Schedule</h3>

              <Table>
                <TableHeader>
                  <TableRow>
                    <TableHead>#</TableHead>
                    <TableHead>Due Date</TableHead>
                    <TableHead>Payment</TableHead>
                    <TableHead>Interest</TableHead>
                    <TableHead>Principal</TableHead>
                    <TableHead>Balance</TableHead>
                    <TableHead>Status</TableHead>
                    <TableHead>Action</TableHead>
                  </TableRow>
                </TableHeader>
                <TableBody>
                  <TableRow v-for="p in selectedLoan.payments" :key="p.id">
                    <TableCell>{{ p.id }}</TableCell>
                    <TableCell>{{ p.due_date }}</TableCell>
                    <TableCell>{{ p.payment }}</TableCell>
                    <TableCell>{{ p.interest }}</TableCell>
                    <TableCell>{{ p.principal }}</TableCell>
                    <TableCell>{{ p.balance }}</TableCell>
                    <TableCell>{{ p.status }}</TableCell>
                    <TableCell>
                      <span v-if="p.action" class="text-blue-600 cursor-pointer hover:underline">
                        {{ p.action }}
                      </span>
                      <span v-else>—</span>
                    </TableCell>
                  </TableRow>
                </TableBody>
              </Table>
            </div>
          </div>

          <DialogFooter>
            <Button variant="outline" @click="closeModal">Close</Button>
          </DialogFooter>
        </DialogContent>
      </Dialog>
    </div>
  </AppLayout>
</template>
