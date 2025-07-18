<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import { Menu, X } from 'lucide-vue-next'
import { computed, ref } from 'vue'

const isOpen = ref(false)

const page = usePage()
const user = page.props.auth?.user

const currentComponent = computed(() => page.component)

const navClass = (componentName: string) => {
  return currentComponent.value === componentName ? 'text-primary font-semibold' : 'hover:text-primary'
}
</script>

<template>
  <header class="sticky top-0 z-50 bg-white shadow-md">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-5">
      <!-- Logo & Name -->
      <div class="flex items-center gap-3">
        <img src="/images/SLPMC.png" alt="SLPMC Logo" class="h-10 w-auto" />
        <div class="leading-tight">
          <p class="text-sm font-semibold text-primary uppercase">Sta. Lucia Parish</p>
          <p class="text-sm font-semibold tracking-wider text-gray-700 uppercase dark:text-gray-700">
            Multipurpose Cooperative
          </p>
        </div>
      </div>

      <!-- Desktop Nav -->
      <nav class="hidden items-center gap-6 font-medium text-gray-700 md:flex">
        <Link :href="route('home')" :class="navClass('Home')">Home</Link>
        <Link :href="route('about')" :class="navClass('About')">About</Link>
        <Link :href="route('contact')" :class="navClass('Contact')">Contact</Link>
        <Link :href="route('services')" :class="navClass('Services')">Services</Link>
        <Link :href="route('membership')" :class="navClass('Membership')">Membership</Link>
        <template v-if="!user">
          <Link :href="route('login')" class="rounded-md bg-primary px-4 py-2 text-white hover:bg-primary/90"
            >Login</Link
          >
        </template>
        <template v-else>
          <Link :href="route('dashboard')" class="rounded-md bg-primary px-4 py-2 text-white hover:bg-primary/90"
            >Dashboard</Link
          >
        </template>
      </nav>

      <!-- Hamburger Icon -->
      <button class="md:hidden" @click="isOpen = !isOpen" aria-label="Toggle Menu">
        <component :is="isOpen ? X : Menu" class="h-6 w-6 text-gray-700" />
      </button>
    </div>

    <!-- Mobile Menu -->
    <div v-if="isOpen" class="px-5 pb-5 md:hidden">
      <nav class="flex flex-col gap-3 font-medium text-gray-700">
        <Link :href="route('home')" :class="navClass('Home')">Home</Link>
        <Link :href="route('about')" :class="navClass('About')">About</Link>
        <Link :href="route('contact')" :class="navClass('Contact')">Contact</Link>
        <Link :href="route('services')" :class="navClass('Services')">Services</Link>
        <Link :href="route('membership')" :class="navClass('Membership')">Membership</Link>
        <template v-if="!user">
          <Link :href="route('login')" class="rounded-md bg-primary px-4 py-2 text-white hover:bg-primary/90"
            >Login</Link
          >
        </template>
        <template v-else>
          <Link :href="route('dashboard')" class="rounded-md bg-primary px-4 py-2 text-white hover:bg-primary/90"
            >Dashboard</Link
          >
        </template>
      </nav>
    </div>
  </header>
</template>
