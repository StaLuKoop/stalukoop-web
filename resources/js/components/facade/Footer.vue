<script setup lang="ts">
import { IconBrandFacebook, IconPhoneCall } from '@tabler/icons-vue';
import { Mail } from 'lucide-vue-next';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const currentYear = new Date().getFullYear();
const page = usePage();

const isTermsPage = computed(() => page.url === '/terms-and-conditions');
const isPrivacyPage = computed(() => page.url === '/privacy-policy');
</script>

<template>
  <footer class="bg-rose-600 py-6 text-white">
    <div class="container mx-auto flex flex-col items-center gap-3">

      <!-- Icons Row -->
      <div class="flex gap-4">
        <a
          href="https://www.facebook.com/SLPCC1995/"
          target="_blank"
          rel="noopener noreferrer"
          class="hover:text-gray-300"
        >
          <IconBrandFacebook class="h-5 w-5" />
        </a>
        <a href="mailto:staluciacoop@gmail.com" class="hover:text-gray-300">
          <Mail class="h-5 w-5" />
        </a>
        <a href="tel:+639123456789" class="hover:text-gray-300">
          <IconPhoneCall class="h-5 w-5" />
        </a>
      </div>

      <!-- Links Row -->
      <div class="text-sm flex gap-2 text-white">
        <a
          href="/terms-and-conditions"
          :class="{ underline: isTermsPage, 'hover:underline': !isTermsPage }"
        >
          Terms & Conditions
        </a>
        <span class="mx-1">&bull;</span>
        <a
          href="/privacy-policy"
          :class="{ underline: isPrivacyPage, 'hover:underline': !isPrivacyPage }"
        >
          Privacy Policy
        </a>
      </div>

      <!-- Copyright Row -->
      <div class="text-center text-sm">
        &copy; {{ currentYear }} Sta. Lucia Parish Multipurpose Cooperative. All rights reserved.
      </div>
    </div>
  </footer>
</template>
