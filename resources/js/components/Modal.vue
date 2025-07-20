<script setup lang="ts">
// No additional setup needed
// Planning to use in Calendar.vue
</script>

<template>
  <div class="fixed inset-0 z-[99999] flex items-center justify-center bg-black/50 backdrop-blur-sm">
    <!-- Modal card -->
    <div
      class="relative w-full max-w-lg mx-4 sm:mx-auto bg-white dark:bg-gray-900 rounded-2xl shadow-xl p-6 sm:p-8 z-[999999] overflow-y-auto max-h-[90vh]"
      @click.stop
    >
      <!-- Close Button (optional, in case you want an X) -->
      <button
        class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 dark:hover:text-white"
        @click="$emit('close')"
        aria-label="Close modal"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
          stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>

      <!-- Modal Content -->
      <slot name="body" />
    </div>
  </div>
</template>
