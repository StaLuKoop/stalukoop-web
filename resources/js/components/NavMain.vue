<script setup lang="ts">
import {
  SidebarGroup,
  SidebarGroupLabel,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
} from '@/components/ui/sidebar'

import { Link, usePage } from '@inertiajs/vue3'
import { type NavItem } from '@/types'

defineProps<{
  sections: {
    label?: string
    items: NavItem[]
  }[]
}>()

const page = usePage()
</script>

<template>
  <template v-for="section in sections" :key="section.label ?? section.items[0].title">
    <SidebarGroup class="px-2 py-0">
      <SidebarGroupLabel v-if="section.label">{{ section.label }}</SidebarGroupLabel>
      <SidebarMenu>
        <SidebarMenuItem v-for="item in section.items" :key="item.title">
          <SidebarMenuButton
            as-child
            :is-active="item.href === page.url"
            :tooltip="item.title"
          >
            <Link :href="item.href" class="flex items-center gap-2">
              <component :is="item.icon" v-if="item.icon" class="h-5 w-5 shrink-0" />
              <span class="truncate">{{ item.title }}</span>
            </Link>
          </SidebarMenuButton>
        </SidebarMenuItem>
      </SidebarMenu>
    </SidebarGroup>
  </template>
</template>
