<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

defineProps<{ status: string }>()

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/member/dashboard' },
  { title: 'Credit Scoring', href: '/member/cooperative/credit-scoring' },
]

// Mock data
const averageScore = ref<number>(86)
const rating = ref<string>('Very Good')

const creditHistory = ref([
  {
    loanId: 'L-1023',
    date: 'Oct 5, 2025',
    type: 'Regular Loan',
    score: 88,
    remarks: 'Good repayment record',
  },
  {
    loanId: 'L-0950',
    date: 'Mar 2, 2025',
    type: 'Regular Loan',
    score: 79,
    remarks: 'Late 1 month payment',
  },
  {
    loanId: 'L-0801',
    date: 'Aug 10, 2024',
    type: 'Regular Loan',
    score: 72,
    remarks: 'Fully paid',
  },
])

// Compute circle progress color
const scoreStyle = computed(() => {
  const degree = averageScore.value * 3.6
  return {
    background: `conic-gradient(#b91c1c ${degree}deg, #e5e7eb ${degree}deg 360deg)`,
  }
})
</script>

<template>
  <Head title="Credit Scoring" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="credit-container">
      <!-- Pending Membership Section (commented out) -->
      <!--
      <template v-if="status === 'pending'">
        <div class="pending-section">
          <h2 class="text-lg font-semibold">Membership Pending</h2>
          <p>Your membership is still pending approval. To proceed with a loan application, please complete the following requirements:</p>
          <ul class="list-inside list-disc space-y-1">
            <li>Attend the PMES (Pre-Membership Education Seminar)</li>
            <li>Fill out and submit the Membership Application Form</li>
            <li>Submit a valid government-issued ID</li>
            <li>Pay the initial membership fee</li>
          </ul>
          <p>You may fill out the membership form online: 
            <a href="/member/requirements/membership-form" class="ml-1 text-blue-700 underline hover:text-blue-900">
              Complete Member Form
            </a>
          </p>
          <p class="text-sm italic">For further assistance, please contact the cooperative office.</p>
        </div>
      </template>
      -->

      <!-- Overall Score Section -->
      <div class="score-summary">
        <div class="score-circle" :style="scoreStyle">
          <div class="inner-circle">
            <p class="score-value">{{ averageScore }}</p>
            <p class="score-label">Credit Score</p>
          </div>
        </div>

        <div class="score-details">
          <h2>Overall Rating: <span>{{ rating }}</span></h2>
          <p>
            Your credit score reflects your payment history, share capital, and savings record. 
            A higher score increases your loan eligibility and approval speed.
          </p>
        </div>
      </div>

      <!-- Credit History Table -->
      <div class="history-section">
        <h3>Credit Score History per Loan</h3>
        <div class="table-container">
          <table class="score-table">
            <thead>
              <tr>
                <th>Loan ID</th>
                <th>Date</th>
                <th>Loan Type</th>
                <th>Score</th>
                <th>Remarks</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(record, index) in creditHistory" :key="index">
                <td>{{ record.loanId }}</td>
                <td>{{ record.date }}</td>
                <td>{{ record.type }}</td>
                <td>{{ record.score }}</td>
                <td>{{ record.remarks }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
.credit-container {
  padding: 1.5rem;
  background: #fff;
  border-radius: 1rem;
}

/* Overall Score */
.score-summary {
  display: flex;
  flex-wrap: wrap;
  gap: 2rem;
  align-items: center;
  margin-bottom: 2rem;
}

/* Score Circle */
.score-circle {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  position: relative;
}
.inner-circle {
  width: 110px;
  height: 110px;
  background-color: #ffffff;
  border-radius: 50%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: #b91c1c;
  text-align: center;
}
.score-value {
  font-size: 2.2rem;
  font-weight: bold;
  margin: 0;
}
.score-label {
  font-size: 0.9rem;
  color: #555;
}

/* Details */
.score-details h2 {
  font-size: 1.1rem;
  font-weight: 600;
  color: #1f2937;
}
.score-details h2 span {
  color: #b91c1c;
}
.score-details p {
  font-size: 0.95rem;
  color: #444;
  margin-top: 0.3rem;
  line-height: 1.4;
}

/* History Table */
.history-section h3 {
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 0.8rem;
  color: #1f2937;
}
.table-container {
  overflow-x: auto;
  border: 1px solid #eee;
  border-radius: 1rem;
}
.score-table {
  width: 100%;
  border-collapse: collapse;
}
.score-table th,
.score-table td {
  padding: 0.75rem 1rem;
  text-align: left;
  font-size: 0.95rem;
}
.score-table th {
  background-color: #fafafa;
  font-weight: 600;
  border-bottom: 2px solid #eee;
}
.score-table tr:nth-child(even) {
  background-color: #f9f9f9;
}
</style>
