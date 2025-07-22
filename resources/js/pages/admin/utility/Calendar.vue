<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'
import { ref, reactive, onMounted } from 'vue'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import { DateSelectArg, EventClickArg, EventContentArg } from '@fullcalendar/core'

// Modal component
import Modal from '@/components/CalendarModal.vue'

const breadcrumbs = [
  { title: 'Dashboard', href: '/admin/dashboard' },
  { title: 'Calendar', href: '/admin/utility/calendar' },
]

const calendarRef = ref(null)
const isOpen = ref(false)
const selectedEvent = ref<any>(null)
const eventTitle = ref('')
const eventStartDate = ref('')
const eventEndDate = ref('')
const eventLevel = ref('')
const events = ref<any[]>([])

const calendarsEvents = reactive({
  Danger: 'danger',
  Success: 'success',
  Primary: 'primary',
  Warning: 'warning',
})

onMounted(() => {
  events.value = [
    {
      id: '1',
      title: 'Event Conf.',
      start: new Date().toISOString().split('T')[0],
      extendedProps: { calendar: 'Danger' },
    },
  ]
})

const openModal = () => (isOpen.value = true)
const closeModal = () => {
  isOpen.value = false
  resetModalFields()
}
const resetModalFields = () => {
  eventTitle.value = ''
  eventStartDate.value = ''
  eventEndDate.value = ''
  eventLevel.value = ''
  selectedEvent.value = null
}

const handleDateSelect = (selectInfo: DateSelectArg) => {
  resetModalFields()
  eventStartDate.value = selectInfo.startStr
  eventEndDate.value = selectInfo.endStr || selectInfo.startStr
  openModal()
}

const handleEventClick = (clickInfo: EventClickArg) => {
  const event = clickInfo.event
  selectedEvent.value = event
  eventTitle.value = event.title
  eventStartDate.value = event.start?.toISOString().split('T')[0] || ''
  eventEndDate.value = event.end?.toISOString().split('T')[0] || ''
  eventLevel.value = event.extendedProps.calendar
  openModal()
}

const handleAddOrUpdateEvent = () => {
  if (selectedEvent.value) {
    events.value = events.value.map((event) =>
      event.id === selectedEvent.value.id
        ? {
            ...event,
            title: eventTitle.value,
            start: eventStartDate.value,
            end: eventEndDate.value,
            extendedProps: { calendar: eventLevel.value },
          }
        : event
    )
  } else {
    const newEvent = {
      id: Date.now().toString(),
      title: eventTitle.value,
      start: eventStartDate.value,
      end: eventEndDate.value,
      allDay: true,
      extendedProps: { calendar: eventLevel.value },
    }
    events.value.push(newEvent)
  }
  closeModal()
}

const handleDeleteEvent = () => {
  if (selectedEvent.value) {
    events.value = events.value.filter((event) => event.id !== selectedEvent.value.id)
    closeModal()
  }
}

const renderEventContent = (eventInfo: EventContentArg) => {
  const colorClass = `fc-bg-${eventInfo.event.extendedProps.calendar.toLowerCase()}`
  return {
    html: `
      <div class="event-fc-color flex fc-event-main ${colorClass} p-1 rounded-sm">
        <div class="fc-daygrid-event-dot"></div>
        <div class="fc-event-time">${eventInfo.timeText}</div>
        <div class="fc-event-title">${eventInfo.event.title}</div>
      </div>
    `,
  }
}

const calendarOptions = reactive({
  plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
  initialView: 'dayGridMonth',
  headerToolbar: {
    left: 'prev,next addEventButton',
    center: 'title',
    right: 'dayGridMonth,timeGridWeek,timeGridDay',
  },
  events: events,
  selectable: true,
  select: handleDateSelect,
  eventClick: handleEventClick,
  eventContent: renderEventContent,
  customButtons: {
    addEventButton: {
      text: 'Add Event +',
      click: openModal,
    },
  },
})
</script>


<template>
  <Head title="Calendar" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col gap-4 p-4">
      <h1 class="text-xl font-semibold">Calendar</h1>

      <div class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
        <FullCalendar ref="calendarRef" class="min-h-screen" :options="calendarOptions" />
      </div>

      <!-- Modal -->
      <Modal v-if="isOpen" @close="closeModal">
        <template #body>
          <div class="w-full max-w-xl p-4 bg-white rounded-2xl dark:bg-gray-900">
            <h5 class="text-lg font-semibold mb-2">
              {{ selectedEvent ? 'Edit Event' : 'Add Event' }}
            </h5>
            <div class="space-y-4">
              <div>
                <label class="block text-sm">Event Title</label>
                <input v-model="eventTitle" type="text" class="input w-full" />
              </div>
              <div>
                <label class="block text-sm">Event Color</label>
                <div class="flex flex-wrap gap-2">
                  <label v-for="(val, key) in calendarsEvents" :key="key" class="flex items-center gap-2">
                    <input type="radio" :value="key" v-model="eventLevel" />
                    <span class="capitalize">{{ key }}</span>
                  </label>
                </div>
              </div>
              <div>
                <label class="block text-sm">Start Date</label>
                <input v-model="eventStartDate" type="date" class="input w-full" />
              </div>
              <div>
                <label class="block text-sm">End Date</label>
                <input v-model="eventEndDate" type="date" class="input w-full" />
              </div>
              <div class="flex justify-end gap-2 mt-4">
                <button @click="closeModal" class="btn">Cancel</button>
                <button @click="handleAddOrUpdateEvent" class="btn btn-primary">
                  {{ selectedEvent ? 'Update' : 'Add' }}
                </button>
                <button v-if="selectedEvent" @click="handleDeleteEvent" class="btn btn-danger">
                  Delete
                </button>
              </div>
            </div>
          </div>
        </template>
      </Modal>
    </div>
  </AppLayout>
</template>
