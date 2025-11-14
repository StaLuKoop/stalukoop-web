<script setup lang="ts">
import { computed, ref } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'

// 🔹 Breadcrumb navigation
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/admin/dashboard' },
  { title: 'Credit Scoring', href: '/admin/management/creditscoring' },
]

// 🔹 Sample data structure
const creditScores = ref([
  {
    memberId: '1',
    memberName: 'Jane Doe',
    avgCreditScore: 750,
    loans: [
      {
        loanId: '101',
        loanType: 'Regular Loan',
        loanCreditScore: 800
      },
      {
        loanId: '102',
        loanType: 'Car Loan',
        loanCreditScore: 720
      }
    ]
  },
  {
    memberId: '2',
    memberName: 'John Smith',
    avgCreditScore: 720,
    loans: [
      {
        loanId: '103',
        loanType: 'Home Loan',
        loanCreditScore: 740
      }
    ]
  },
  {
    memberId: '3',
    memberName: 'Ella Santos',
    avgCreditScore: 770,
    loans: [
      {
        loanId: '104',
        loanType: 'Regular Loan',
        loanCreditScore: 790
      }
    ]
  }
])

// 🔹 Search functionality
const searchTerm = ref('')
const filteredCreditScores = computed(() => {
  return creditScores.value.filter(member =>
    member.memberName.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
    member.memberId.includes(searchTerm.value)
  )
})

// 🔹 Modal Control
const showModal = ref(false)
const selectedMember = ref<any>(null)

// 🔹 Function to handle opening the modal
const openModal = (member: any) => {
  selectedMember.value = member
  showModal.value = true
}

// 🔹 Function to close the modal
const closeModal = () => {
  showModal.value = false
  selectedMember.value = null
}
</script>

<template>
  <Head title="Credit Scoring" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col gap-6 p-6">
      <h1 class="text-2xl font-bold text-gray-800">Credit Scoring</h1>

      <!-- Search Bar -->
      <div class="flex w-full md:w-1/3 items-center gap-2">
        <input
          v-model="searchTerm"
          placeholder="Search by Name or ID"
          class="input border border-gray-300 rounded-lg p-2"
        />
      </div>

      <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
          <thead class="bg-gray-50 text-gray-700">
            <tr>
              <th class="px-4 py-3 text-left font-semibold">Member ID</th>
              <th class="px-4 py-3 text-left font-semibold">Member Name</th>
              <th class="px-4 py-3 text-left font-semibold">Average Credit Score</th>
              <th class="px-4 py-3 text-left font-semibold">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 bg-white">
            <tr
              v-for="(item, index) in filteredCreditScores"
              :key="index"
              class="hover:bg-gray-50 transition"
            >
              <td class="px-4 py-3 font-medium text-gray-900">{{ item.memberId }}</td>
              <td class="px-4 py-3">{{ item.memberName }}</td>
              <td class="px-4 py-3">
                <span
                  :class="[
                    'rounded-full px-3 py-1 text-xs font-semibold',
                    item.avgCreditScore >= 750 ? 'bg-green-100 text-green-700' :
                    item.avgCreditScore >= 700 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700'
                  ]"
                >
                  {{ item.avgCreditScore }}
                </span>
              </td>
              <td class="px-4 py-3">
                <button
                  class="text-blue-600"
                  @click="openModal(item)"
                >
                  View Loans
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Modal for viewing loans -->
      <Dialog v-model:open="showModal">
        <DialogContent class="dialog-content">
          <DialogHeader>
            <DialogTitle>Loans for {{ selectedMember?.memberName }}</DialogTitle>
          </DialogHeader>

          <div v-if="selectedMember">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
              <thead class="bg-gray-50 text-gray-700">
                <tr>
                  <th class="px-4 py-3 text-left font-semibold">Loan ID</th>
                  <th class="px-4 py-3 text-left font-semibold">Loan Type</th>
                  <th class="px-4 py-3 text-left font-semibold">Loan Credit Score</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="loan in selectedMember.loans"
                  :key="loan.loanId"
                  class="hover:bg-gray-50 transition"
                >
                  <td class="px-4 py-3">{{ loan.loanId }}</td>
                  <td class="px-4 py-3">{{ loan.loanType }}</td>
                  <td class="px-4 py-3">
                    <span
                      :class="[
                        'rounded-full px-3 py-1 text-xs font-semibold',
                        loan.loanCreditScore >= 750 ? 'bg-green-100 text-green-700' :
                        loan.loanCreditScore >= 700 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700'
                      ]"
                    >
                      {{ loan.loanCreditScore }}
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <DialogFooter>
            <Button variant="outline" @click="closeModal">Close</Button>
          </DialogFooter>
        </DialogContent>
      </Dialog>

    </div>
  </AppLayout>
</template>
<style scoped>
/* Centering the Modal */
.dialog-content {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  max-width: 20%;
  width: 80%;
  z-index: 9999;
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  padding: 2rem;
}

/* Backdrop */
.dialog-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  z-index: 9998;
}

/* Table Styling */
.dialog-content table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 1rem;
}

.dialog-content th,
.dialog-content td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #e5e7eb;
}

.dialog-content th {
  background-color: #f7fafc;
  font-weight: 600;
  color: #4a5568;
}

.dialog-content td {
  color: #4a5568;
}

.dialog-content tr:hover {
  background-color: #f1f5f9;
}

/* Close Button Styling */
.dialog-footer {
  text-align: right;
  margin-top: 1rem;
}

.dialog-footer .btn {
  padding: 0.75rem 1.5rem;
  background-color: #3182ce;
  color: white;
  border-radius: 0.375rem;
  cursor: pointer;
  font-size: 1rem;
  border: none;
}

.dialog-footer .btn:hover {
  background-color: #2b6cb0;
}

</style>
