<script lang="ts" setup>
import type { HTMLAttributes } from 'vue'
import { MoreHorizontal } from 'lucide-vue-next'

const props = defineProps<{
  class?: HTMLAttributes['class']
}>()
</script>

<template>
  <span
    data-slot="breadcrumb-ellipsis"
    role="presentation"
    aria-hidden="true"
    :class="props.class"
  >
    <slot>
      <MoreHorizontal class="" />
    </slot>
    <span class="">More</span>
  </span>
</template>
