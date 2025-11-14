<script setup lang="ts">
import { Head, router, usePage } from '@inertiajs/vue3'
import { ref, watch, watchEffect } from 'vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import {
  Table, TableBody, TableCell, TableHead, TableHeader, TableRow
} from '@/components/ui/table'
import AppLayout from '@/layouts/AppLayout.vue'
import Pagination from '@/components/Pagination.vue'
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogFooter } from '@/components/ui/dialog'
import type { AppPageProps, BreadcrumbItem } from '@/types'

// Member type with transactions
type Member = {
  id: number
  name: string
  email: string
  membership_status: 'Pending' | 'Regular' | 'Inactive'
  date_joined?: string
  total_sharing_capital?: number
  total_savings?: number
  rejection_reason?: string
  membership_form_data?: Record<string, any>
  pmes_status?: 'Completed' | 'Not Completed'
  transactions?: {
    id: number
    type: 'Share Capital' | 'Savings'
    amount: number
    date: string
    status: 'Pending' | 'Verified'
  }[]
}

type PageProps = AppPageProps<{
  members: { data: Member[] }
  filters: { search?: string }
  meta: { links: any[]; current_page: number; last_page: number }
}>

const page = usePage<PageProps>()
const search = ref(page.props.filters.search ?? '')
const members = ref<Member[]>([])
const selectedMember = ref<Member | null>(null)
const showProfile = ref(false)
const rejectionReason = ref('')
const showFormData = ref(false)

watchEffect(() => {
  members.value = page.props.members.data
})

const performSearch = () => {
  router.get('/admin/management/members', { search: search.value }, {
    preserveState: true, replace: true, preserveScroll: true,
  })
}

watch(search, (newValue) => {
  if (newValue === '') performSearch()
})

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/admin/dashboard' },
  { title: 'Members', href: '/admin/management/members' },
]

// --- Modal Actions ---
const viewMember = (member: Member) => {
  selectedMember.value = member
  showProfile.value = true
  showFormData.value = false
}

const closeModal = () => {
  selectedMember.value = null
  showProfile.value = false
  rejectionReason.value = ''
  showFormData.value = false
}

const deleteMember = (id: number) => {
  if (confirm('Are you sure you want to delete this member?')) {
    router.delete(`/admin/management/members/${id}`, { preserveScroll: true })
  }
}

const approveMember = (id: number) => {
  router.post(`/admin/management/members/${id}/approve`, {}, {
    preserveScroll: true, onSuccess: () => (showProfile.value = false),
  })
}

const rejectMember = (id: number) => {
  if (rejectionReason.value.trim() === '') {
    alert('Please provide a reason for rejection')
    return
  }
  router.post(`/admin/management/members/${id}/reject`, { reason: rejectionReason.value }, {
    preserveScroll: true, onSuccess: () => (showProfile.value = false),
  })
}

