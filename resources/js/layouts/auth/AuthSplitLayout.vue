<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue'
import { Link, usePage } from '@inertiajs/vue3'

const page = usePage()
const name = page.props.name
const quote = page.props.quote

defineProps<{
  title?: string
  description?: string
}>()
</script>

<template>
  <div
    class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-3 lg:px-0"
  >
    <div class="relative hidden h-full flex-col bg-muted p-10 text-white lg:flex dark:border-r">
      <div class="absolute inset-0 bg-gradient-to-tl from-primary to-[#2c186d]" />

      <div class="relative z-20 self-start">
        <Link :href="route('home')" class="text-sm text-neutral-200 hover:underline"> ← Back to Home </Link>
      </div>

      <div class="h-40 relative flex flex-1 flex-col items-center justify-center space-y-4 text-3xl font-bold">
        <Link :href="route('home')" class="flex items-center text-2xl font-medium text-white">
          <AppLogoIcon class="size-16 fill-current text-white" />
        </Link>
        <div class="relative z-20 text-3xl font-medium text-white">Welcome to {{ name }}-MS!</div>
      </div>

      <div v-if="quote" class="relative z-20 mt-auto">
        <blockquote class="space-y-2">
          <p class="text-lg">&ldquo;{{ quote.message }}&rdquo;</p>
          <footer class="text-sm text-neutral-300">
            {{ quote.author }}
          </footer>
        </blockquote>
      </div>
    </div>
    <div class="lg:p-8 lg:col-span-2">
      <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
        <!-- Logo Section -->
        <div class="flex justify-center lg:hidden">
          <Link :href="route('home')" class="flex items-center text-2xl font-medium text-white">
            <AppLogoIcon class="mr-2 size-16 fill-current text-white" />
          </Link>
        </div>

        <!-- Title + Description -->
        <div class="flex flex-col space-y-2 text-center">
          <h1 class="text-xl font-medium tracking-tight" v-if="title">
            {{ title }}
          </h1>
          <p class="text-sm text-muted-foreground" v-if="description">
            {{ description }}
          </p>
        </div>

        <!-- Form Slot -->
        <slot />
      </div>
    </div>
  </div>
</template>
