<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'

// Sample data (replace with props or Inertia data)
const members = ref([
  { id: 1, name: 'Juan Dela Cruz', email: 'juan@example.com', status: 'Pending' },
  { id: 2, name: 'Maria Santos', email: 'maria@example.com', status: 'Approved' },
])

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/admin/dashboard' },
  { title: 'Members', href: '/admin/management/members' },
]
</script>

<template>
  <Head title="Member Management" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Member Management</h1>
        <Button>Add Member</Button>
      </div>

      <!-- Search Bar -->
      <div class="w-full md:w-1/3">
        <Input placeholder="Search members..." />
      </div>

      <!-- Data Table -->
      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>Name</TableHead>
            <TableHead>Email</TableHead>
            <TableHead>Status</TableHead>
            <TableHead class="text-right">Actions</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="member in members" :key="member.id">
            <TableCell>{{ member.name }}</TableCell>
            <TableCell>{{ member.email }}</TableCell>
            <TableCell>{{ member.status }}</TableCell>
            <TableCell class="text-right">
              <Button size="sm" variant="outline">View</Button>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  </AppLayout>
</template>
