<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import { ref, computed } from 'vue'
import dayjs from 'dayjs'
import { Edit, Trash2, UserCheck, UserX, Award, Key } from 'lucide-vue-next'

// 🔹 Breadcrumbs
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/admin/dashboard' },
  { title: 'PMES Management', href: '/admin/management/pmes' },
]

// 🔹 Schedule Data (mock)
const schedules = ref([
  { id: 1, date: '2025-11-10', time: '09:00 AM - 12:00 PM', mode: 'Online', availableSlots: 20, attendanceCode: 'PMES10A', meetingLink: 'https://zoom.us/j/123456789' },
  { id: 2, date: '2025-11-15', time: '01:00 PM - 04:00 PM', mode: 'Face-to-Face', availableSlots: 25, attendanceCode: 'PMES15B', meetingLink: '' },
])

// 🔹 Attendees Data (mock)
const attendees = ref([
  { id: 1, name: 'Jane Doe', email: 'jane@email.com', contact: '09123456789', scheduleId: 1, status: 'Approved', certificateIssued: false },
  { id: 2, name: 'Mark Dela Cruz', email: 'mark@email.com', contact: '09998887777', scheduleId: 1, status: 'Attended', certificateIssued: true },
  { id: 3, name: 'Ella Santos', email: 'ella@email.com', contact: '09112223333', scheduleId: 2, status: 'Pending', certificateIssued: false },
])

// 🔹 Current Month Filter
const currentMonth = dayjs().format('YYYY-MM')
const filteredSchedules = computed(() =>
  schedules.value.filter(s => s.date.startsWith(currentMonth))
)

// 🔹 State
const selectedSchedule = ref<number | null>(null)
const newSchedule = ref({ date: '', time: '', mode: 'Online', availableSlots: 20, attendanceCode: '', meetingLink: '' })
const editingId = ref<number | null>(null)

// 🔹 Generate Random Attendance Code
const generateCode = () => {
  const random = Math.random().toString(36).substring(2, 7).toUpperCase()
  newSchedule.value.attendanceCode = `PMES${random}`
}

// 🔹 Schedule Actions
const addSchedule = () => {
  if (!newSchedule.value.date || !newSchedule.value.time || !newSchedule.value.attendanceCode) {
    return alert('Please fill all fields and generate a code.')
  }
  schedules.value.push({ id: Date.now(), ...newSchedule.value })
  newSchedule.value = { date: '', time: '', mode: 'Online', availableSlots: 20, attendanceCode: '', meetingLink: '' }
}

const editSchedule = (id: number) => {
  const sched = schedules.value.find(s => s.id === id)
  if (sched) {
    editingId.value = id
    newSchedule.value = { ...sched }
  }
}

const updateSchedule = () => {
  const index = schedules.value.findIndex(s => s.id === editingId.value)
  if (index !== -1) {
    schedules.value[index] = { id: editingId.value!, ...newSchedule.value }
    editingId.value = null
    newSchedule.value = { date: '', time: '', mode: 'Online', availableSlots: 20, attendanceCode: '', meetingLink: '' }
  }
}

const deleteSchedule = (id: number) => {
  if (confirm('Delete this schedule?')) {
    schedules.value = schedules.value.filter(s => s.id !== id)
    attendees.value = attendees.value.filter(a => a.scheduleId !== id)
  }
}

// 🔹 Attendee Actions
const getAttendeesBySchedule = (id: number) => attendees.value.filter(a => a.scheduleId === id)

const markAttendance = (attendeeId: number, attended: boolean) => {
  const attendee = attendees.value.find(a => a.id === attendeeId)
  if (attendee) attendee.status = attended ? 'Attended' : 'Absent'
}

const issueCertificate = (attendeeId: number) => {
  const attendee = attendees.value.find(a => a.id === attendeeId)
  if (!attendee) return
  if (attendee.status !== 'Attended') return alert('Only attendees can receive certificates.')
  attendee.certificateIssued = true
  alert(`Certificate issued for ${attendee.name}`)
}
</script>

