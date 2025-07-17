<script setup lang="ts">
import InputError from '@/components/InputError.vue'
import TextLink from '@/components/TextLink.vue'
import { Button } from '@/components/ui/button'
import Checkbox from '@/components/ui/checkbox/Checkbox.vue'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import AuthBase from '@/layouts/AuthLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { Check, Eye, EyeOff, LoaderCircle, X } from 'lucide-vue-next'
import { computed, ref, watch } from 'vue'

const showPassword = ref(false)
const showPasswordConfirmation = ref(false)

const isPasswordFocused = ref(false)

const passwordCriteria = computed(() => {
  const pwd = form.password
  return {
    minLength: pwd.length >= 8,
    mixedCase: /(?=.*[a-z])(?=.*[A-Z])/.test(pwd),
    hasNumber: /\d/.test(pwd),
    hasSymbol: /[\W_]/.test(pwd),
  }
})

const allPassed = computed(() => {
  const criteria = passwordCriteria.value
  return criteria.minLength && criteria.mixedCase && criteria.hasNumber && criteria.hasSymbol
})

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
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

  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}
</script>

<template>
  <AuthBase title="Create an account" description="Enter your details below to create your account">
    <Head title="Register" />

    <form @submit.prevent="submit" class="flex flex-col gap-6">
      <div class="grid gap-6">
        <div class="grid gap-2">
          <Label for="name">Name</Label>
          <Input
            id="name"
            type="text"
            required
            autofocus
            :tabindex="1"
            autocomplete="name"
            v-model="form.name"
            placeholder="Full name"
          />
          <InputError :message="form.errors.name" />
        </div>

        <div class="grid gap-2">
          <Label for="email">Email address</Label>
          <Input
            id="email"
            type="email"
            required
            :tabindex="2"
            autocomplete="email"
            v-model="form.email"
            placeholder="email@example.com"
          />
          <InputError :message="form.errors.email" />
        </div>

        <div class="grid gap-2">
          <Label for="password">Password</Label>
          <div class="relative">
            <Input
              id="password"
              :type="showPassword ? 'text' : 'password'"
              required
              :tabindex="3"
              autocomplete="new-password"
              v-model="form.password"
              placeholder="Password"
              @focus="isPasswordFocused = true"
              @blur="isPasswordFocused = false"
              class="pr-10"
            />
            <button
              type="button"
              @click="showPassword = !showPassword"
              class="absolute inset-y-0 right-2 flex items-center text-muted-foreground"
              aria-label="Toggle password visibility"
            >
              <Eye v-if="!showPassword" class="h-4 w-4" />
              <EyeOff v-else class="h-4 w-4" />
            </button>
          </div>
          <InputError :message="form.errors.password" />
        </div>

        <ul v-if="isPasswordFocused && !allPassed" class="ml-1 space-y-1 text-sm text-muted-foreground">
          <li :class="{ 'text-green-600': passwordCriteria.minLength }" class="flex items-center gap-2">
            <span><component :is="passwordCriteria.minLength ? Check : X" class="h-4 w-4" /></span>
            At least 8 characters
          </li>
          <li :class="{ 'text-green-600': passwordCriteria.mixedCase }" class="flex items-center gap-2">
            <span><component :is="passwordCriteria.mixedCase ? Check : X" class="h-4 w-4" /></span>
            At least one uppercase and lowercase letter
          </li>
          <li :class="{ 'text-green-600': passwordCriteria.hasNumber }" class="flex items-center gap-2">
            <span><component :is="passwordCriteria.hasNumber ? Check : X" class="h-4 w-4" /></span>
            At least one number
          </li>
          <li :class="{ 'text-green-600': passwordCriteria.hasSymbol }" class="flex items-center gap-2">
            <span><component :is="passwordCriteria.hasSymbol ? Check : X" class="h-4 w-4" /></span>
            At least one special character
          </li>
        </ul>

        <!-- Success message when all are satisfied -->
        <p
          v-else-if="isPasswordFocused && allPassed"
          class="flex items-center gap-2 text-sm text-green-600"
          aria-live="polite"
        >
          <Check class="h-4 w-4" />
          Password meets all requirements!
        </p>

        <div class="grid gap-2">
          <Label for="password_confirmation">Confirm password</Label>
          <div class="relative">
            <Input
              id="password_confirmation"
              :type="showPasswordConfirmation ? 'text' : 'password'"
              required
              :tabindex="4"
              autocomplete="new-password"
              v-model="form.password_confirmation"
              placeholder="Confirm password"
              class="pr-10"
            />
            <button
              type="button"
              @click="showPasswordConfirmation = !showPasswordConfirmation"
              class="absolute inset-y-0 right-2 flex items-center text-muted-foreground"
              aria-label="Toggle confirm password visibility"
            >
              <Eye v-if="!showPasswordConfirmation" class="h-4 w-4" />
              <EyeOff v-else class="h-4 w-4" />
            </button>
          </div>
          <InputError :message="form.errors.password_confirmation" />
        </div>

        <div class="flex items-start gap-2 text-sm">
          <Label for="agreement" class="flex items-start gap-3">
            <Checkbox id="agreement" v-model="form.agreement" name="agreement" :tabindex="5" />
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

        <Button type="submit" class="mt-2 w-full" tabindex="6" :disabled="form.processing">
          <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
          Create account
        </Button>
      </div>

      <div class="text-center text-sm text-muted-foreground">
        Already have an account?
        <TextLink :href="route('login')" class="underline underline-offset-4" :tabindex="7">Log in</TextLink>
      </div>
    </form>
  </AuthBase>
</template>
