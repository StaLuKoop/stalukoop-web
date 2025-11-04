<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'
import dayjs from 'dayjs'

// ✅ Import icons from lucide-vue-next
import { Edit, CheckCircle, Trash2, XCircle, UserCheck, UserX } from 'lucide-vue-next'

// 🔹 Breadcrumbs
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/admin/dashboard' },
  { title: 'PMES', href: '/admin/management/pmes' },
]

// 🔹 Mock Data
const pmesSessions = ref([
  {
    id: 1,
    name: 'Jane Doe',
    email: 'jane.doe@email.com',
    contact: '123-456-7890',
    preference: 'Online',
    date: '2025-11-10',
    answer: 'I am excited to join the cooperative!',
    status: 'Pending',
  },
  {
    id: 2,
    name: 'Mark Dela Cruz',
    email: 'mark@email.com',
    contact: '987-654-3210',
    preference: 'Face-to-Face',
    date: '2025-10-20',
    answer: 'Looking forward to learning more.',
    status: 'Approved',
  },
  {
    id: 3,
    name: 'Ella Santos',
    email: 'ella@email.com',
    contact: '555-123-4567',
    preference: 'Online',
    date: '2025-10-15',
    answer: 'To understand cooperative values.',
    status: 'Attended',
  },
  {
    id: 4,
    name: 'Liam Garcia',
    email: 'liam@email.com',
    contact: '555-777-8888',
    preference: 'Online',
    date: '2025-10-15',
    answer: 'To learn savings discipline.',
    status: 'Absent',
  },
])

const today = dayjs()
const hasPassed = (date: string) => dayjs(date).isBefore(today, 'day')

// 🔹 Actions
const approveSession = (id: number) => {
  const session = pmesSessions.value.find((s) => s.id === id)
  if (session && confirm(`Approve schedule for ${session.name}?`)) {
    session.status = 'Approved'
  }
}

const editSession = (id: number) => {
  const session = pmesSessions.value.find((s) => s.id === id)
  if (session) alert(`Editing session for ${session.name}...`)
}

const deleteSession = (id: number) => {
  const session = pmesSessions.value.find((s) => s.id === id)
  if (session && confirm(`Delete record of ${session.name}?`)) {
    pmesSessions.value = pmesSessions.value.filter((s) => s.id !== id)
  }
}

const markAttendance = (id: number, attended: boolean) => {
  const session = pmesSessions.value.find((s) => s.id === id)
  if (session) session.status = attended ? 'Attended' : 'Absent'
}
</script>

<template>
  <Head title="PMES Sessions" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-6">
      <h1 class="text-2xl font-bold">PMES (Pre Membership Education Seminar)</h1>

      <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm bg-white">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
          <thead class="bg-gray-50 text-gray-700">
            <tr>
              <th class="px-4 py-3 text-left font-semibold">ID</th>
              <th class="px-4 py-3 text-left font-semibold">Name</th>
              <th class="px-4 py-3 text-left font-semibold">Email</th>
              <th class="px-4 py-3 text-left font-semibold">Contact No.</th>
              <th class="px-4 py-3 text-left font-semibold">Preference</th>
              <th class="px-4 py-3 text-left font-semibold">Date</th>
              <th class="px-4 py-3 text-left font-semibold">Answer</th>
              <th class="px-4 py-3 text-center font-semibold">Status</th>
              <th class="px-4 py-3 text-center font-semibold">Actions</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-100 bg-white">
            <tr v-for="session in pmesSessions" :key="session.id">
              <td class="px-4 py-3 font-medium text-gray-900">{{ session.id }}</td>
              <td class="px-4 py-3">{{ session.name }}</td>
              <td class="px-4 py-3">{{ session.email }}</td>
              <td class="px-4 py-3">{{ session.contact }}</td>
              <td class="px-4 py-3">{{ session.preference }}</td>
              <td class="px-4 py-3">{{ session.date }}</td>
              <td class="px-4 py-3 truncate max-w-xs">{{ session.answer }}</td>

              <td class="px-4 py-3 text-center">
                <span
                  :class="[
                    'rounded-full px-3 py-1 text-xs font-semibold',
                    session.status === 'Pending'
                      ? 'bg-yellow-100 text-yellow-700'
                      : session.status === 'Approved'
                      ? 'bg-blue-100 text-blue-700'
                      : session.status === 'Attended'
                      ? 'bg-green-100 text-green-700'
                      : 'bg-red-100 text-red-700',
                  ]"
                >
                  {{ session.status }}
                </span>
              </td>

              <td class="px-4 py-3 text-center space-x-2">
                <!-- ✅ Pending: Edit / Approve -->
                <template v-if="!hasPassed(session.date) && session.status === 'Pending'">
                  <button
                    class="text-blue-600 hover:text-blue-800"
                    title="Edit Session"
                    @click="editSession(session.id)"
                  >
                    <Edit class="w-5 h-5 inline" />
                  </button>
                  <button
                    class="text-green-600 hover:text-green-800"
                    title="Approve Session"
                    @click="approveSession(session.id)"
                  >
                    <CheckCircle class="w-5 h-5 inline" />
                  </button>
                </template>

                <!-- ✅ Approved + Date Passed: Mark Attendance -->
                <template v-else-if="hasPassed(session.date) && session.status === 'Approved'">
                  <button
                    class="text-green-600 hover:text-green-800"
                    title="Mark Attended"
                    @click="markAttendance(session.id, true)"
                  >
                    <UserCheck class="w-5 h-5 inline" />
                  </button>
                  <button
                    class="text-red-600 hover:text-red-800"
                    title="Mark Absent"
                    @click="markAttendance(session.id, false)"
                  >
                    <UserX class="w-5 h-5 inline" />
                  </button>
                </template>

                <!-- ✅ Attended: Delete -->
                <template v-else-if="session.status === 'Attended'">
                  <button
                    class="text-gray-600 hover:text-gray-800"
                    title="Delete Record"
                    @click="deleteSession(session.id)"
                  >
                    <Trash2 class="w-5 h-5 inline" />
                  </button>
                </template>

                <!-- ❌ Absent: No Action -->
                <template v-else-if="session.status === 'Absent'">
                  <XCircle class="w-5 h-5 text-gray-400 mx-auto" title="No Action Available" />
                </template>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AppLayout>
</template>
