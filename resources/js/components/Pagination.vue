<script setup lang="ts">
import { router } from '@inertiajs/vue3'

defineProps<{
  links: {
    url: string | null
    label: string
    active: boolean
  }[]
}>()

const navigate = (url: string | null) => {
  if (url) {
    router.get(url, {}, {
      preserveScroll: true,
      preserveState: true,
    })
  }
}
</script>

<template>
  <div class="flex gap-1 flex-wrap">
    <button
      v-for="(link, i) in links"
      :key="i"
      class="px-3 py-1 rounded text-sm transition duration-150 border"
      :class="[
        link.active
          ? 'bg-primary text-white border-primary'
          : link.url
            ? 'text-gray-700 border-gray-300 hover:bg-gray-100 hover:text-black cursor-pointer'
            : 'text-gray-400 border-gray-200 cursor-not-allowed'
      ]"
      :disabled="!link.url"
      @click="navigate(link.url)"
      v-html="link.label"
    />
  </div>
</template>
