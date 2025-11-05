<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

defineProps<{ status: string }>()

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/member/dashboard' },
]

// Main Data
const totalShareCapital = ref(3500)
const totalSavings = ref(1700)
const activeLoan = ref(25000)
const creditScore = ref(86)

// Notifications & Activities
const notifications = ref([
  'Next payment due on Nov 15, 2025',
  'Your credit score improved to 86!',
  'New cooperative policy effective Nov 2025',
])
const recentActivities = ref([
  { date: 'Oct 30, 2025', activity: 'Added ₱500 to Savings Deposit' },
  { date: 'Oct 25, 2025', activity: 'Paid ₱2,000 for Regular Loan #L-1023' },
  { date: 'Oct 20, 2025', activity: 'Credit Score updated to 86 (Very Good)' },
])

// Bar Chart Data
const loanPayments = [
  { month: 'Jun', payment: 6000, interest: 1000 },
  { month: 'Jul', payment: 6500, interest: 900 },
  { month: 'Aug', payment: 6800, interest: 800 },
  { month: 'Sep', payment: 7000, interest: 700 },
  { month: 'Oct', payment: 7200, interest: 600 },
]
const maxPayment = computed(() =>
  Math.ceil(Math.max(...loanPayments.map(d => d.payment)) / 1000) * 1000
)
function barHeight(value: number, h = 140) {
  return (value / maxPayment.value) * h
}

// Line Chart Data
const growthData = [
  { month: 'Jun', savings: 1000, capital: 2000 },
  { month: 'Jul', savings: 1200, capital: 2500 },
  { month: 'Aug', savings: 1700, capital: 2800 },
  { month: 'Sep', savings: 2000, capital: 3200 },
  { month: 'Oct', savings: 2500, capital: 3500 },
]
const maxGrowth = computed(() =>
  Math.ceil(
    Math.max(...growthData.map(d => Math.max(d.savings, d.capital))) / 1000
  ) * 1000
)
function linePoints(key: 'savings' | 'capital', w = 480, h = 140) {
  const gap = w / (growthData.length - 1)
  const max = maxGrowth.value || 1
  return growthData.map((d, i) => ({
    x: i * gap,
    y: h - (d[key] / max) * h,
  }))
}
</script>

<template>
  <Head title="Dashboard" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="dashboard-container">
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
      <h1 class="title">Welcome back!</h1>

      <!-- Summary Cards -->
      <div class="summary-grid">
        <div class="summary-card pastel-red">
          <h2>Total Share Capital</h2>
          <p>₱{{ totalShareCapital.toLocaleString() }}</p>
        </div>
        <div class="summary-card pastel-blue">
          <h2>Total Savings</h2>
          <p>₱{{ totalSavings.toLocaleString() }}</p>
        </div>
        <div class="summary-card pastel-yellow">
          <h2>Active Loan</h2>
          <p>₱{{ activeLoan.toLocaleString() }}</p>
        </div>
        <div class="summary-card pastel-green">
          <h2>Credit Score</h2>
          <p>{{ creditScore }} / 100</p>
        </div>
      </div>

      <!-- Charts -->
      <div class="charts-grid">
        <!-- Bar Chart -->
        <div class="chart-card">
          <h3>Monthly Loan Payments Overview</h3>
          <svg viewBox="0 0 520 180" class="chart-svg">
            <line v-for="i in 4" :key="'grid' + i" :y1="i * 40" :y2="i * 40" x1="0" x2="520" stroke="#f3f4f6" />
            <g transform="translate(40,10)">
              <g v-for="(d, i) in loanPayments" :key="i" :transform="`translate(${i * 90}, 0)`">
                <rect :y="140 - barHeight(d.payment)" x="10" width="30" :height="barHeight(d.payment)" fill="#fca5a5" rx="4" />
                <rect :y="140 - barHeight(d.interest)" x="50" width="30" :height="barHeight(d.interest)" fill="#93c5fd" rx="4" />
                <text x="35" y="160" font-size="12" fill="#6b7280" text-anchor="middle">{{ d.month }}</text>
              </g>
            </g>
          </svg>
          <div class="legend">
            <span class="dot red"></span><small>Total Payment</small>
            <span class="dot blue"></span><small>Interest Portion</small>
          </div>
        </div>

        <!-- Line Chart -->
        <div class="chart-card">
          <h3>Savings & Share Capital Growth</h3>
          <svg viewBox="0 0 520 180" class="chart-svg">
            <line v-for="i in 4" :key="'grid2' + i" :y1="i * 40" :y2="i * 40" x1="0" x2="520" stroke="#f3f4f6" />
            <g transform="translate(20,10)">
              <polyline :points="linePoints('capital', 480, 140).map(p => `${p.x},${p.y}`).join(' ')" fill="none" stroke="#facc15" stroke-width="3" />
              <polyline :points="linePoints('savings', 480, 140).map(p => `${p.x},${p.y}`).join(' ')" fill="none" stroke="#86efac" stroke-width="3" />
              <circle v-for="(p, i) in linePoints('capital', 480, 140)" :key="'cap' + i" :cx="p.x" :cy="p.y" r="4" fill="#facc15" />
              <circle v-for="(p, i) in linePoints('savings', 480, 140)" :key="'sav' + i" :cx="p.x" :cy="p.y" r="4" fill="#10b981" />
              <g transform="translate(0,150)">
                <text v-for="(d, i) in growthData" :key="'lbl' + i" :x="i * (480 / (growthData.length - 1))" y="0" font-size="12" fill="#6b7280" text-anchor="middle">{{ d.month }}</text>
              </g>
            </g>
          </svg>
          <div class="legend">
            <span class="dot yellow"></span><small>Share Capital</small>
            <span class="dot green"></span><small>Savings</small>
          </div>
        </div>
      </div>

      <!-- Notifications + Recent Activities in One Row -->
      <div class="double-section">
        <!-- Notifications -->
        <div class="section-card">
          <h3>Notifications</h3>
          <ul class="notif-list">
            <li v-for="(n, i) in notifications" :key="i">{{ n }}</li>
          </ul>
        </div>

        <!-- Recent Activities -->
        <div class="section-card">
          <h3>Recent Activities</h3>
          <table class="modern-table">
            <thead>
              <tr>
                <th>Date</th>
                <th>Activity</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(a, i) in recentActivities" :key="i">
                <td>{{ a.date }}</td>
                <td>{{ a.activity }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
.dashboard-container {
  padding: 1.5rem;
  background: white;
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}
.title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1f2937;
}

