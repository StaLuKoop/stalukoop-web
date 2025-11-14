<script setup lang="ts">
import { ref, onMounted } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'
import { type BreadcrumbItem } from '@/types'

import {
  BarElement,
  CategoryScale,
  ChartOptions,
  Chart as ChartJS,
  Legend,
  LinearScale,
  LineElement,
  PointElement,
  Title,
  Tooltip,
  Filler
} from 'chart.js'

import { AlertCircle, UserCheck, Users, Wallet } from 'lucide-vue-next'
import { Bar, Line } from 'vue-chartjs'

import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  Filler,
  BarElement,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement
)

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/dashboard' },
]

const barChartOptions: ChartOptions<'bar'> = {
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: {
      position: 'bottom'
    }
  },
  scales: {
    x: {
      stacked: false
    },
    y: {
      stacked: false,
      beginAtZero: true
    }
  }
}

const lineChartOptions: ChartOptions<'line'> = {
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: {
      position: 'bottom'
    }
  },
  scales: {
    y: {
      beginAtZero: true
    }
  }
}

const barChartData = ref()
const lineChartData = ref()

function getChartColors() {
  const styles = getComputedStyle(document.documentElement)
  return {
    chart1: styles.getPropertyValue('--chart-1').trim(),
    chart2: styles.getPropertyValue('--chart-2').trim(),
    chart3: styles.getPropertyValue('--chart-3').trim(),
    chart4: styles.getPropertyValue('--chart-4').trim(),
    chart5: styles.getPropertyValue('--chart-5').trim()
  }
}

function hexToRgba(hex: string, alpha: number): string {
  let cleanedHex = hex.replace('#', '')
  if (cleanedHex.length === 3) {
    cleanedHex = cleanedHex.split('').map(c => c + c).join('')
  }
  const bigint = parseInt(cleanedHex, 16)
  const r = (bigint >> 16) & 255
  const g = (bigint >> 8) & 255
  const b = bigint & 255
  return `rgba(${r}, ${g}, ${b}, ${alpha})`
}

onMounted(() => {
  const colors = getChartColors()

  barChartData.value = {
    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
    datasets: [
      {
        label: 'Online Revenue',
        backgroundColor: colors.chart1,
        data: [12000, 15000, 13000, 16000, 18000]
      },
      {
        label: 'Offline Revenue',
        backgroundColor: colors.chart2,
        data: [10000, 14000, 12000, 15000, 17000]
      }
    ]
  }

  const fillThisMonth = hexToRgba(colors.chart2 || '#10b981', 0.2)
  const fillLastMonth = hexToRgba(colors.chart4 || '#ef4444', 0.1)

  lineChartData.value = {
    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
    datasets: [
      {
        label: 'This Month',
        borderColor: colors.chart2,
        backgroundColor: fillThisMonth,
        data: [5000, 8000, 7000, 9000],
        fill: false,
        tension: 0.4
      },
      {
        label: 'Last Month',
        borderColor: colors.chart4,
        backgroundColor: fillLastMonth,
        data: [4500, 6000, 6500, 7500],
        fill: false,
        tension: 0.4
      }
    ]
  }
})
</script>

<template>
  <Head title="Dashboard" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-6 p-4">

      <!-- Statistic Cards -->
      <div class="grid gap-4 md:grid-cols-4">
        <Card class="card-bg-1 text-foreground">
          <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle class="text-sm font-medium">Total Members</CardTitle>
            <Users class="h-5 w-5 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div class="text-2xl font-bold">1,234</div>
            <p class="text-xs text-muted-foreground">As of July 2025</p>
          </CardContent>
        </Card>

        <Card class="card-bg-2 text-foreground">
          <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle class="text-sm font-medium">Active Members</CardTitle>
            <UserCheck class="h-5 w-5 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div class="text-2xl font-bold">1,045</div>
            <p class="text-xs text-muted-foreground">Currently active</p>
          </CardContent>
        </Card>

        <Card class="card-bg-3 text-foreground">
          <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle class="text-sm font-medium">Total Loans</CardTitle>
            <Wallet class="h-5 w-5 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div class="text-2xl font-bold">₱5,200,000</div>
            <p class="text-xs text-muted-foreground">Overall disbursed</p>
          </CardContent>
        </Card>

        <Card class="card-bg-4 text-foreground">
          <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle class="text-sm font-medium">Loans in Default</CardTitle>
            <AlertCircle class="h-5 w-5 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div class="text-2xl font-bold">₱150,000</div>
            <p class="text-xs text-muted-foreground">Currently overdue</p>
          </CardContent>
        </Card>
      </div>

      <!-- Graphs -->
      <div class="grid gap-4 md:grid-cols-2">
        <Card class="h-[300px]">
          <CardHeader>
            <CardTitle>Monthly Financial Performance</CardTitle>
          </CardHeader>
          <CardContent class="h-[240px]">
            <Bar v-if="barChartData" :data="barChartData" :options="barChartOptions" />
          </CardContent>
        </Card>

        <Card class="h-[300px]">
          <CardHeader>
            <CardTitle>Loan Repayment Trends</CardTitle>
          </CardHeader>
          <CardContent class="h-[240px]">
            <Line v-if="lineChartData" :data="lineChartData" :options="lineChartOptions" />
          </CardContent>
        </Card>
      </div>

      <!-- Pending Tasks Table -->
      <Card>
        <CardHeader>
          <CardTitle>Pending Tasks</CardTitle>
        </CardHeader>
        <CardContent>
          <Table>
            <TableHeader>
              <TableRow>
                <TableHead>Task</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              <TableRow>
                <TableCell>Membership form of Juan Dela Cruz needs approval.</TableCell>
              </TableRow>
              <TableRow>
                <TableCell>Loan application for Maria Santos needs review.</TableCell>
              </TableRow>
              <TableRow>
                <TableCell>Payment verification required for Pedro Ramos.</TableCell>
              </TableRow>
            </TableBody>
          </Table>
        </CardContent>
      </Card>

    </div>
  </AppLayout>
</template>

<style scoped>
.card-bg-1 {
  background-color: var(--card-1);
}

.card-bg-2 {
  background-color: var(--card-2);
}

.card-bg-3 {
  background-color: var(--card-3);
}

.card-bg-4 {
  background-color: var(--card-4);
}
</style>