// ✅ Verify Transaction
const verifyTransaction = (transactionId: number) => {
  if (!selectedMember.value) return
  if (confirm("Mark this transaction as verified?")) {
    router.post(`/admin/management/members/${selectedMember.value.id}/transactions/${transactionId}/verify`, {}, {
      preserveScroll: true,
      onSuccess: () => {
        router.reload({ preserveUrl: true })
      }
    })
  }
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
        <Input v-model="search" placeholder="Search members..." @keyup.enter="performSearch" />
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

      <Pagination :links="page.props.meta.links" />
    </div>

    <!-- ✅ View Profile Modal -->
    <Dialog v-model:open="showProfile">
      <DialogContent class="sm:max-w-2xl">
        <DialogHeader>
          <DialogTitle>
            {{ showFormData ? 'Membership Form Data' : 'Member Profile' }}
          </DialogTitle>
        </DialogHeader>

        <!-- Normal Member Profile -->
        <div v-if="selectedMember && !showFormData">
          <div class="space-y-2">
            <p><strong>Name:</strong> {{ selectedMember.name }}</p>
            <p><strong>Email:</strong> {{ selectedMember.email }}</p>
            <p><strong>Status:</strong> {{ selectedMember.membership_status }}</p>

            <p>
              <strong>PMES Attendance:</strong>
              <span :class="selectedMember.pmes_status === 'Completed' ? 'text-green-600' : 'text-red-600'">
                {{ selectedMember.pmes_status ?? 'Not Completed' }}
              </span>
            </p>

            <!-- Regular Member Section -->
            <div v-if="selectedMember.membership_status === 'Regular'">
              <p><strong>Date Joined:</strong> {{ selectedMember.date_joined ?? '—' }}</p>

              <Button variant="outline" @click="showFormData = true">View Membership Form</Button>

              <!-- ✅ Total + Transaction History -->
              <div class="mt-4 border-t pt-3 space-y-1">
                <p><strong>Total Share Capital:</strong> ₱{{ selectedMember.total_sharing_capital ?? 0 }}</p>
                <p><strong>Total Savings:</strong> ₱{{ selectedMember.total_savings ?? 0 }}</p>

                <div class="mt-4">
                  <h3 class="text-md font-semibold mb-2">Transaction History</h3>
                  <div v-if="selectedMember.transactions && selectedMember.transactions.length > 0" class="border rounded-lg p-2">
                    <table class="w-full text-sm">
                      <thead>
                        <tr class="border-b font-medium">
                          <th class="text-left p-2">Type</th>
                          <th class="text-left p-2">Amount</th>
                          <th class="text-left p-2">Date</th>
                          <th class="text-left p-2">Status</th>
                          <th class="text-right p-2">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="txn in selectedMember.transactions" :key="txn.id" class="border-b">
                          <td class="p-2">{{ txn.type }}</td>
                          <td class="p-2">₱{{ txn.amount }}</td>
                          <td class="p-2">{{ txn.date }}</td>
                          <td class="p-2">
                            <span :class="txn.status === 'Verified' ? 'text-green-600' : 'text-yellow-600'">
                              {{ txn.status }}
                            </span>
                          </td>
                          <td class="text-right p-2">
                            <Button
                              size="sm"
                              variant="outline"
                              :disabled="txn.status === 'Verified'"
                              @click="verifyTransaction(txn.id)"
                            >
                              Verify
                            </Button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <p v-else>No transactions available.</p>
                </div>
              </div>
            </div>

            <!-- Pending Member Section -->
            <div v-else-if="selectedMember.membership_status === 'Pending'">
              <Button variant="outline" @click="showFormData = true">
                View Membership Form
              </Button>

              <div class="flex gap-2 mt-4">
                <Button variant="default" @click="approveMember(selectedMember.id)">Approve</Button>
                <Button variant="destructive" @click="rejectMember(selectedMember.id)">Reject</Button>
              </div>

              <div class="mt-3">
                <label for="rejectionReason" class="block font-medium text-gray-700">Reason for Rejection</label>
                <textarea
                  v-model="rejectionReason"
                  id="rejectionReason"
                  class="input border border-gray-300 rounded-lg p-2 w-full mt-2"
                  placeholder="Enter reason for rejection"
                ></textarea>
              </div>
            </div>
          </div>
        </div>

        <!-- ✅ Membership Form Data View -->
        <div v-else-if="selectedMember && showFormData">
          <div v-if="selectedMember.membership_form_data" class="space-y-2">
            <div v-for="(value, key) in selectedMember.membership_form_data" :key="key">
              <p><strong>{{ key }}:</strong> {{ value }}</p>
            </div>
          </div>
          <div v-else>
            <p>No membership form data available.</p>
          </div>

          <Button class="mt-4" variant="outline" @click="showFormData = false">
            Back to Profile
          </Button>
        </div>

        <DialogFooter>
          <Button variant="outline" @click="closeModal">Close</Button>
        </DialogFooter>
      </DialogContent>
    </Dialog>
  </AppLayout>
</template>