/* Summary Cards */
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
.summary-card h2 {
  font-size: 0.95rem;
  margin-bottom: 0.3rem;
}
.summary-card p {
  font-size: 1.6rem;
  font-weight: 700;
}
.pastel-red { background: linear-gradient(180deg, #fee2e2, #ffffff); border-left: 5px solid #fca5a5; }
.pastel-blue { background: linear-gradient(180deg, #dbeafe, #ffffff); border-left: 5px solid #93c5fd; }
.pastel-yellow { background: linear-gradient(180deg, #fef3c7, #ffffff); border-left: 5px solid #facc15; }
.pastel-green { background: linear-gradient(180deg, #dcfce7, #ffffff); border-left: 5px solid #86efac; }

/* Charts */
.charts-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
}
.chart-card {
  background: #fff;
  border-radius: 1rem;
  padding: 2.5rem;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  min-height: 50px;
}
.chart-card h3 {
  font-size: 1rem;
  margin-bottom: 0.5rem;
  color: #1f2937;
}
.chart-svg { width: 100%; height: 180px; }
.legend {
  display: flex;
  gap: 1rem;
  align-items: center;
  font-size: 0.85rem;
  margin-top: 0.5rem;
  color: #374151;
}
.dot { display: inline-block; width: 10px; height: 10px; border-radius: 3px; }
.dot.red { background: #fca5a5; }
.dot.blue { background: #93c5fd; }
.dot.yellow { background: #facc15; }
.dot.green { background: #86efac; }

/* Notifications + Activities in One Row */
.double-section {
  display: grid;
  grid-template-columns: 1fr 1.3fr;
  gap: 1rem;
}
@media (max-width: 900px) {
  .double-section {
    grid-template-columns: 1fr;
  }
}

.section-card {
  background: #fff;
  border-radius: 1rem;
  padding: 1rem;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}
.section-card h3 {
  margin-bottom: 0.8rem;
  font-weight: 600;
  color: #1f2937;
}
.notif-list {
  list-style: none;
  padding: 0;
  margin: 0;
}
.notif-list li {
  border-bottom: 1px solid #eee;
  padding: 0.6rem 0;
  color: #374151;
}

/* Recent Activities */
.modern-table {
  width: 100%;
  border-collapse: collapse;
}
.modern-table th {
  background: #f9fafb;
  padding: 0.8rem;
  text-align: left;
  border-bottom: 2px solid #e5e7eb;
  font-weight: 600;
  color: #1f2937;
}
.modern-table td {
  padding: 0.8rem;
  border-bottom: 1px solid #eee;
  color: #374151;
}
.modern-table tr:hover { background: #fef9c3; }
</style>
