<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import { Button } from '@/components/ui/button'

const page = usePage()
const user = page.props.auth?.user
</script>

<template>
  <header class="sticky top-0 z-50 bg-white shadow-md">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-5">
      <div class="flex items-center gap-3">
        <!-- Logo Image -->
        <img src="/images/SLPMC.png" alt="SLPMC Logo" class="h-10 w-auto" />

        <!-- Coop Name -->
        <div class="leading-tight">
          <p class="text-sm font-semibold text-primary uppercase">Sta. Lucia Parish</p>
          <p class="text-sm tracking-wider text-gray-700 uppercase dark:text-gray-300">Multipurpose Cooperative</p>
        </div>
      </div>

      <!-- Navigation Links -->
      <nav class="hidden gap-6 font-medium text-gray-700 md:flex">
        <Link :href="route('home')" class="hover:underline">Home</Link>
        <Link :href="route('about')" class="hover:underline">About</Link>
        <Link :href="route('contact')" class="hover:underline">Contact</Link>
        <Link :href="route('services')" class="hover:underline">Services</Link>
        <Link :href="route('membership')" class="hover:underline">Membership</Link>

        <!-- Guest Link -->
        <template v-if="!user">
          <Link :href="route('login')" class="hover:underline">Login</Link>
        </template>

        <!-- Authenticated User Link -->
        <template v-else>
          <Link :href="route('dashboard')" class="hover:underline">Dashboard</Link>
        </template>
      </nav>

      <!-- Mobile Menu (future toggle) -->
      <button class="md:hidden">
        <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
  </header>
</template>
