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
    class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0"
  >
    <div class="relative hidden h-full flex-col bg-muted p-10 text-white lg:flex dark:border-r">
      <div class="absolute inset-0 bg-gradient-to-tl from-primary to-[#2c186d]" />
      <Link :href="route('home')" class="relative z-20 flex items-center text-3xl font-medium">
        <AppLogoIcon class="mr-2 size-16 fill-current text-white" />
        Welcome to {{ name }}!
      </Link>
      <div class="relative flex flex-1 items-center justify-center text-3xl font-bold">
        <!-- We could put something here. -->
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
    <div class="lg:p-8">
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
