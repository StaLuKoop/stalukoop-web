<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'

import { Input } from '@/components/ui/input'
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'

defineProps(['inquiries'])

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/admin/dashboard' },
  { title: 'Inquiries', href: '/admin/management/inquiries' },
]
</script>

<template>
  <Head title="Inquiry Management" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col gap-4 p-4">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Inquiry Management</h1>
      </div>

      <!-- Search -->
      <div class="w-full md:w-1/3">
        <Input placeholder="Search inquiries..." />
      </div>

      <!-- Table Scroll Container -->
      <div class="w-full overflow-x-auto">
        <Table class="min-w-[1024px]">
          <TableHeader>
            <TableRow>
              <TableHead>Name</TableHead>
              <TableHead>Email</TableHead>
              <TableHead>Phone</TableHead>
              <TableHead>Inquiry</TableHead>
              <TableHead class="w-[400px]">Message</TableHead>
              <TableHead>Date</TableHead>
            </TableRow>
          </TableHeader>

          <TableBody>
            <TableRow v-for="inquiry in inquiries" :key="inquiry.id">
              <TableCell>{{ inquiry.first_name }} {{ inquiry.last_name }}</TableCell>
              <TableCell>{{ inquiry.email }}</TableCell>
              <TableCell>{{ inquiry.phone }}</TableCell>
              <TableCell>{{ inquiry.inquiry }}</TableCell>
              <!-- Let message wrap inside fixed width -->
              <TableCell class="whitespace-normal break-words w-[400px] max-w-[400px]">
                {{ inquiry.message }}
              </TableCell>
              <TableCell>{{ new Date(inquiry.created_at).toLocaleString() }}</TableCell>
            </TableRow>
          </TableBody>
        </Table>
      </div>
    </div>
  </AppLayout>
</template>
