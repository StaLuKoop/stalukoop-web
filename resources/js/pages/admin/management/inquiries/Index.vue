<script setup lang="ts">
import Pagination from '@/components/Pagination.vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import AppLayout from '@/layouts/AppLayout.vue'
import { type AppPageProps, type BreadcrumbItem } from '@/types'
import { Head, router, usePage } from '@inertiajs/vue3'
import { ref, watch, watchEffect } from 'vue'

// Types

type Inquiry = {
  id: number
  first_name: string
  last_name: string
  email: string
  phone: string
  inquiry: string
  message: string
  created_at: string
}

type LocalPageProps = AppPageProps<{
  inquiries: {
    data: Inquiry[]
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

const page = usePage<LocalPageProps>()
const search = ref(page.props.filters.search ?? '')
const inquiries = ref<Inquiry[]>([])
const expandedRow = ref<number | null>(null)

const toggleRow = (id: number) => {
  expandedRow.value = expandedRow.value === id ? null : id
}

const performSearch = () => {
  router.get(
    '/admin/management/inquiries',
    { search: search.value },
    {
      preserveScroll: true,
      preserveState: true,
      replace: true,
    },
  )
}

watchEffect(() => {
  inquiries.value = page.props.inquiries.data
})

watch(search, (newVal) => {
  if (newVal === '') {
    performSearch()
  }
})

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/admin/dashboard' },
  { title: 'Inquiries', href: '/admin/management/inquiries' },
]
</script>

<template>
  <Head title="Inquiries" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
      <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Inquiries</h1>
      </div>

      <div class="flex w-full items-center gap-2 md:w-1/3">
        <Input v-model="search" placeholder="Search inquiries..." @keyup.enter="performSearch" />
        <Button @click="performSearch">Search</Button>
      </div>

      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>ID</TableHead>
            <TableHead>Name</TableHead>
            <TableHead>Email</TableHead>
            <TableHead>Phone</TableHead>
            <TableHead>Inquiry</TableHead>
            <TableHead>Date</TableHead>
            <TableHead class="text-right">Actions</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <template v-for="inquiry in inquiries" :key="inquiry.id">
            <TableRow>
              <TableCell>{{ inquiry.id }}</TableCell>
              <TableCell>{{ inquiry.first_name }} {{ inquiry.last_name }}</TableCell>
              <TableCell>{{ inquiry.email }}</TableCell>
              <TableCell>{{ inquiry.phone }}</TableCell>
              <TableCell>{{ inquiry.inquiry }}</TableCell>
              <TableCell>{{ new Date(inquiry.created_at).toLocaleString() }}</TableCell>
              <TableCell class="text-right">
                <Button size="sm" variant="outline" @click="toggleRow(inquiry.id)">
                  {{ expandedRow === inquiry.id ? 'Hide' : 'View' }}
                </Button>
              </TableCell>
            </TableRow>
            <TableRow v-if="expandedRow === inquiry.id" class="bg-gray-50">
              <TableCell colspan="7">
                <div class="p-4 text-sm whitespace-pre-wrap text-gray-700">
                  {{ inquiry.message }}
                </div>
              </TableCell>
            </TableRow>
          </template>
        </TableBody>
      </Table>

      <div class="mt-4">
        <Pagination :links="page.props.meta.links" />
      </div>
    </div>
  </AppLayout>
</template>
