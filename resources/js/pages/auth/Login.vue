<script setup lang="ts">
import InputError from '@/components/InputError.vue'
import TextLink from '@/components/TextLink.vue'
import { Button } from '@/components/ui/button'
import { Checkbox } from '@/components/ui/checkbox' // Removed "Remember me"
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import AuthBase from '@/layouts/AuthLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { Eye, EyeOff, LoaderCircle } from 'lucide-vue-next'
import { ref, watch } from 'vue'

const showPassword = ref(false)

defineProps<{
  status?: string
  canResetPassword: boolean
}>()

const form = useForm({
  email: '',
  password: '',
  remember: false,
  agreement: false,
})

watch(
  () => form.agreement,
  (newVal) => {
    if (newVal) {
      form.clearErrors('agreement')
    }
  },
)

const submit = () => {
  if (!form.agreement) {
    form.setError('agreement', 'You must agree to the terms to continue.')
    return
  }

  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  })
}
</script>

<template>
  <AuthBase title="Log in to your account" description="Enter your email and password below to log in">
    <Head title="Log in" />

    <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit" class="flex flex-col gap-6">
      <div class="grid gap-6">
        <div class="grid gap-2">
          <Label for="email">Email address</Label>
          <Input
            id="email"
            type="email"
            required
            autofocus
            :tabindex="1"
            autocomplete="email"
            v-model="form.email"
            placeholder="email@example.com"
          />
          <InputError :message="form.errors.email" />
        </div>

        <div class="grid gap-2">
          <div class="flex items-center justify-between">
            <Label for="password">Password</Label>
            <TextLink v-if="canResetPassword" :href="route('password.request')" class="text-sm" :tabindex="5">
              Forgot password?
            </TextLink>
          </div>
          <div class="relative">
            <Input
              id="password"
              :type="showPassword ? 'text' : 'password'"
              v-model="form.password"
              required
              autocomplete="current-password"
              :tabindex="2"
              placeholder="Password"
              class="pr-10"
            />
            <button
              type="button"
              @click="showPassword = !showPassword"
              :tabindex="3"
              class="absolute inset-y-0 right-2 flex items-center text-muted-foreground"
              aria-label="Toggle password visibility"
            >
              <Eye v-if="!showPassword" class="h-4 w-4" />
              <EyeOff v-else class="h-4 w-4" />
            </button>
          </div>
          <InputError :message="form.errors.password" />
        </div>

        <div class="flex items-center justify-between">
          <Label for="remember" class="flex items-center gap-3">
            <Checkbox id="remember" v-model="form.remember" :tabindex="3" />
            <span>Remember me</span>
          </Label>
        </div>

        <div class="flex items-start gap-2 text-sm">
          <Label for="agreement" class="flex items-start gap-3">
            <Checkbox id="agreement" v-model="form.agreement" name="agreement" :tabindex="3" />
            <span class="leading-snug text-muted-foreground">
              I have read and agree to the
              <TextLink :href="route('privacy-policy')" class="underline underline-offset-4"> Privacy Policy </TextLink>
              and
              <TextLink :href="route('terms-and-conditions')" class="underline underline-offset-4">
                Terms and Conditions </TextLink
              >.
            </span>
          </Label>
        </div>

        <InputError :message="form.errors.agreement" />

        <Button type="submit" class="mt-4 w-full" :tabindex="4" :disabled="form.processing">
          <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
          Log in
        </Button>
      </div>

      <div class="text-center text-sm text-muted-foreground">
        Don't have an account?
        <TextLink :href="route('register')" :tabindex="5">Sign up</TextLink>
      </div>
    </form>
  </AuthBase>
</template>
