<script setup lang="ts">
import { Skeleton } from '@/components/ui/skeleton'
import { computed, type HTMLAttributes } from 'vue'

const props = defineProps<{
  showIcon?: boolean
  class?: HTMLAttributes['class']
}>()

const width = computed(() => {
  return `${Math.floor(Math.random() * 40) + 50}%`;
})
</script>

<template>
  <div
    data-slot="sidebar-menu-skeleton"
    data-sidebar="menu-skeleton"
    :class="props.class"
  >
    <Skeleton
      v-if="showIcon"
      class=""
      data-sidebar="menu-skeleton-icon"
    />

    <Skeleton
      class=""
      data-sidebar="menu-skeleton-text"
      :style="{ '--skeleton-width': width }"
    />
  </div>
</template>
