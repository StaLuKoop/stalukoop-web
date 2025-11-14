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

import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogFooter } from '@/components/ui/dialog'

import type { AppPageProps, BreadcrumbItem } from '@/types'

type Member = {
  id: number
  name: string
  email: string
  membership_status: 'Pending' | 'Regular' | 'Inactive'
  date_joined?: string
  total_sharing_capital?: number
  total_savings?: number
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
const selectedMember = ref<Member | null>(null)
const showProfile = ref(false)

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

// --- Modal Actions ---
const viewMember = (member: Member) => {
  selectedMember.value = member
  showProfile.value = true
}

const closeModal = () => {
  selectedMember.value = null
  showProfile.value = false
}

const deleteMember = (id: number) => {
  if (confirm('Are you sure you want to delete this member?')) {
    router.delete(`/admin/management/members/${id}`, {
      preserveScroll: true,
    })
  }
}

const approveMember = (id: number) => {
  router.post(`/admin/management/members/${id}/approve`, {}, {
    preserveScroll: true,
    onSuccess: () => (showProfile.value = false),
  })
}

const rejectMember = (id: number) => {
  router.post(`/admin/management/members/${id}/reject`, {}, {
    preserveScroll: true,
    onSuccess: () => (showProfile.value = false),
  })
}
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
            <TableCell class="text-right space-x-2">
              <Button size="sm" variant="outline" @click="viewMember(member)">View</Button>
              <Button size="sm" variant="destructive" @click="deleteMember(member.id)">Delete</Button>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>

      <div>
        <Pagination :links="page.props.meta.links" />
      </div>
    </div>

    <!-- View Profile Modal -->
    <Dialog v-model:open="showProfile">
      <DialogContent class="sm:max-w-lg">
        <DialogHeader>
          <DialogTitle>Member Profile</DialogTitle>
        </DialogHeader>

        <div v-if="selectedMember">
          <div class="space-y-2">
            <p><strong>Name:</strong> {{ selectedMember.name }}</p>
            <p><strong>Email:</strong> {{ selectedMember.email }}</p>
            <p><strong>Status:</strong> {{ selectedMember.membership_status }}</p>

            <div v-if="selectedMember.membership_status === 'Regular'">
              <p><strong>Date Joined:</strong> {{ selectedMember.date_joined ?? '—' }}</p>

              <Button
                variant="outline"
                @click="router.visit(`/admin/management/members/${selectedMember.id}/form`)"
              >
                View Membership Form
              </Button>

              <div class="mt-4 border-t pt-2 space-y-1">
                <p><strong>Total Sharing Capital:</strong> ₱{{ selectedMember.total_sharing_capital ?? 0 }}</p>
                <p><strong>Total Savings:</strong> ₱{{ selectedMember.total_savings ?? 0 }}</p>
              </div>
            </div>

            <div v-else-if="selectedMember.membership_status === 'Pending'">
              <Button
                variant="outline"
                @click="router.visit(`/admin/management/members/${selectedMember.id}/form`)"
              >
                View Membership Form
              </Button>

              <div class="flex gap-2 mt-4">
                <Button variant="default" @click="approveMember(selectedMember.id)">Approve</Button>
                <Button variant="destructive" @click="rejectMember(selectedMember.id)">Reject</Button>
              </div>
            </div>
          </div>
        </div>

        <DialogFooter>
          <Button variant="outline" @click="closeModal">Close</Button>
        </DialogFooter>
      </DialogContent>
    </Dialog>
  </AppLayout>
</template>
