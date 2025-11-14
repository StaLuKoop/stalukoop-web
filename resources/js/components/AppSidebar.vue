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
import { IconBrandFacebook, IconBrandGithub } from '@tabler/icons-vue'

import { Calculator, Calendar, FilePlus, FileSignature, FileText, FileWarning, HandCoins, Home, Landmark, LayoutGrid, User } from 'lucide-vue-next'

import { computed } from 'vue'
import AppLogo from './AppLogo.vue'

const page = usePage()
const role = page.props.auth.user.role as 'admin' | 'member'

const mainNavSections = computed(() => {
  if (role === 'admin') {
    return [
      {
        items: [
          {
            title: 'Home',
            href: '/',
            icon: Home,
          },
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
        label: 'Records',
        items: [
          { title: 'Loans', href: '/admin/management/loans', icon: HandCoins },
          { title: 'Loan Applications', href: '/admin/management/loanapplication', icon: FilePlus },
          { title: 'PMES Scheduling', href: '/admin/management/pmes', icon: FileWarning },
          { title: 'Credit Scoring', href: '/admin/management/creditscoring', icon: FileSignature },
        ],
      },
      {
        label: 'Utilities',
        items: [
          { title: 'Reports', href: '/admin/utility/reports', icon: FileText },
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
            title: 'Home',
            href: '/',
            icon: Home,
          },
          {
            title: 'Dashboard',
            href: '/member/dashboard',
            icon: LayoutGrid,
          },
        ],
      },
      {
        label: 'Cooperative',
        items: [
          {
            title: 'Account',
            href: '/member/cooperative/account',
            icon: User,
          },
          {
            title: 'Policy',
            href: '/member/cooperative/policy',  // Direct link to Loan Policy
            icon: FileText,
          },
        ],
      },
      {
        label: 'Services',
        items: [
          {
            title: 'Loan Application',
            href: '/member/services/loan-application',
            icon: FilePlus,
          },
          {
            title: 'Credit Scoring',
            href: '/member/services/credit-scoring',
            icon: FileSignature,  // You can choose an appropriate icon for Credit Scoring
          },
          {
            title: 'Loan Status',
            href: '/member/services/loan-status',
            icon:  Landmark,  // Choose an appropriate icon for Loan Status
          },
        ],
      },
      {
        label: 'Requirements',
        items: [
          {
            title: 'Membership Form',
            href: '/member/requirements/membership-form',
            icon: FileSignature,
          },
          {
            title: 'PMES',
            href: '/member/requirements/pmes',
            icon: FileWarning,
          },
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
