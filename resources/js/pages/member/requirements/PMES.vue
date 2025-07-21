<script setup lang="ts">
import { ref, computed } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/member/dashboard' },
  { title: 'Pre-Membership Education Seminar', href: '/member/requirements/pre-membership-seminar' },
]

const email = ref('')
const phone = ref('')

const minDate = computed(() => {
  const today = new Date().toISOString().split('T')[0]
  return today
})

const isValidEmail = computed(() => {
  const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
  return emailPattern.test(email.value)
})

const isValidPhone = computed(() => {
  const phonePattern = /^\+63\d{9}$/
  return phonePattern.test(phone.value)
})

const isValidForm = computed(() => {
  return isValidEmail.value && isValidPhone.value
})

const sanitizePhone = (event: Event) => {
  const input = event.target as HTMLInputElement;
  let value = input.value;
  
  // Only allow numbers and "+63"
  value = value.replace(/[^0-9+]/g, ''); // Remove any non-numeric and non "+" characters
  
  // Enforce starting with +63
  if (value.startsWith('+63')) {
    input.value = value;
  } else {
    input.value = '+63'; // Ensure that it starts with +63
  }
  
  phone.value = input.value; // Update the model
};

// Function to handle form submission
const submitForm = () => {
  // Display confirmation popup
  if (confirm('Are you sure you want to submit the form?')) {
    // Display success message upon confirmation
    alert('Form successfully submitted!');
  }
}
</script>

<template>
  <Head title="Pre-Membership Education Seminar" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-6 mx-6">
      <h1 class="text-xl font-semibold">Pre-Membership Education Seminar</h1>

      <div class="space-y-6">
        <h2 class="text-lg font-medium">Choose Your Preference</h2>
        <div class="flex gap-4">
          <label class="flex items-center">
        <input type="radio" name="session" value="online" class="mr-2" />
        PMES Digitally (Online)
      </label>

      <label class="flex items-center">
        <input type="radio" name="session" value="face-to-face" class="mr-2" />
        Face to Face (F2F)
      </label>

        </div>

        <h2 class="text-lg font-medium">Schedule Your Session</h2>
        <div class="flex gap-4">
          <input
            type="date"
            name="session-date"
            class="w-1/2 p-2 border rounded-lg"
            :min="minDate"
          />
          <input
            type="time"
            name="session-time"
            class="w-1/2 p-2 border rounded-lg"
          />
        </div>

        <h2 class="text-lg font-medium">Provide your contact information</h2>
        <div class="flex gap-4">
          <input
            type="text"
            placeholder="First Name"
            class="w-1/3 p-2 border rounded-lg"
          />
          <input
            type="text"
            placeholder="Middle Name"
            class="w-1/3 p-2 border rounded-lg"
          />
          <input
            type="text"
            placeholder="Last Name"
            class="w-1/3 p-2 border rounded-lg"
          />
        </div>
        <div class="flex gap-4 mt-2">
          <input
            type="email"
            placeholder="Email Address"
            class="w-1/2 p-2 border rounded-lg"
            v-model="email"
          />
          <input
            type="tel"
            placeholder="+63XXXXXXXXX"
            class="w-1/2 p-2 border rounded-lg"
            v-model="phone"
            @input="sanitizePhone"
          />
        </div>

        <h2 class="text-lg font-medium">Answer Initial Questions</h2>
        <div class="space-y-4">
          <div>
            <label for="goals" class="block font-medium">What are your goals for joining the coop?</label>
            <textarea id="goals" class="w-full p-2 border rounded-lg" rows="4"></textarea>
          </div>

          <div>
            <label for="coop-meaning" class="block font-medium">What does coop mean to you?</label>
            <textarea id="coop-meaning" class="w-full p-2 border rounded-lg" rows="4"></textarea>
          </div>
        </div>

        <!-- Submit Button -->
    <div class="flex justify-end mt-6">
      <button @click="submitForm" class="btn btn-primary bg-blue-500 text-white py-2 px-6 rounded-lg">Submit</button>
    </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
.btn {
  padding: 0.75rem 2rem;
  background-color: #DA251C;
  border: none;
  color: white;
  border-radius: 0.375rem;
  cursor: pointer;
}

.btn:hover {
  background-color: lightcoral;
}
</style>