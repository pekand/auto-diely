<script setup lang="ts" generic="Type extends 'text' | 'number' = 'text'">
import type { PinInputRootEmits, PinInputRootProps } from "reka-ui"
import type { HTMLAttributes } from "vue"
import { reactiveOmit } from "@vueuse/core"
import { PinInputRoot, useForwardPropsEmits } from "reka-ui"
import { cn } from "@/lib/utils"

const props = withDefaults(defineProps<PinInputRootProps<Type> & { class?: HTMLAttributes["class"] }>(), {
  modelValue: () => [],
})
const emits = defineEmits<PinInputRootEmits<Type>>()

const delegatedProps = reactiveOmit(props, "class")

const forwarded = useForwardPropsEmits(delegatedProps, emits)
</script>

<template>
  <PinInputRoot
    data-slot="pin-input"
    v-bind="forwarded" :class="props.class"
  >
    <slot />
  </PinInputRoot>
</template>
