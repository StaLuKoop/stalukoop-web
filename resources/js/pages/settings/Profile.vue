<script setup lang="ts">
import { Head, Link, useForm, usePage } from '@inertiajs/vue3'

// Existing imports
// import DeleteUser from '@/components/DeleteUser.vue';
import HeadingSmall from '@/components/HeadingSmall.vue'
import InputError from '@/components/InputError.vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import AppLayout from '@/layouts/AppLayout.vue'
import SettingsLayout from '@/layouts/settings/Layout.vue'
import { type BreadcrumbItem, type User } from '@/types'

// ✅ Add icons for action buttons
import { Pencil, Trash2, Plus, ActivitySquare } from 'lucide-vue-next'

interface Props {
  mustVerifyEmail: boolean
  status?: string
}

defineProps<Props>()

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Profile settings', href: '/settings/profile' },
]

// Existing profile form logic
const page = usePage()
const user = page.props.auth.user as User

const form = useForm({
  name: user.name,
  email: user.email,
})

const submit = () => {
  form.patch(route('profile.update'), {
    preserveScroll: true,
  })
}

// ✅ Added mock data for Account Management section
const admins = [
  { id: 1, name: 'Jane Doe', email: 'jane@example.com', role: 'Admin' },
  { id: 2, name: 'John Smith', email: 'john@example.com', role: 'Admin' },
]

const logs = [
  { id: 1, action: 'Added new admin: John Smith', date: '2025-11-04 14:25' },
  { id: 2, action: 'Deleted admin: Test User', date: '2025-11-03 09:10' },
  { id: 3, action: 'Updated profile information', date: '2025-11-02 18:40' },
]

// Dummy actions
const addAdmin = () => alert('Add Admin feature coming soon!')
const editAdmin = (id: number) => alert(`Edit Admin #${id}`)
const deleteAdmin = (id: number) => confirm(`Delete Admin #${id}?`)
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <Head title="Profile settings" />

    <SettingsLayout>
      <!-- Existing Profile Settings -->
      <div class="flex flex-col space-y-6">
        <HeadingSmall title="Profile information" description="Update your name and email address" />

        <form @submit.prevent="submit" class="space-y-6">
          <div class="grid gap-2">
            <Label for="name">Name</Label>
            <Input id="name" class="mt-1 block w-full" v-model="form.name" required autocomplete="name" placeholder="Full name" />
            <InputError class="mt-2" :message="form.errors.name" />
          </div>

          <div class="grid gap-2">
            <Label for="email">Email address</Label>
            <Input
              id="email"
              type="email"
              class="mt-1 block w-full"
              v-model="form.email"
              required
              autocomplete="username"
              placeholder="Email address"
            />
            <InputError class="mt-2" :message="form.errors.email" />
          </div>

          <div v-if="mustVerifyEmail && !user.email_verified_at">
            <p class="-mt-4 text-sm text-muted-foreground">
              Your email address is unverified.
              <Link
                :href="route('verification.send')"
                method="post"
                as="button"
                class="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
              >
                Click here to resend the verification email.
              </Link>
            </p>

            <div v-if="status === 'verification-link-sent'" class="mt-2 text-sm font-medium text-green-600">
              A new verification link has been sent to your email address.
            </div>
          </div>

          <div class="flex items-center gap-4">
            <Button :disabled="form.processing">Save</Button>

            <Transition
              enter-active-class="transition ease-in-out"
              enter-from-class="opacity-0"
              leave-active-class="transition ease-in-out"
              leave-to-class="opacity-0"
            >
              <p v-show="form.recentlySuccessful" class="text-sm text-neutral-600">Saved.</p>
            </Transition>
          </div>
        </form>
      </div>

      <!-- ✅ New Section: Account Management -->
      <div class="mt-10 flex flex-col space-y-10">
        <!-- Manage Admin Accounts -->
        <div>
          <HeadingSmall title="Manage Admin Accounts" description="Add, edit, or remove admin accounts." />

          <div class="flex justify-end mb-3">
            <Button @click="addAdmin" class="gap-2">
              <Plus class="h-4 w-4" /> Add Admin
            </Button>
          </div>

          <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-4 py-3 text-left font-semibold text-gray-600">ID</th>
                  <th class="px-4 py-3 text-left font-semibold text-gray-600">Name</th>
                  <th class="px-4 py-3 text-left font-semibold text-gray-600">Email</th>
                  <th class="px-4 py-3 text-left font-semibold text-gray-600">Role</th>
                  <th class="px-4 py-3 text-center font-semibold text-gray-600">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100">
                <tr v-for="admin in admins" :key="admin.id" class="hover:bg-gray-50">
                  <td class="px-4 py-3">{{ admin.id }}</td>
                  <td class="px-4 py-3">{{ admin.name }}</td>
                  <td class="px-4 py-3">{{ admin.email }}</td>
                  <td class="px-4 py-3">{{ admin.role }}</td>
                  <td class="px-4 py-3 text-center flex justify-center gap-3">
                    <Button variant="outline" size="icon" @click="editAdmin(admin.id)" title="Edit">
                      <Pencil class="h-4 w-4 text-blue-600" />
                    </Button>
                    <Button variant="outline" size="icon" @click="deleteAdmin(admin.id)" title="Delete">
                      <Trash2 class="h-4 w-4 text-red-600" />
                    </Button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Activity Logs -->
        <div>
          <HeadingSmall title="Activity Logs" description="Track admin actions and system access for accountability." />
          <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-4 py-3 text-left font-semibold text-gray-600">#</th>
                  <th class="px-4 py-3 text-left font-semibold text-gray-600">Action</th>
                  <th class="px-4 py-3 text-left font-semibold text-gray-600">Date</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100">
                <tr v-for="log in logs" :key="log.id" class="hover:bg-gray-50">
                  <td class="px-4 py-3">{{ log.id }}</td>
                  <td class="px-4 py-3 flex items-center gap-2">
                    <ActivitySquare class="h-4 w-4 text-green-600" /> {{ log.action }}
                  </td>
                  <td class="px-4 py-3">{{ log.date }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </SettingsLayout>
  </AppLayout>
</template>
