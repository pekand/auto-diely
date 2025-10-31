<script setup lang="ts">
import { Label, type LabelProps } from 'reka-ui'
import { computed, type HTMLAttributes } from 'vue'

const props = defineProps<LabelProps & { class?: HTMLAttributes['class'] }>()

const delegatedProps = computed(() => {
  const { class: _, ...delegated } = props

  return delegated
})
</script>

<template>
  <Label
    data-slot="label"
    v-bind="delegatedProps"
    :class="props.class"
  >
    <slot />
  </Label>
</template>
