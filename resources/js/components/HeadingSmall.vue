<script setup lang="ts">
interface Props {
    title: string;
    description?: string;
}

defineProps<Props>();
</script>

<template>
    <header>
        <h3 class="">{{ title }}</h3>
        <p v-if="description" class="">
            {{ description }}
        </p>
    </header>
</template>
