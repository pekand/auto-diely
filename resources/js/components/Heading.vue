<script setup lang="ts">
interface Props {
    title: string;
    description?: string;
}

defineProps<Props>();
</script>

<template>
    <div class="">
        <h2 class="">{{ title }}</h2>
        <p v-if="description" class="">
            {{ description }}
        </p>
    </div>
</template>
