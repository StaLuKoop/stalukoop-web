<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue'
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()
const role = page.props.auth.user?.role ?? ''

const capitalizedRole = computed(() => {
  return role.charAt(0).toUpperCase() + role.slice(1)
})
</script>

<template>
  <div
    class="flex aspect-square size-8 items-center justify-center rounded-md bg-sidebar text-sidebar-primary-foreground"
  >
    <AppLogoIcon class="size-8 fill-current text-white dark:text-black" />
  </div>
  <div class="ml-1 grid flex-1 text-left text-sm">
    <span class="mb-0.5 truncate leading-tight font-bold">
      SLPMC<span v-if="role"> ({{ capitalizedRole }})</span>
    </span>
  </div>
</template>
