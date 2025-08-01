<script setup lang="ts">
import { Head, router, usePage } from '@inertiajs/vue3'
import { ref, watch, watchEffect } from 'vue'

import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow
} from '@/components/ui/table'
import AppLayout from '@/layouts/AppLayout.vue'
import Pagination from '@/components/Pagination.vue'

import type { AppPageProps, BreadcrumbItem } from '@/types'

type Member = {
  id: number
  name: string
  email: string
  membership_status: string | null
}

type PageProps = AppPageProps<{
  members: {
    data: Member[]
  }
  filters: {
    search?: string
  }
  meta: {
    links: any[]
    current_page: number
    last_page: number
  }
}>

const page = usePage<PageProps>()

const search = ref(page.props.filters.search ?? '')
const members = ref<Member[]>([])

watchEffect(() => {
  members.value = page.props.members.data
})

const performSearch = () => {
  router.get(
    '/admin/management/members',
    { search: search.value },
    {
      preserveState: true,
      replace: true,
      preserveScroll: true,
    }
  )
}

watch(search, (newValue) => {
  if (newValue === '') {
    performSearch()
  }
})

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/admin/dashboard' },
  { title: 'Members', href: '/admin/management/members' },
]
</script>

<template>
  <Head title="Member Management" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
      <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Member Management</h1>
        <Button>Add Member</Button>
      </div>

      <div class="flex w-full md:w-1/3 items-center gap-2">
        <Input
          v-model="search"
          placeholder="Search members..."
          @keyup.enter="performSearch"
        />
        <Button @click="performSearch">Search</Button>
      </div>

      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>ID</TableHead>
            <TableHead>Name</TableHead>
            <TableHead>Email</TableHead>
            <TableHead>Status</TableHead>
            <TableHead class="text-right">Actions</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="member in members" :key="member.id">
            <TableCell>{{ member.id }}</TableCell>
            <TableCell>{{ member.name }}</TableCell>
            <TableCell>{{ member.email }}</TableCell>
            <TableCell>{{ member.membership_status }}</TableCell>
            <TableCell class="text-right">
              <Button size="sm" variant="outline">View</Button>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>

      <div>
        <Pagination :links="page.props.meta.links" />
      </div>
    </div>
  </AppLayout>
</template>
