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
      class="px-3 py-1 border rounded text-sm"
      :class="{
        'bg-primary text-white': link.active,
        'text-gray-400': !link.url,
      }"
      :disabled="!link.url"
      @click="navigate(link.url)"
      v-html="link.label"
    />
  </div>
</template>
