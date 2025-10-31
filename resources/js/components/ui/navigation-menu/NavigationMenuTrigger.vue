<script setup lang="ts">
import { ChevronDown } from 'lucide-vue-next'
import {
  NavigationMenuTrigger,
  type NavigationMenuTriggerProps,
  useForwardProps,
} from 'reka-ui'
import { computed, type HTMLAttributes } from 'vue'
import { navigationMenuTriggerStyle } from '.'

const props = defineProps<NavigationMenuTriggerProps & { class?: HTMLAttributes['class'] }>()

const delegatedProps = computed(() => {
  const { class: _, ...delegated } = props

  return delegated
})

const forwardedProps = useForwardProps(delegatedProps)
</script>

<template>
  <NavigationMenuTrigger
    data-slot="navigation-menu-trigger"
    v-bind="forwardedProps"
    :class="navigationMenuTriggerStyle()" 
  ><!-- TODO: props.class -->
    <slot />
    <ChevronDown
      class=""
      aria-hidden="true"
    />
  </NavigationMenuTrigger>
</template>
