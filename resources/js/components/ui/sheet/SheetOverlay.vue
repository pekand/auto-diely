<script setup lang="ts">
import { DialogOverlay, type DialogOverlayProps } from 'reka-ui'
import { computed, type HTMLAttributes } from 'vue'

const props = defineProps<DialogOverlayProps & { class?: HTMLAttributes['class'] }>()

const delegatedProps = computed(() => {
  const { class: _, ...delegated } = props

  return delegated
})
</script>

<template>
  <DialogOverlay
    data-slot="sheet-overlay"
    :class="props.class"
    v-bind="delegatedProps"
  >
    <slot />
  </DialogOverlay>
</template>