<template>
  <Head title="PMES Management" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col gap-6 p-6">
      <h1 class="text-2xl font-bold">PMES (Pre-Membership Education Seminar) Management</h1>

      <!-- 🗓 Schedule Form -->
      <div class="bg-white border rounded-lg shadow-sm p-4">
        <h2 class="font-semibold mb-3">{{ editingId ? 'Edit Schedule' : 'Add New Schedule' }}</h2>
        <div class="grid md:grid-cols-6 gap-4">
          <div>
            <label class="text-sm font-medium">Date</label>
            <input type="date" v-model="newSchedule.date" class="w-full border rounded-md px-2 py-1" />
          </div>
          <div>
            <label class="text-sm font-medium">Time</label>
            <input type="text" v-model="newSchedule.time" placeholder="e.g. 9:00 AM - 12:00 PM" class="w-full border rounded-md px-2 py-1" />
          </div>
          <div>
            <label class="text-sm font-medium">Mode</label>
            <select v-model="newSchedule.mode" class="w-full border rounded-md px-2 py-1">
              <option>Online</option>
              <option>Face-to-Face</option>
            </select>
          </div>
          <div>
            <label class="text-sm font-medium">Slots</label>
            <input type="number" min="1" v-model.number="newSchedule.availableSlots" class="w-full border rounded-md px-2 py-1" />
          </div>
          <div>
            <label class="text-sm font-medium flex items-center justify-between">
              Attendance Code
              <button type="button" @click="generateCode" class="text-blue-600 text-xs flex items-center gap-1 hover:text-blue-800">
                <Key class="w-4 h-4" /> Generate
              </button>
            </label>
            <input type="text" v-model="newSchedule.attendanceCode" placeholder="PMESXXXXX" readonly class="w-full border rounded-md px-2 py-1" />
          </div>
          <div v-if="newSchedule.mode === 'Online'">
            <label class="text-sm font-medium">Online Meeting Link</label>
            <input type="url" v-model="newSchedule.meetingLink" placeholder="https://zoom.us/..." class="w-full border rounded-md px-2 py-1" />
          </div>
        </div>

        <button @click="editingId ? updateSchedule() : addSchedule()" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
          {{ editingId ? 'Update' : 'Add' }}
        </button>
      </div>

      <!-- 📅 Schedule List -->
      <div class="bg-white border rounded-lg shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
          <thead class="bg-gray-50 text-gray-700">
            <tr>
              <th class="px-4 py-3 text-left">Date</th>
              <th class="px-4 py-3 text-left">Time</th>
              <th class="px-4 py-3 text-left">Mode</th>
              <th class="px-4 py-3 text-left">Slots</th>
              <th class="px-4 py-3 text-left">Attendance Code</th>
              <th class="px-4 py-3 text-left">Meeting Link</th>
              <th class="px-4 py-3 text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="sched in filteredSchedules" :key="sched.id" class="hover:bg-gray-50 cursor-pointer" @click="selectedSchedule = sched.id">
              <td class="px-4 py-3 font-medium">{{ sched.date }}</td>
              <td class="px-4 py-3">{{ sched.time }}</td>
              <td class="px-4 py-3">{{ sched.mode }}</td>
              <td class="px-4 py-3">{{ sched.availableSlots }}</td>
              <td class="px-4 py-3 font-mono text-xs text-gray-700">{{ sched.attendanceCode }}</td>
              <td class="px-4 py-3 break-all">
                <span v-if="sched.mode === 'Online'" class="text-blue-600 underline">{{ sched.meetingLink }}</span>
                <span v-else>-</span>
              </td>
              <td class="px-4 py-3 text-center space-x-2">
                <button @click.stop="editSchedule(sched.id)" class="text-blue-600 hover:text-blue-800"><Edit class="w-5 h-5 inline" /></button>
                <button @click.stop="deleteSchedule(sched.id)" class="text-red-600 hover:text-red-800"><Trash2 class="w-5 h-5 inline" /></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- 👥 Attendees List -->
      <div v-if="selectedSchedule" class="bg-white border rounded-lg shadow-sm p-4">
        <h2 class="font-semibold mb-3">
          Attendees for {{ schedules.find(s => s.id === selectedSchedule)?.date }} ({{ schedules.find(s => s.id === selectedSchedule)?.time }})
        </h2>

        <table class="min-w-full divide-y divide-gray-200 text-sm">
          <thead class="bg-gray-50 text-gray-700">
            <tr>
              <th class="px-4 py-3 text-left">Name</th>
              <th class="px-4 py-3 text-left">Email</th>
              <th class="px-4 py-3 text-left">Contact</th>
              <th class="px-4 py-3 text-center">Status</th>
              <th class="px-4 py-3 text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="att in getAttendeesBySchedule(selectedSchedule)" :key="att.id">
              <td class="px-4 py-3 font-medium">{{ att.name }}</td>
              <td class="px-4 py-3">{{ att.email }}</td>
              <td class="px-4 py-3">{{ att.contact }}</td>
              <td class="px-4 py-3 text-center">
                <span
                  :class="[
                    'rounded-full px-3 py-1 text-xs font-semibold',
                    att.status === 'Pending'
                      ? 'bg-yellow-100 text-yellow-700'
                      : att.status === 'Approved'
                      ? 'bg-blue-100 text-blue-700'
                      : att.status === 'Attended'
                      ? 'bg-green-100 text-green-700'
                      : 'bg-red-100 text-red-700',
                  ]"
                >
                  {{ att.status }}
                </span>
              </td>
              <td class="px-4 py-3 text-center space-x-2">
                <button @click="markAttendance(att.id, true)" class="text-green-600 hover:text-green-800"><UserCheck class="w-5 h-5 inline" /></button>
                <button @click="markAttendance(att.id, false)" class="text-red-600 hover:text-red-800"><UserX class="w-5 h-5 inline" /></button>
                <button v-if="att.status === 'Attended' && !att.certificateIssued" @click="issueCertificate(att.id)" class="text-blue-600 hover:text-blue-800"><Award class="w-5 h-5 inline" /></button>
                <span v-if="att.certificateIssued" class="text-green-600 font-semibold text-xs">🎓 Issued</span>
              </td>
            </tr>
            <tr v-if="getAttendeesBySchedule(selectedSchedule).length === 0">
              <td colspan="6" class="text-center py-4 text-gray-500">No attendees registered for this schedule.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AppLayout>
</template>
