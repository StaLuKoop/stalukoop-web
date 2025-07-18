<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue'
import NavMain from '@/components/NavMain.vue'
import NavUser from '@/components/NavUser.vue'

import {
  Sidebar,
  SidebarContent,
  SidebarFooter,
  SidebarHeader,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
} from '@/components/ui/sidebar'

import { Link, usePage } from '@inertiajs/vue3'
import {
  IconBrandFacebook,
  IconBrandGithub,
} from '@tabler/icons-vue'

import {
  Calculator,
  Calendar,
  Download,
  FileWarning,
  LayoutGrid,
  User,
  FileText,
} from 'lucide-vue-next'

import AppLogo from './AppLogo.vue'
import { computed } from 'vue'

const page = usePage()
const role = page.props.auth.user.role as 'admin' | 'member'

const mainNavSections = computed(() => {
  if (role === 'admin') {
    return [
      {
        items: [
          {
            title: 'Dashboard',
            href: '/admin/dashboard',
            icon: LayoutGrid,
          },
        ],
      },
      {
        label: 'Management',
        items: [
          { title: 'Members', href: '/admin/management/members', icon: User },
          { title: 'Inquiries', href: '/admin/management/inquiries', icon: FileWarning },
        ],
      },
      {
        label: 'Utilities',
        items: [
          { title: 'Calendar', href: '/admin/utility/calendar', icon: Calendar },
          { title: 'Calculator', href: '/admin/utility/calculator', icon: Calculator },
        ],
      },
    ]
  }

  if (role === 'member') {
    return [
      {
        items: [
          {
            title: 'Dashboard',
            href: '/member/dashboard',
            icon: LayoutGrid,
          },
        ],
      },
      {
        items: [
          {
            title: 'Profile',
            href: '/member/profile',
            icon: User,
          },
        ],
      },
      {
        label: 'Forms',
        items: [
          { title: 'Member Form', href: '/member/forms/member', icon: FileText },
          { title: 'Loan Form', href: '/member/forms/loan', icon: FileText },
        ],
      },
    ]
  }

  return []
})

const footerNavItems = [
  {
    title: 'SLPMC Facebook',
    href: 'https://www.facebook.com/SLPCC1995/',
    icon: IconBrandFacebook,
  },
  {
    title: 'Stalukoop Github',
    href: 'https://github.com/StaLuKoop',
    icon: IconBrandGithub,
  },
]
</script>


<template>
  <Sidebar collapsible="icon" variant="floating">
    <SidebarHeader>
      <SidebarMenu>
        <SidebarMenuItem>
          <SidebarMenuButton size="lg" as-child>
            <Link :href="route('dashboard')">
              <AppLogo />
            </Link>
          </SidebarMenuButton>
        </SidebarMenuItem>
      </SidebarMenu>
    </SidebarHeader>

    <SidebarContent>
      <NavMain :sections="mainNavSections" />
    </SidebarContent>

    <SidebarFooter>
      <NavFooter :items="footerNavItems" />
      <NavUser />
    </SidebarFooter>
  </Sidebar>

  <slot />
</template>
