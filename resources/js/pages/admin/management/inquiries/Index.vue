<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'

import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import { ref } from 'vue'

defineProps(['inquiries'])

const expandedRow = ref<number | null>(null)

const toggleRow = (id: number) => {
  expandedRow.value = expandedRow.value === id ? null : id
}

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

      <!-- Table -->
      <div class="w-full overflow-x-auto rounded-md border">
        <Table class="min-w-[1024px] text-sm">
          <TableHeader>
            <TableRow>
              <TableHead class="w-[60px] text-center">ID</TableHead>
              <TableHead class="min-w-[150px]">Name</TableHead>
              <TableHead class="min-w-[160px]">Inquiry</TableHead>
              <TableHead class="min-w-[180px]">Date</TableHead>
              <TableHead class="text-center w-[140px]">Actions</TableHead>
            </TableRow>
          </TableHeader>

          <TableBody>
            <template v-for="inquiry in inquiries" :key="inquiry.id">
              <!-- Main row -->
              <TableRow>
                <TableCell class="text-center font-medium text-muted-foreground">
                  {{ inquiry.id }}
                </TableCell>
                <TableCell>{{ inquiry.first_name }} {{ inquiry.last_name }}</TableCell>
                <TableCell>{{ inquiry.inquiry }}</TableCell>
                <TableCell>
                  {{ new Date(inquiry.created_at).toLocaleString() }}
                </TableCell>
                <TableCell class="text-center">
                  <div class="inline-flex items-center justify-center gap-1">
                    <Button size="sm" variant="outline" @click="toggleRow(inquiry.id)">
                      {{ expandedRow === inquiry.id ? 'Hide' : 'View' }}
                    </Button>
                    <Button size="sm" variant="destructive">Delete</Button>
                  </div>
                </TableCell>
              </TableRow>

              <!-- Expanded detail row -->
              <TableRow v-if="expandedRow === inquiry.id" class="bg-muted/50">
                <TableCell colspan="5">
                  <div class="pl-6">
                    <div class="ml-4 space-y-2">
                      <p><strong>Email:</strong> {{ inquiry.email }}</p>
                      <p><strong>Phone:</strong> {{ inquiry.phone }}</p>
                      <p><strong>Message:</strong></p>
                      <div class="rounded border bg-white p-2 break-words whitespace-pre-line">
                        {{ inquiry.message }}
                      </div>
                    </div>
                  </div>
                </TableCell>
              </TableRow>
            </template>
          </TableBody>
        </Table>
      </div>
    </div>
  </AppLayout>
</template>
