<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import dayjs from 'dayjs'

// 🔹 Breadcrumbs
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/member/dashboard' },
  { title: 'Pre-Membership Education Seminar', href: '/member/requirements/pre-membership-seminar' },
]

// 🔹 Mock schedule list (for demo)
const schedules = ref([
  { id: 1, date: '2025-11-10', time: '09:00 AM - 12:00 PM', mode: 'Online', code: 'PMES10A', meetingLink: 'https://zoom.us/j/123456789', certificateIssued: true },
  { id: 2, date: '2025-11-15', time: '01:00 PM - 04:00 PM', mode: 'Face-to-Face', code: 'PMES15B', meetingLink: '', certificateIssued: false },
])

// 🔹 Current Month Filter
const currentMonth = dayjs().format('YYYY-MM')
const availableSchedules = computed(() =>
  schedules.value.filter((s) => s.date.startsWith(currentMonth))
)

// 🔹 Form State
const selectedScheduleId = ref<number | null>(null)
const name = ref({ first: '', middle: '', last: '' })
const email = ref('')
const phone = ref('+63')
const goals = ref('')
const coopMeaning = ref('')
const attendanceCode = ref('')
const isAttended = ref(false)
const canViewCertificate = ref(false)
const showCode = ref<number | null>(null)
const demoMessage = ref('')

// 🔹 Validation (dummy for demo)
const isValidForm = computed(() => selectedScheduleId.value && email.value && phone.value)

// 🔹 Sanitize Phone Input
const sanitizePhone = (event: Event) => {
  const input = event.target as HTMLInputElement
  let value = input.value.replace(/[^0-9+]/g, '')
  if (!value.startsWith('+63')) value = '+63'
  phone.value = value
  input.value = value
}

// 🔹 Demo button handlers
const toggleCode = (id: number) => {
  showCode.value = showCode.value === id ? null : id
  demoMessage.value = `Attendance code for schedule ${id} is revealed (demo).`
}

const demoClick = (action: string) => {
  demoMessage.value = `${action} clicked (demo).`
  if (action === 'Verify Attendance') {
    isAttended.value = true
    const chosen = schedules.value.find(s => s.id === selectedScheduleId.value)
    canViewCertificate.value = chosen?.certificateIssued || false
  }
}
</script>

<template>
  <Head title="Pre-Membership Education Seminar" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col gap-6 p-6">

      <h1 class="text-xl font-semibold">Pre-Membership Education Seminar (PMES)</h1>

      <!-- 🗓 SELECT SCHEDULE -->
      <div class="bg-white p-4 rounded-lg border shadow-sm">
        <h2 class="text-lg font-medium mb-3">Available Schedules</h2>
        <div v-if="availableSchedules.length" class="space-y-2">
          <label
            v-for="sched in availableSchedules"
            :key="sched.id"
            class="flex flex-col border p-3 rounded-md hover:bg-gray-50 cursor-pointer"
          >
            <div class="flex items-center gap-3">
              <input type="radio" name="schedule" :value="sched.id" v-model="selectedScheduleId" />
              <div>
                <p class="font-medium">{{ sched.mode }} – {{ sched.date }} ({{ sched.time }})</p>
              </div>
            </div>

            <!-- Online Meeting Link -->
            <div v-if="sched.mode === 'Online' && selectedScheduleId === sched.id" class="mt-1 text-blue-600 underline text-sm break-all">
              Meeting Link: <a :href="sched.meetingLink" target="_blank">{{ sched.meetingLink }}</a>
            </div>


          </label>
        </div>
        <p v-else class="text-gray-500 italic">No available schedules this month.</p>
      </div>

      <!-- 👤 USER DETAILS -->
      <div class="bg-white p-4 rounded-lg border shadow-sm">
        <h2 class="text-lg font-medium mb-3">Contact Information</h2>
        <div class="flex gap-4 mb-2">
          <input v-model="name.first" type="text" placeholder="First Name" class="w-1/3 p-2 border rounded-lg" />
          <input v-model="name.middle" type="text" placeholder="Middle Name" class="w-1/3 p-2 border rounded-lg" />
          <input v-model="name.last" type="text" placeholder="Last Name" class="w-1/3 p-2 border rounded-lg" />
        </div>
        <div class="flex gap-4">
          <input v-model="email" type="email" placeholder="Email Address" class="w-1/2 p-2 border rounded-lg" />
          <input v-model="phone" type="tel" placeholder="+63XXXXXXXXX" class="w-1/2 p-2 border rounded-lg" @input="sanitizePhone" />
        </div>
      </div>

      <!-- 🧭 INITIAL QUESTIONS -->
      <div class="bg-white p-4 rounded-lg border shadow-sm">
        <h2 class="text-lg font-medium mb-3">Initial Questions</h2>
        <textarea v-model="goals" placeholder="Your goals..." class="w-full p-2 border rounded-lg mb-2"></textarea>
        <textarea v-model="coopMeaning" placeholder="What does a cooperative mean to you?" class="w-full p-2 border rounded-lg"></textarea>
      </div>

      <!-- 📩 SUBMIT -->
      <div class="flex justify-end">
        <button @click="demoClick('Submit Registration')" :disabled="!isValidForm" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 disabled:opacity-50">
          Submit Registration
        </button>
      </div>

      <!-- ✅ ATTENDANCE CODE -->
      <div v-if="selectedScheduleId" class="bg-white p-4 rounded-lg border shadow-sm mt-6">
        <h2 class="text-lg font-medium mb-3">Attendance Verification</h2>
        <input v-model="attendanceCode" type="text" placeholder="Enter Attendance Code" class="p-2 border rounded-lg mr-2" />
        <button @click="demoClick('Verify Attendance')" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg">Verify</button>

        <!-- 🎓 Certificate -->
        <div v-if="isAttended && canViewCertificate" class="mt-4 p-4 border rounded-lg bg-green-50 text-green-700">
          <p class="font-medium">Congratulations! You can now view/download your certificate.</p>
          <a href="#" class="text-blue-600 underline mt-2 block">View Certificate</a>
        </div>
        <div v-else-if="isAttended && !canViewCertificate" class="mt-4 p-4 border rounded-lg bg-yellow-50 text-yellow-700">
          <p>Your attendance is verified. Certificate is not yet issued by admin.</p>
        </div>
      </div>


    </div>
  </AppLayout>
</template>
