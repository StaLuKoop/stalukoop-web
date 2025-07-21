<script setup lang="ts">
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

type Member = {
  id: number
  name: string
  email: string
  membership_status: string | null
}

const { props } = usePage()
const members = computed(() => props.members as Member[])

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

      <div class="w-full md:w-1/3">
        <Input placeholder="Search members..." />
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
    </div>
  </AppLayout>
</template>
