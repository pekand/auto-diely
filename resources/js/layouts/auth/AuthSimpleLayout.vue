<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { home } from '@/routes';
import { Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div
        class=""
    >
        <div class="">
            <div class="">
                <div class="">
                    <Link
                        :href="home()"
                        class=""
                    >
                        <div
                            class=""
                        >
                            <AppLogoIcon
                                class=""
                            />
                        </div>
                        <span class="">{{ title }}</span>
                    </Link>
                    <div class="">
                        <h1 class="">{{ title }}</h1>
                        <p class="">
                            {{ description }}
                        </p>
                    </div>
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>
