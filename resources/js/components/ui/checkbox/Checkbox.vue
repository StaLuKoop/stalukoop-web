<script setup lang="ts">
// --- Imports ---
import type { CheckboxRootEmits, CheckboxRootProps } from 'reka-ui'
import { cn } from '@/lib/utils'
import { Check } from 'lucide-vue-next'
import { CheckboxIndicator, CheckboxRoot, useForwardPropsEmits } from 'reka-ui'
import { computed, type HTMLAttributes } from 'vue'

// --- Extend Checkbox Props to support native form attributes ---
interface ExtendedCheckboxProps extends CheckboxRootProps {
  class?: HTMLAttributes['class']
  required?: boolean
  name?: string
  value?: string
  form?: string
}

// --- Define props and emits ---
const props = defineProps<ExtendedCheckboxProps>()
const emits = defineEmits<CheckboxRootEmits>()

// --- Extract and forward relevant props, excluding 'class' ---
const delegatedProps = computed(() => {
  const {
    class: _,
    required,
    name,
    form,
    value,
    ...delegated
  } = props

  return {
    ...delegated,
    required,
    name,
    form,
    value,
  }
})

// --- Forward props to internal CheckboxRoot ---
const forwarded = useForwardPropsEmits(delegatedProps, emits)
</script>

<template>
  <CheckboxRoot
    data-slot="checkbox"
    v-bind="forwarded"
    :required="props.required"
    :name="props.name"
    :value="props.value"
    :form="props.form"
    :class="
      cn(
        'peer border-input data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground data-[state=checked]:border-primary focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive size-4 shrink-0 rounded-[4px] border shadow-xs transition-shadow outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50',
        props.class
      )
    "
  >
    <CheckboxIndicator
      data-slot="checkbox-indicator"
      class="flex items-center justify-center text-current transition-none"
    >
      <slot>
        <Check class="size-3.5" />
      </slot>
    </CheckboxIndicator>
  </CheckboxRoot>
</template>
