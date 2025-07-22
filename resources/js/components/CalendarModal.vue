<script setup lang="ts">
// No additional setup needed
</script>

<template>
  <!-- Backdrop -->
  <div class="fixed inset-0 z-[99999] flex items-center justify-center bg-black/60 backdrop-blur-sm px-4 sm:px-6">

    <!-- Modal Card -->
    <div
      class="relative w-full max-w-2xl mx-auto bg-white dark:bg-gray-900 rounded-xl shadow-2xl p-6 sm:p-8 z-[999999] overflow-y-auto max-h-[90vh] transition-all"
      @click.stop
    >
      <!-- Header -->
      <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white">
          <slot name="header">Event Details</slot>
        </h3>
        <button
          @click="$emit('close')"
          class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition"
          aria-label="Close modal"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Modal Content -->
      <div class="space-y-4 text-sm text-gray-700 dark:text-gray-300">
        <slot name="body" />
      </div>

      <!-- Footer (optional) -->
      <div class="mt-6 flex justify-end gap-2">
        <slot name="footer" />
      </div>
    </div>
  </div>
</template>
